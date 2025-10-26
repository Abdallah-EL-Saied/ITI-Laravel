<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto flex flex-wrap items-center justify-between py-4 px-6">
            <a href="{{ route('products.index') }}" class="flex items-center text-xl font-bold uppercase gap-2">
                <i class="bi bi-box-seam"></i>Products Dashboard
            </a>

            <button id="nav-toggle" class="block lg:hidden text-white">
                <i class="bi bi-list text-2xl"></i>
            </button>

            <div class="hidden w-full lg:flex lg:items-center lg:w-auto gap-4" id="nav-content">
                <a class="text-white font-medium hover:text-gray-300" href="{{ route('products.index') }}">Products</a>
                <a class="text-white font-medium hover:text-gray-300"
                    href="{{ route('categories.index') }}">Categories</a>
                <a class="text-white font-medium hover:text-gray-300" href="{{ route('products.index') }}">Login</a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mx-auto py-10 px-4">
        @if(session('success'))
            <div class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                role="alert">
                <i class="bi bi-check-circle-fill text-xl mr-2"></i>
                <span class="block">{{ session('success') }}</span>
                <button type="button" class="absolute top-2 right-2 text-green-700 hover:text-green-900"
                    onclick="this.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center py-6 mt-10 border-t text-gray-500">
        &copy; {{ date('Y') }} Products Dashboard | Abdallah_EL_Saied
    </footer>

    <script>
        // Simple mobile nav toggle
        const navToggle = document.getElementById('nav-toggle');
        const navContent = document.getElementById('nav-content');
        navToggle.addEventListener('click', () => {
            navContent.classList.toggle('hidden');
        });
    </script>

</body>

</html>
