<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('windmill/public/assets/css/tailwind.output.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('windmill/public/assets/js/init-alpine.js')}}"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-green-500">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden rounded-lg shadow-xl bg-gray-50"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              class="object-cover w-full h-full"
              src="{{asset('images/bakso.jpg')}}"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <div class="flex justify-center mb-4">
                <img class="w-64" src="{{asset('images/logo-bg.png')}}" alt="">
              </div>
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Login
              </h1>
              <form action="{{route('admin.signin.process')}}" method="post">
                @csrf
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Username</span>
                    <input
                      name="username"
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                      placeholder="Jane Doe"
                      value="{{old('username')}}"
                      required
                    />
                  </label>
                  <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Password</span>
                    <input
                      name="password"
                      class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                      placeholder="***************"
                      type="password"
                      required
                    />
                  </label>

                  <!-- You should use a button here, as the anchor is only used for the example  -->
                  <button
                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                    href="../index.html"
                  >
                    Log in
                  </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
