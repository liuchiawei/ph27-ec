@extends('layouts.base')

@section('content')
    <h1 >カート</h1>
    <ul class="w-full max-w-md bg-gray-50 p-4 rounded-md shadow-md mx-auto">
        @foreach ($items as $item)
            <li>{{ $item['product']->name }} ￥{{ $item['product']->price }}円 {{ $item['quantity'] }}個</li>
        @endforeach
    </ul>
    <hr class="my-4">
    @if ($totalPrice > 0)
        <div>
            <p>合計金額：￥{{ $totalPrice }}円</p>
        </div>
    @endif
    <form action="{{ route('cart.destroy') }}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="カートを空にする">
    </form>
    <a href="/products">商品一覧に戻る</a>
@endsection