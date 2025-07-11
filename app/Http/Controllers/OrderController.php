<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $cart = session('cart', []);

        // カートが空の場合は商品一覧にリダイレクト
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'カートが空です');
        }

        $items = [];
        $totalPrice = 0;

        foreach ($cart as $productId => $quantity) {
            // 商品を取得
            $product = Product::find($productId);

            // 商品が見つからない場合は商品一覧にリダイレクト
            if (!$product) {
                return redirect()->route('products.index')->with('error', '商品が見つかりません');
            }

            // 合計金額を計算
            $totalPrice += $product->price * $quantity;

            // items 配列に追加
            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

        $order = new Order();
        $order->user_id = $request->user()->id;
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($items as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product->id;
            $orderDetail->price = $product->price;
            $orderDetail->quantity = $quantity;
            $orderDetail->save();
        }

        // カートを空にする
        session()->forget('cart');

        echo '合計金額：' . $totalPrice . '円' . '<br />';

        echo '注文が完了しました';
    }
}
