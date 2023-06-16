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
