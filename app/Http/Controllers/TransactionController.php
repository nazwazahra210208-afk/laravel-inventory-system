<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil transaksi manual (in/out)
        $transactions = Transaction::with(['product', 'user'])->orderBy('created_at', 'desc')->get();
        
        // Mengambil riwayat penjualan customer VIP (sales & sale_items) untuk ditampilkan di admin
        $salesAsTransactions = Sale::with(['items.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.index', compact('transactions', 'salesAsTransactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok produk tidak mencukupi untuk transaksi barang keluar!'])->withInput();
        }

        $sellingPrice = $product->selling_price ?? $product->price ?? 0;
        $totalPrice = $sellingPrice * $request->quantity;

        // Menggunakan auth()->id() ?? 1 untuk mencegah error SQL 1364 jika sesi login belum terdeteksi sempurna
        Transaction::create([
            'product_id' => $product->id,
            'user_id' => auth()->id() ?? 1,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'total_harga' => $totalPrice,
        ]);

        if ($request->type == 'in') {
            $product->stock += $request->quantity;
        } else {
            $product->stock -= $request->quantity;
        }
        $product->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat dan stok berhasil diperbarui.');
    }

    public function customerBuy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', 'Maaf, stok produk tidak mencukupi untuk pembelian ini.');
        }

        $sellingPrice = $product->selling_price ?? $product->price ?? 0;
        $totalPrice = $sellingPrice * $quantity;

        try {
            DB::transaction(function () use ($product, $quantity, $sellingPrice, $totalPrice) {
                // 1. Buat Header Penjualan (Sale)
                $sale = Sale::create([
                    'user_id' => auth()->id() ?? 1,
                    'sale_number' => 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                    'total' => $totalPrice,
                    'status' => 'completed',
                    'sold_at' => now(),
                ]);

                // 2. Buat Detail Item Penjualan (SaleItem)
                $sale->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $sellingPrice,
                    'subtotal' => $totalPrice,
                ]);

                // 3. Kurangi stok produk secara atomik
                $product->decrement('stock', $quantity);
            });

            return redirect()->route('customer.profile')->with('success', 'Pembelian produk ' . $product->name . ' berhasil diproses!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function customerHistory()
    {
        $sales = Sale::with(['items.product'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.profile', compact('sales'));
    }
}