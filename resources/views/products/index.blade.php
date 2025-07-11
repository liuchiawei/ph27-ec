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
    <h2 class="text-4xl text-center font-bold">商品一覧</h2>

    <ul class="grid grid-cols-3 md:grid-cols-5 gap-2">
        @foreach ($products as $product)
            <li
                class="aspect-square flex flex-col justify-between items-center p-2 rounded-lg bg-gray-300 hover:bg-emerald-600 hover:shadow-lg hover:**:data-price:text-white cursor-pointer overflow-hidden relative">
                <span class="text-[66px] opacity-50 absolute -bottom-6 -right-6 z-0">
                    {{ getEmojiByProductId($product->id, $emojis) }}
                </span>
                <a href="{{ route('products.show', ['id' => $product->id]) }}"
                    class="flex flex-col justify-between items-center h-full z-10">
                    <h1 class="text-lg font-bold text-center">
                        {{ $product->name }}
                    </h1>
                    <span data-price class="text-sm">
                        ￥{{ $product->price }} 円
                    </span>
                </a>
            </li>
        @endforeach
    </ul>

    <h2 class="text-2xl text-center font-bold">セール中の商品</h2>
    <ul class="grid grid-cols-3 md:grid-cols-5 gap-2">
        @foreach ($saleProducts as $product)
            <li
                class="aspect-square flex flex-col justify-between items-center p-2 rounded-lg bg-gray-300 hover:bg-rose-600 hover:shadow-lg hover:**:data-price:text-white cursor-pointer overflow-hidden relative">
                <span class="text-[96px] opacity-50 absolute -bottom-10 -right-10 z-0">
                    {{ getEmojiByProductId($product->id, $emojis) }}
                </span>
                <a href="{{ route('products.show', ['id' => $product->id]) }}"
                    class="flex flex-col justify-between items-center h-full z-10">
                    <h1 class="text-lg font-bold text-center">
                        {{ $product->name }}
                    </h1>
                    <span class="text-sm text-gray-500 line-through">
                        {{ $product->price }} 円
                    </span>
                    <span data-price class="text-lg text-rose-700">
                        {{ $product->price * 0.8 }} 円
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('cart.index') }}" class="text-center text-emerald-600 hover:text-emerald-800 hover:underline">カートへ</a>
@endsection
