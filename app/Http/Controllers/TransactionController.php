<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['product', 'user'])->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function createIn()
    {
        $products = Product::all();
        return view('transactions.in', compact('products'));
    }

    public function storeIn(Request $request)
    {
        // Validasi ketat input transaksi masuk
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::lockForUpdate()->find($validated['product_id']);
            $product->stock += $validated['quantity'];
            $product->save();

            Transaction::create([
                'product_id' => $validated['product_id'],
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $validated['quantity'],
                'notes' => htmlspecialchars($validated['notes'] ?? 'Stok Masuk', ENT_QUOTES, 'UTF-8'),
            ]);
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi barang masuk berhasil dicatat dengan aman.');
    }

    public function createOut()
    {
        $products = Product::all();
        return view('transactions.out', compact('products'));
    }

    public function storeOut(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $product = Product::find($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->withInput()->with('error', 'Stok tidak mencukupi! Stok saat ini: ' . $product->stock);
        }

        DB::transaction(function () use ($validated, $product) {
            $product->stock -= $validated['quantity'];
            $product->save();

            Transaction::create([
                'product_id' => $validated['product_id'],
                'user_id' => auth()->id(),
                'type' => 'out',
                'quantity' => $validated['quantity'],
                'notes' => htmlspecialchars($validated['notes'] ?? 'Stok Keluar', ENT_QUOTES, 'UTF-8'),
            ]);
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi barang keluar berhasil dicatat dengan aman.');
    }
}