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

    // product ID に基づいて対応する絵文字を探す
    $productEmoji = '';
    foreach ($emojis as $emoji) {
        if ($emoji['id'] == $product->id) {
            $productEmoji = $emoji['emoji'];
            break;
        }
    }
@endphp

@section('content')
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-3 p-4">
            @if ($productEmoji)
                <span class="text-5xl animate-bounce">{{ $productEmoji }}</span>
            @endif
            <h2 class="text-4xl font-bold">{{ $product->name }}</h2>
        </div>
        <span class="text-lg text-gray-500">
            ￥{{ $product->price }} 円
        </span>
    </div>
    <form action="{{ route('cart.store') }}" method="post">
        @csrf
        @error('productId')
            <div class="error">{{ $message }}</div>
        @enderror
        @error('quantity')
            <div class="error">{{ $message }}</div>
        @enderror
        <input type="hidden" name="productId" value="{{ $product->id }}">
        <div class="flex justify-between items-center">
            <div>
                <input type="number" name="quantity" class="px-2 py-1 bg-white border-none rounded-md"> 個
            </div>
            <input type="submit"
                class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-800 hover:shadow-lg cursor-pointer"
                value="カートに入れる">
        </div>
    </form>
    <a href="{{ route('products.index') }}"
        class="text-center text-emerald-600 hover:text-emerald-800 hover:underline">商品一覧へ戻る</a>
@endsection
