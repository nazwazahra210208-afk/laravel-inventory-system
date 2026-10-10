<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');
        $sort = $request->input('sort', 'latest');

        $query = Product::with(['category', 'suppliers']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'stock_low':
                $query->orderBy('stock', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(5)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories', 'search', 'category_id', 'sort'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('products.create', compact('suppliers', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi ketat untuk mencegah input berbahaya dan SQL Injection
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'sku' => ['required', 'string', 'max:50', 'unique:products,sku'],
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'suppliers' => ['nullable', 'array'],
            'suppliers.*' => ['exists:suppliers,id'],
        ]);

        $product = Product::create($validated);

        if ($request->has('suppliers')) {
            $product->suppliers()->sync($request->suppliers);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diamankan dan ditambahkan.');
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'suppliers', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'sku' => ['required', 'string', 'max:50', 'unique:products,sku,' . $product->id],
            'name' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'suppliers' => ['nullable', 'array'],
            'suppliers.*' => ['exists:suppliers,id'],
        ]);

        $product->update($validated);
        $product->suppliers()->sync($request->input('suppliers', []));

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui dengan aman.');
    }

    public function destroy(Product $product)
    {
        if (auth()->check() && strtolower(auth()->user()->role) !== 'admin') {
            return redirect()->route('products.index')->with('error', 'Akses Ditolak! Hanya Admin yang dapat menghapus produk.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}