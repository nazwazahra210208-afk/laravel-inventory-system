<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductController extends Controller
{
    // Fungsi pengaman: Hanya Admin yang boleh akses menu manajemen data
    private function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10)->appends($request->query());
        $categories = Category::all();

        if (auth()->user() && auth()->user()->role === 'customer') {
            return view('customer.products.index', compact('products', 'categories'));
        }

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $this->authorizeAdmin(); // Staff / Customer dicegat di sini (Muncul Error 403)

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin(); // Staff / Customer dicegat di sini

        $request->validate([
            'sku' => ['required', 'string', 'max:50', 'unique:products,sku'],
            'name' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id ?: null;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->stock;
        $product->minimum_stock = $request->minimum_stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $this->authorizeAdmin(); // Staff / Customer dicegat di sini

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeAdmin(); // Staff / Customer dicegat di sini

        $request->validate([
            'sku' => ['required', 'string', 'max:50', 'unique:products,sku,' . $product->id],
            'name' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id ?: null;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->stock;
        $product->minimum_stock = $request->minimum_stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeAdmin(); // Staff / Customer dicegat di sini

        if ($product->saleItems()->count() > 0 || $product->purchaseItems()->count() > 0) {
            return redirect()->route('products.index')->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}