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
  <body>
    <div
      class="flex h-screen justify-center items-center bg-green-500"
    >
        <div>
            <div class="">
                <img class="w-80" src="{{asset('images/logo.png')}}" alt="">
            </div>
            @yield('main')
        </div>
    </div>
  </body>
</html>
