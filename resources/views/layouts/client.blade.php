<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ngebaksoo</title>
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
    />
    <script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
    ></script>
    <script src="{{asset('windmill/public/assets/js/init-alpine.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('windmill/public/assets/css/tailwind.output.css')}}" />
    @vite('resources/css/app.css')

  </head>
  <body class="">

    @php
        use App\Models\Cart;

        function cartUser() {
            return Auth::guard('customer')->user() ? Cart::with('menu')->where('customer_id', Auth::guard('customer')->user()->id)->get() : 0;
        }
        function cartTotal() {
            $items = cartUser()->where('menu.status', 1);

            $total = 0;
            foreach ($items as $item) {
                $subtotal = $item->quantity * $item->menu->price;
                $total += $subtotal;
            }
            return $total;
        }
    @endphp
    <div
      class="min-h-screen box-border bg-green-500 px-32 pt-8 flex flex-col"
    >
        <div class="flex justify-between items-end mb-4">
            <div class="">
                <img class="w-64" src="{{asset('images/logo.png')}}" alt="">
            </div>
            <div class="flex bg-white text-green-500 px-5 py-3 rounded-2xl gap-5">
                <div>
                    @if (Auth::guard('customer')->user())
                        <div class="relative">
                            <div class="flex items-center gap-2"
                                {{-- class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none" --}}
                                @click="toggleProfileMenu"
                                @keydown.escape="closeProfileMenu"
                                aria-label="Account"
                                aria-haspopup="true">
                                <div class="w-7 h-7 overflow-hidden rounded-full border border-green-500">
                                    @if (Auth::guard('customer')->user()->photo)
                                        <img class="object-cover h-full w-full" src="{{Storage::url(Auth::guard('customer')->user()->photo)}}" alt="">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 cursor-pointer">
                                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                <p class="font-semibold">
                                    {{Auth::guard('customer')->user()->username}}
                                </p>
                            </div>

                            <template x-if="isProfileMenuOpen">
                                <ul
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                @click.away="closeProfileMenu"
                                @keydown.escape="closeProfileMenu"
                                class="absolute -right-5 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md"
                                aria-label="submenu"
                                >
                                <li class="flex">
                                    <a
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-green-400 hover:text-white"
                                    href="{{route('client.account')}}"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>

                                    <span>Akun saya</span>
                                    </a>
                                </li>
                                <li class="flex">
                                    <a
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-green-400 hover:text-white"
                                    href="{{route('client.history')}}"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>

                                    <span>Riwayat Pesanan</span>
                                    </a>
                                </li>
                                <li class="flex">
                                    <a
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-green-400 hover:text-white"
                                    href="{{route('client.logout')}}"
                                    >
                                    <svg
                                        class="w-4 h-4 mr-3"
                                        aria-hidden="true"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                        ></path>
                                    </svg>
                                    <span>Log out</span>
                                    </a>
                                </li>
                                </ul>
                            </template>
                        </div>
                    @else
                        <a href="{{route('client.signin')}}" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 cursor-pointer">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-semibold">
                                Login
                            </p>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-8 min-h-3/4 grow pb-20" x-data="cartInit()">
            @yield('main')
            @if (cartUser())
                <div @click="isModalCart = true" class="cursor-pointer fixed bottom-14 right-36 bg-green-500 border-2 border-green-200 w-96 rounded-xl text-white font-semibold">
                    <div class="relative flex justify-between p-4">
                        <div class="flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            <div>
                                {{cartUser()->where('menu.status', 1)->sum('quantity')}} item
                            </div>
                        </div>
                        <div>
                            Rp {{number_format(cartTotal(), 0, '.', '.')}}
                        </div>
                        <div
                            x-show="isModalCart"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute w-full left-0 right-0 -bottom-2 mb-2 z-20 flex items-end sm:items-center sm:justify-center"
                        >
                            <div
                                x-show="isModalCart"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0  transform translate-y-1/2"
                                @click.away="isModalCart = false"
                                @keydown.escape="isModalCart = false"
                                class="w-full px-6 py-4 overflow-hidden bg-green-500 border-2 border-green-200 rounded-t-lg sm:rounded-lg sm:max-w-xl m-0"
                                role="dialog"
                                id="modal"
                            >
                                <header class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    <div class="text-lg">
                                        Keranjang
                                    </div>
                                </header>
                                <!-- Modal body -->
                                <div class="mt-4 max-h-96">
                                    @foreach (cartUser() as $cart)
                                        <div class="flex justify-between mb-3 items-center">
                                            <div>
                                                <div>
                                                    {{$cart->menu->name}}
                                                </div>
                                                @if ($cart->menu->status)
                                                    <div class="text-xs">
                                                        x{{$cart->quantity}}
                                                    </div>
                                                    <div class="text-xs">
                                                        notes: {{$cart->notes ?? '-'}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                @if ($cart->menu->status)
                                                    <div>
                                                        Rp {{number_format($cart->quantity * $cart->menu->price)}}
                                                    </div>
                                                @else
                                                    <div class="text-gray-800">
                                                        Tidak Tersedia
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="flex justify-between text-xl">
                                        <div>
                                            Total
                                        </div>
                                        <div>
                                            Rp {{number_format(cartTotal(), 0, '.', '.')}}
                                        </div>
                                    </div>
                                </div>
                                <footer
                                    class="items-center px-4 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 mt-2"
                                >
                                    @if (cartUser()->count())
                                        <a href="{{route('client.cart')}}" type="button"
                                            class="inline-block text-center bg-white rounded-full font-bold w-full px-5 py-3 text-sm leading-5 text-green-700 transition-colors duration-150 border border-gray-300 sm:px-4 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                                        >
                                            Lihat Keranjang
                                        </a>
                                    @endif
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="text-xs my-3 text-white flex justify-center ">
            Alamat : KOMP. TITAN ARUM BLOK C.2NO.5 RT:2/13 DRANGONG, TAKTAKAN, KOTA SERANG, BANTEN
        </div>
    </div>

    <script>
        function cartInit() {
            return {
                isModalCart: false,
            };
        }
    </script>
    @yield('script')
  </body>
</html>
