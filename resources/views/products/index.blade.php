<html>
    <body>
        <h1>商品一覧</h1>
        <ul>
            @foreach ($products as $product)
                <li>
                    {{ $product->name }}
                    ￥{{ $product->price }}円
                </li>
            @endforeach
        </ul>
    </body>
</html>