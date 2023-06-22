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
    <div
      class="min-h-screen box-border bg-green-500 px-96 pt-8 flex flex-col"
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 cursor-pointer">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
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
        <div class="bg-white rounded-3xl p-8 min-h-3/4 grow" x-data="cartInit()">
            @yield('main')
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
