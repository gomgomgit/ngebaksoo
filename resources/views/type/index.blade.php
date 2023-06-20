@extends('layouts.app')

@section('title', 'Tipe Menu')

@section('head-addon')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('content')
<div x-data="init()">
    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

    @foreach ($types as $type)
      <!-- Card -->
      <a class="inline-block w-full" href="/admin/type/{{$type->id}}">
        <div
            class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 cursor-pointer hover:bg-green-300"
        >
            <div class="flex items-center">
                <div
                  class="p-3 mr-4 w-24 h-24 flex items-center justify-center"
                >
                    <img class="" src="{{Storage::url($type->image)}}" alt="">
                </div>
                <div>
                  <p
                    class="mb-1 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    {{$type->name}}
                  </p>
                  <p
                    class="text-lg font-medium text-gray-700 dark:text-gray-200"
                  >
                    {{$type->menus->count()}} Menu
                  </p>
                </div>
            </div>
        </div>
      </a>
    @endforeach

    <!-- Card -->
    <div>
        <div
          @click="isModalTypeOpen = true"
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 cursor-pointer hover:bg-green-300"
        >
          <div
            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
            </svg>
          </div>
          <div>
            <p
              class="text-lg font-medium text-gray-700 dark:text-gray-200"
            >
              Tambah Tipe Baru
            </p>
          </div>
        </div>
    </div>

    <div
    x-show="isModalTypeOpen"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
    <!-- Modal -->
    <div
      x-show="isModalTypeOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0  transform translate-y-1/2"
      @click.away="isModalTypeOpen = false"
      @keydown.escape="isModalTypeOpen = false"
      class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
      role="dialog"
      id="modal"
    >
      <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
      <form method="POST" action="/admin/type/store" enctype="multipart/form-data" @submit="validateform">
      @csrf
      <header class="flex justify-end">
        <button
            type="button"
          class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
          aria-label="close"
          @click="isModalTypeOpen = false"
        >
          <svg
            class="w-4 h-4"
            fill="currentColor"
            viewBox="0 0 20 20"
            role="img"
            aria-hidden="true"
          >
            <path
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
              fill-rule="evenodd"
            ></path>
          </svg>
        </button>
      </header>
      <!-- Modal body -->
      <div class="mt-4 mb-6">
        <!-- Modal title -->
        <p
          class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
        >
          Tambah Tipe Menu
        </p>
          <div class="flex gap-6">
            <div class="mb-2 w-32">
              <!-- Show the image -->
              <template x-if="imageTypeUrl">
                <img :src="imageTypeUrl"
                      class="object-cover rounded border border-gray-200"
                      style="width: 130px; height: 130px;"
                >
              </template>

              <!-- Show the gray box when image is not available -->
              <template x-if="!imageTypeUrl">
                <div
                  class="border rounded border-gray-200 bg-gray-100"
                  style="width: 130px; height: 130px;"
                ></div>
              </template>

              <!-- Image file selector -->
              <input class="hidden mt-2" name="image" type="file" id="file-input-image-type" accept="image/*"  @change="imageTypeChange">
              <label for="file-input-image-type" class="mt-2 flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Pilih gambar</span>
              </label>
              <div class="mt-2">
                  <p class="text-xs text-red-500">*gambar wajib ada</p>
                  <p class="text-xs text-red-500">*max 2 mb</p>
              </div>

            </div>
            <div>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama</span>
                <input name="name" value="" required class="text-gray-700 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Tipe">
              </label>
            </div>
          </div>
      </div>
      <footer
        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
      >
        <button type="button"
          @click="isModalTypeOpen = false"
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
        >
          Cancel
        </button>
        <button
          class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
          Tambah
        </button>
      </footer>
    </form>
    </div>
    </div>
</div>


<script>

    function init() {

      return {
        isModalTypeOpen: false,

        imageTypeUrl: "",

        imageTypeChange(event) {
          this.fileToDataUrl(event, src => this.imageTypeUrl = src)
        },

        fileToDataUrl(event, callback) {
          if (! event.target.files.length) return

          let file = event.target.files[0],
            reader = new FileReader()

            if (file.size < 2097152) {
                reader.onload = e => callback(e.target.result)
                reader.readAsDataURL(file)
            } else {
                alert('ukuran gambar terlalu besar')
            }

        },

        validateform(event) {
            if (!this.imageTypeUrl) {
                event.preventDefault()
                alert('gambar harus diisi')
                return false
            }
        }

      };

    }

  </script>
@endsection
