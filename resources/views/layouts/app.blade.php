<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    @include('includes.head')
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      @include('includes.sidebar')

      <div class="flex flex-col flex-1 w-full">
        @include('includes.header')
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <div class="flex justify-between items-center">
                <h2
                  class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
                >
                  @yield('title')
                </h2>
                <div class="mt-4">
                  @yield('side-title')
                </div>
            </div>
            <!-- CTA -->

            @yield('content')
          </div>
        </main>
      </div>
    </div>
    @yield('script')
  </body>
</html>
