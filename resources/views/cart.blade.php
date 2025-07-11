@extends('layouts.base')

@php
    $emojis = [
        [
            'id' => 1,
            'name' => 'にんじん',
            'emoji' => '🥕',
        ],
        [
            'id' => 2,
            'name' => 'ピーマン',
            'emoji' => '🫑',
        ],
        [
            'id' => 3,
            'name' => 'ダイコン',
            'emoji' => '🥕',
        ],
        [
            'id' => 4,
            'name' => 'レモン',
            'emoji' => '🍋',
        ],
        [
            'id' => 5,
            'name' => '大根',
            'emoji' => '🥕',
        ],
        [
            'id' => 6,
            'name' => '人参',
            'emoji' => '🥕',
        ],
        [
            'id' => 7,
            'name' => 'カボチャ',
            'emoji' => '🎃',
        ],
    ];

    // product ID に基づいて対応する絵文字を取得する関数
    function getEmojiByProductId($productId, $emojis)
    {
        foreach ($emojis as $emoji) {
            if ($emoji['id'] == $productId) {
                return $emoji['emoji'];
            }
        }
        return '🛒'; // デフォルトの絵文字
    }
@endphp

@section('content')
    <h1 class="text-center text-4xl font-bold">カート</h1>
    <ul class="w-full max-w-md bg-gray-50 p-4 rounded-md shadow-md mx-auto">
        @foreach ($items as $item)
            <li class="flex items-center gap-3 p-2 border-b border-gray-200 last:border-b-0">
                <span class="text-2xl">{{ getEmojiByProductId($item['product']->id, $emojis) }}</span>
                <div class="flex-1">
                    <span class="font-medium">{{ $item['product']->name }}</span>
                    <span class="text-gray-600">￥{{ $item['product']->price }}円</span>
                    <span class="text-gray-500">{{ $item['quantity'] }}個</span>
                </div>
            </li>
        @endforeach
    </ul>
    @if ($totalPrice > 0)
        <div class="flex justify-between items-center">
            <p class="text-lg">合計金額：￥{{ $totalPrice }}円</p>
            <div class="flex gap-2">
                <form action="{{ route('cart.destroy') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit"
                        class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-600 hover:shadow-lg cursor-pointer"
                        value="カートを空にする">
                </form>
                <form action="{{ route('order') }}" method="post">
                    @csrf
                    <input type="submit"
                        class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-800 hover:shadow-lg cursor-pointer"
                        value="注文する">
                </form>
            </div>
        </div>
    @else
        <p class="text-center text-gray-500">カートが空です</p>
    @endif
    <a href="{{ route('products.index') }}"
        class="text-center text-emerald-600 hover:text-emerald-800 hover:underline">商品一覧に戻る</a>
@endsection
