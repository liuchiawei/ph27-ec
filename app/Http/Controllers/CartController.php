<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ],[
            'quantity' => '正しい個数を入力してください',
        ]);

        $productId = $request->input('productId');
        $quantity = $request->input('quantity');
        // セッションに保存されているカートを取得
        // ない場合は空の配列を返す
        $cart = $request->session()->get('cart', []);

        // 商品IDがkeyで、何個というのをsessionに保存
        // ['1' => 5, '2' => 3]
        $cart[$productId] = $quantity;
        session(['cart'=>$cart]);

        return redirect()->route('cart.index');
    }

    public function index(Request $request)
    {
        $cart = session('cart', []);

        $items = [];
        $totalPrice = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            $item = [
                'product' => $product,
                'quantity' => $quantity,
            ];
            $items[] = $item;
            $totalPrice += $product->price * $quantity;
        }

        return view('cart', [
            'items' => $items,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function destroy(Request $request)
    {
        // セッションからカートを削除
        $request->session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
