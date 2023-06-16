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
            $items = cartUser();

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
                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 cursor-pointer">
                    <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z" clip-rule="evenodd" />
                </svg> --}}
                {{-- <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 cursor-pointer">
                        <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                    </svg>
                    @if (Auth::guard('customer')->user())
                        <div class="absolute bg-red-600 rounded-full text-white w-5 h-5 -top-2 -right-2 flex justify-center items-center text-xs font-semibold">
                            {{cartUser()->sum('quantity')}}
                        </div>
                    @endif
                </div> --}}
                <div>
                    @if (Auth::guard('customer')->user())
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 cursor-pointer">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-semibold">
                                {{Auth::guard('customer')->user()->username}}
                            </p>
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
                @if (Auth::guard('customer')->user())
                    <a href="{{route('client.logout')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </a>
                @endif
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
                                {{cartUser()->sum('quantity')}} item
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
                                                <div class="text-xs">
                                                    x{{$cart->quantity}}
                                                </div>
                                                <div class="text-xs">
                                                    notes: {{$cart->notes ?? '-'}}
                                                </div>
                                            </div>
                                            <div>
                                                Rp {{number_format($cart->quantity * $cart->menu->price)}}
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
                                    <a href="{{route('client.cart')}}" type="button"
                                        class="inline-block text-center bg-white rounded-full font-bold w-full px-5 py-3 text-sm leading-5 text-green-700 transition-colors duration-150 border border-gray-300 sm:px-4 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                                    >
                                        Lihat Keranjang
                                    </a>
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
