<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        // Menggunakan paginate(10) sesuai standar Slide 18 PPT
        $purchases = Purchase::with(['supplier', 'user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.unit_cost' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Buat Header Pembelian
                $purchase = Purchase::create([
                    'supplier_id' => $request->supplier_id,
                    'user_id' => auth()->id(),
                    'purchase_number' => 'PO-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                    'total' => 0,
                    'status' => 'completed',
                    'purchased_at' => now(),
                ]);

                $total = 0;

                foreach ($request->items as $item) {
                    $product = Product::lockForUpdate()->findOrFail($item['product_id']);
                    $qty = (int) $item['quantity'];
                    $unitCost = (float) $item['unit_cost'];
                    $subtotal = $qty * $unitCost;

                    // 2. Simpan Detail Item Pembelian
                    $purchase->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'unit_cost' => $unitCost,
                        'subtotal' => $subtotal,
                    ]);

                    // 3. Tambah stok produk secara atomik & perbarui harga beli
                    $product->increment('stock', $qty);
                    $product->update(['purchase_price' => $unitCost]);

                    $total += $subtotal;
                }

                // 4. Update total harga header
                $purchase->update(['total' => $total]);
            });

            return redirect()->route('purchases.index')->with('success', 'Transaksi pembelian berhasil dicatat dan stok berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pembelian: ' . $e->getMessage())->withInput();
        }
    }
}