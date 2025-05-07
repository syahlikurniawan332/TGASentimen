<!DOCTYPE html>
<html lang="id" class="{{ session('dark_mode') ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisis Sentimen</title>
    <!-- Script untuk dark mode sebelum CSS -->
    <script>
        // Cek preferensi tema saat pertama load
        if (localStorage.getItem('dark-mode') === 'true' ||
            (!localStorage.getItem('dark-mode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.cookie = "dark_mode=1; path=/";
        } else {
            document.documentElement.classList.remove('dark');
            document.cookie = "dark_mode=0; path=/";
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300 min-h-screen">
    @include('layouts.navbar')

    <main class="container-fluid mx-auto p-4">
        @yield('content')
    </main>

    @include('layouts.footer')

    @stack('scripts')

    <!-- Flowbite JS untuk tooltip -->
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>
</body>

</html>