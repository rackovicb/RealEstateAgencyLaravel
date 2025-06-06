<nav class="bg-gray-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="/">
                    <img class="h-8 w-8" src="https://laracasts.com/images/logo/logo-triangle.svg" alt="Logo">
                </a>

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link>
                <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">About</x-nav-link>
                <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contact</x-nav-link>
                <x-nav-link href="{{ route('real-estates.index') }}" :active="request()->routeIs('real-estates.*')">Real Estates</x-nav-link>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <x-nav-link href="{{ route('favorites.index') }}" :active="request()->routeIs('favorites.index')">Favorites</x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-gray-300 hover:text-white">Logout</button>
                    </form>
                @else
                    <x-nav-link href="{{ route('login') }}">Login</x-nav-link>
                    <x-nav-link href="{{ route('register') }}">Register</x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
