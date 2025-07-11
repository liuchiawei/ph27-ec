<html>

<head>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="flex justify-center items-center p-4 bg-gradient-to-br from-emerald-900 to-green-700">
    <h1 class="absolute bottom-0 right-4 -z-10 text-[60pt] font-bold text-white/50">やさい販売.com</h1>
    <main class="w-full max-w-xl p-6 rounded-xl bg-gray-200 shadow-md flex flex-col gap-4">
        @yield('content')
    </main>
</body>

</html>
