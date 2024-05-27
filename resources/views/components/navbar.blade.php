<nav x-data="{ isBuka: false }" class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        {{-- link navbar  --}}
                        <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                        @guest
                        @else
                            <x-nav-link href="/bahan-baku" :active="request()->is('bahan-baku')">Bahan Baku</x-nav-link>
                            <x-nav-link href="/biaya-pemesanan" :active="request()->is('biaya-pemesanan')">Biaya Pemesanan</x-nav-link>
                            <x-nav-link href="/biaya-penyimpanan" :active="request()->is('biaya-penyimpanan')">Biaya Penyimpanan</x-nav-link>
                            <x-nav-link href="/hasil-input" :active="request()->is('hasil-input')">Hasil</x-nav-link>
                        @endguest


                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-ghost text-white">Login</a>
                            @else
                                <button @click="isBuka = !isBuka" type="button" class="btn btn-ghost text-white"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }}
                                </button>
                            @endguest


                        </div>


                        <div x-show="isBuka" x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">Sign out</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button @click="isBuka = !isBuka" type="button"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{ 'hidden': isBuka, 'blog': !isBuka }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{ 'hidden': !isBuka, 'blog': isBuka }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isBuka" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <x-nav-link-mobile href="/" :active="request()->is('/')">Home</x-nav-link-mobile>
            @guest
            @else
                <x-nav-link-mobile href="/bahan-baku" :active="request()->is('bahan-baku')">Bahan Baku</x-nav-link-mobile>
                <x-nav-link-mobile href="/biaya-pemesanan" :active="request()->is('biaya-pemesanan')">Biaya Pemesanan</x-nav-link-mobile>
                <x-nav-link-mobile href="/biaya-penyimpanan" :active="request()->is('biaya-penyimpanan')">Biaya Penyimpanan</x-nav-link-mobile>
                <x-nav-link-mobile href="/hasil-input" :active="request()->is('hasil-input')">Hasil</x-nav-link-mobile>
            @endguest


        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">

                <div class="">
                    @guest
                        <a href="{{ route('login') }}" class="text-base font-medium leading-none text-white">login</a>
                        <div class="text-sm font-medium leading-none text-gray-400"></div>
                    @else
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium leading-none text-gray-400 mt-2">{{ Auth::user()->email }}</div>
                    @endguest

                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                @guest
                @else
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                            out</button>
                    </form>
                @endguest


            </div>
        </div>
    </div>
</nav>
