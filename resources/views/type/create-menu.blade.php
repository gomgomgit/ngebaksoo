@extends('layouts.app')

@section('title', 'Tambah Menu Baru')

@section('head-addon')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('content')
<div x-data="init()">

  <div
    class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
      <form method="POST" action="/admin/type/store-menu/" enctype="multipart/form-data">
      @csrf
      <div class="mt-4 mb-6">
          <div>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Pilih Tipe Menu
                </span>
                <select
                  name="type"
                  required
                  class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >
                  @foreach ($types as $type)
                    <option {{request()->id == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->name}}</option>
                  @endforeach
                </select>
            </label>

            @error('type')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
          </div>
          <div class="flex gap-6 mt-4">
            <div class="mb-2 w-60">
              <template x-if="imageTypeUrl">
                <img :src="imageTypeUrl"
                      class="object-cover rounded border border-gray-200"
                      style="width: 300px;"
                >
              </template>

              <template x-if="!imageTypeUrl">
                <div
                  class="border rounded border-gray-200 bg-gray-100"
                  style="width: 300px;"
                ></div>
              </template>

              <input class="mt-2 hidden" name="image" type="file" id="file-input-image-type" accept="image/*"  @change="imageTypeChange">
              <label for="file-input-image-type" class="mt-2 flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Pilih gambar</span>
              </label>

              <div class="mt-2">
                    <p class="text-xs text-red-500">*max 2 mb</p>
                </div>

            </div>
            <div class="w-full">
              <div>
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Nama Menu</span>
                    <input name="name" required value="" class="text-gray-700 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Menu">
                  </label>
                  @error('name')
                  <div class="text-red-500">{{ $message }}</div>
                  @enderror
              </div>
              <div class="mt-4">
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Deskripsi</span>
                  <textarea
                    class="block w-full mt-1 text-sm text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="3"
                    placeholder="Deskripsi untuk menu tersebut"
                    name="description"
                  ></textarea>
                </label>
              </div>
              <div class="mt-4">
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Harga</span>
                  <div
                    class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                  >
                    <input
                      class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                      placeholder="**000"
                      required
                      name="price"
                    />
                    <div
                      class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                    >
                      Rp
                    </div>
                  </div>
                </label>
                @error('price')
                  <div class="text-red-500">{{ $message }}</div>
                @enderror
              </div>

              <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Status
                </span>
                <div class="mt-2">
                  <label
                    class="inline-flex items-center text-gray-600 dark:text-gray-400"
                  >
                    <input
                      type="radio"
                      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      name="status"
                      value="1"
                      checked
                    />
                    <span class="ml-2">Aktif</span>
                  </label>
                  <label
                    class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
                  >
                    <input
                      type="radio"
                      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      name="status"
                      value="0"
                    />
                    <span class="ml-2">Non Aktif</span>
                  </label>
                </div>
                <div
                  class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                >
                  <a href="/admin/type/{{request()->id}}" type="button"
                    @click="isModalTypeOpen = false"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                  >
                    Kembali
                  </a>
                  <button
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  >
                    Tambah Menu
                  </button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </form>
  </div>
</div>

<script>

  function init() {

    return {
      imageTypeUrl: "{{asset('images/no-image.png')}}",

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
    };

  }

</script>
@endsection
