@extends('layouts.app')

@section('title', 'Detail')

@section('head-addon')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('content')
<div x-data="init()">
  <div
      class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 cursor-pointer"
  >
      <div class="d-inline-block flex items-center justify-between">
          <div class="flex items-center">
              <div
              class="p-3 mr-4 w-24 h-24 items-center justify-center"
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
          <div class="flex items-center gap-4">
              <button x-on:click="isModalTypeOpen = true" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
              </button>
              <form id='deleteTypeForm' method="POST" action="{{ route('type.delete', $type->id) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button @click="deleteType" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" aria-label="delete">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
          </div>
      </div>
  </div>

  {{-- Table --}}
  <div class="mt-8 flex justify-between items-center">
      <h2 class="font-semibold text-lg text-gray-700 dark:text-gray-300">
          Menu
      </h2>
      <a href="/admin/type/{{$type->id}}/create-menu" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple gap-3">
        <span>Tambah Menu</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M12 5.25a.75.75 0 01.75.75v5.25H18a.75.75 0 010 1.5h-5.25V18a.75.75 0 01-1.5 0v-5.25H6a.75.75 0 010-1.5h5.25V6a.75.75 0 01.75-.75z" clip-rule="evenodd" />
        </svg>
      </a>
  </div>
  <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
      <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
          <thead>
          <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
          >
              <th class="px-4 py-3">Image</th>
              <th class="px-4 py-3">Price</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Action</th>
          </tr>
          </thead>
          <tbody
          class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
              @foreach ($type->menus as $menu)
                  <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                      <!-- Avatar with inset shadow -->
                      <div
                          class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                      >
                          <img
                          class="object-cover w-full h-full rounded-full"
                          src="{{$menu->image ? Storage::url($menu->image) : asset('images/food-default.png')}}"
                          alt=""
                          loading="lazy"
                          />
                          <div
                          class="absolute inset-0 rounded-full shadow-inner"
                          aria-hidden="true"
                          ></div>
                      </div>
                      <div>
                          <p class="font-semibold">{{$menu->name}}</p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">
                              {{$menu->description}}
                          </p>
                      </div>
                      </div>
                  </td>
                  <td class="px-4 py-3 text-sm">
                      Rp {{$menu->price}}
                  </td>
                  <td class="px-4 py-3 text-xs">
                      <span
                      class="px-2 py-1 font-semibold leading-tight {{$menu->status ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100' : 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100'}} rounded-full"
                      >
                      {{$menu->status ? 'Aktif' : 'Non aktif'}}
                      </span>
                  </td>
                  <td class="px-4 py-3 text-sm">
                      <div class="flex items-center gap-4">
                          @if ($menu->status)
                            <a href="/admin/type/change-status-menu/{{$menu->id}}" class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-orange-600 border border-transparent rounded-full active:bg-orange-600 hover:bg-orange-700 focus:outline-none focus:shadow-outline-orange" aria-label="Edit">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                              </svg>
                            </a>
                            @else
                            <a href="/admin/type/change-status-menu/{{$menu->id}}" class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-full active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green" aria-label="Edit">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                              </svg>
                            </a>
                            @endif
                            <a href="/admin/type/edit-menu/{{$menu->id}}" class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit">
                              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                              </svg>
                            </a>
                          <form id='deleteMenu{{$menu->id}}' method="POST" action="{{ route('type.delete.menu', $menu->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button @click="deleteMenu" form="deleteMenu{{$menu->id}}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" aria-label="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" form="deleteMenu{{$menu->id}}" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path form="deleteMenu{{$menu->id}}" fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                            </button>
                          </form>
                      </div>
                  </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
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
      <form method="POST" action="/admin/type/update/{{$type->id}}" enctype="multipart/form-data">
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
          Edit Tipe Menu
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
              <input class="mt-2 hidden" name="image" type="file" id="file-input-image-type" accept="image/*"  @change="imageTypeChange">
              <label for="file-input-image-type" class="mt-2 flex items-center justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Ubah gambar</span>
              </label>
              <div class="mt-2">
                    <p class="text-xs text-red-500">*gambar wajib ada</p>
                    <p class="text-xs text-red-500">*max 2 mb</p>
                </div>

            </div>
            <div>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama</span>
                <input name="name" required value="{{$type->name}}" class="text-gray-700 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Nama Tipe">
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
          Edit
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

      imageTypeUrl: "{{$type->image ? Storage::url($type->image) : ''}}",

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

      deleteType(event, callback) {
        event.preventDefault()
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Menu didalamnya juga akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                let uploadForm = document.getElementById("deleteTypeForm");
                uploadForm.submit()
            }
        })
      },
      deleteMenu(event, callback) {
        event.preventDefault()
        let form = event.target.closest('form')
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Menu akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit()
            }
        })
      }

    };

  }

</script>
@endsection
