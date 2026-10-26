<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->selling_price ?? $product->price ?? 0,
                "sku" => $product->sku,
                "product_id" => $product->id
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil dimasukkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        try {
            DB::transaction(function () use ($cart) {
                // 1. Buat Header Transaksi Penjualan (Sales) sesuai standar UTS Slide 9 & 16
                $sale = Sale::create([
                    'user_id' => auth()->id(),
                    'sale_number' => 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)),
                    'total' => 0,
                    'status' => 'completed',
                    'sold_at' => now(),
                ]);

                $total = 0;

                foreach ($cart as $id => $details) {
                    // 2. Kunci baris produk untuk mencegah race condition / overselling (Slide 16)
                    $product = Product::lockForUpdate()->findOrFail($id);
                    $qty = (int) $details['quantity'];

                    // 3. Validasi stok tersedia
                    if ($qty < 1 || $product->stock < $qty) {
                        throw ValidationException::withMessages([
                            'cart' => 'Stok produk "' . $product->name . '" tidak mencukupi atau kuantitas tidak valid.',
                        ]);
                    }

                    $unitPrice = $details['price'];
                    $subtotal = $unitPrice * $qty;

                    // 4. Simpan Detail Item Penjualan (SaleItems)
                    $sale->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'unit_price' => $unitPrice,
                        'subtotal' => $subtotal,
                    ]);

                    // 5. Kurangi stok produk secara atomik
                    $product->decrement('stock', $qty);
                    $total += $subtotal;
                }

                // 6. Update total harga di header penjualan
                $sale->update(['total' => $total]);
            });

            // Kosongkan session keranjang setelah sukses
            session()->forget('cart');

            return redirect()->route('customer.profile')->with('success', 'Checkout berhasil! Transaksi tercatat aman di sistem.');
            
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal checkout: Stok produk tidak mencukupi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}