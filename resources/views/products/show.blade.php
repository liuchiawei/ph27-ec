@extends('layouts.base')

@section('content')
    <h2>{{ $product->name }}</h2>
    <div>
        {{ $product->price }}円
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
        <input type="number" name="quantity">個<br>
        <input type="submit" value="カートに入れる">
    </form>
@endsection
