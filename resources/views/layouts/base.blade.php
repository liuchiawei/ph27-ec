<html>

<head>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-200">
    <h1 class="text-4xl font-bold">やさい販売.com</h1>
    <div class="mx-auto w-full min-h-96 max-w-lg bg-gray-100 p-4 rounded-md shadow-md">
        @yield('content')
    </div>
</body>

</html>
