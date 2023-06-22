@extends('layouts.selection')

@section('main')
    <div x-data="init()" class="">
        <div class="grid grid-cols-3 items-center">
            <div class="text-start">
                <button>
                    <a href="/choose-type" class="flex justify-center items-center border-green-700 gap-2 font-semibold rounded-full px-4 py-2 text-sm leading-5 text-green-700 transition-colors duration-150 bg-white border border-transparent hover:bg-green-700 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>
                        <p>Kembali</p>
                    </a>
                </button>
            </div>
            <h2 class="text-green-600 font-bold text-center w-full">Akun saya</h2>
            <h2 class="text-green-600 font-bold text-center"></h2>
        </div>
        <div class="mt-4">
            <form action="{{route('client.account.edit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-center">
                    <label for="file-input-image-type">
                        <div class="w-48 h-48 rounded-full border-4 border-green-500 overflow-hidden cursor-pointer group relative">
                            <img class="object-cover h-full w-full" :src="imageTypeUrl" alt="">
                            <input @change="imageTypeChange" type="file" class="hidden" accept="image/*" name="photo" id="file-input-image-type">
                            <div class="opacity-0 group-hover:opacity-100 duration-150 inset-0 absolute flex flex-col justify-end">
                                <div class="bg-green-500 h-1/3 text-white flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                        <path d="M12 9a3.75 3.75 0 100 7.5A3.75 3.75 0 0012 9z" />
                                        <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 015.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 01-3 3h-15a3 3 0 01-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 001.11-.71l.822-1.315a2.942 2.942 0 012.332-1.39zM6.75 12.75a5.25 5.25 0 1110.5 0 5.25 5.25 0 01-10.5 0zm12-1.5a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                <div>
                    <label class="block text-sm">
                        <span class="text-gray-700 font-semibold">Username :</span>
                        <input name="username" required value="{{$user->username}}" class="block w-full mt-1 text-sm text-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                    </label>
                </div>
                <div class="mt-3">
                    <label class="block text-sm">
                        <span class="text-gray-700 font-semibold">Nomor Handphone :</span>
                        <input name="phone_number" required value="{{$user->phone_number}}" class="block w-full mt-1 text-sm text-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                    </label>
                </div>
                <div class="mt-3">
                    <label class="block text-sm">
                        <span class="text-gray-700 font-semibold">Password Baru :</span> <span class="text-red-600 text-xs">*kosongkan jika tidak ingin mengganti</span>
                        <input name="new_password" class="block w-full mt-1 text-sm text-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:focus:shadow-outline-gray form-input" placeholder="***">
                    </label>
                </div>
                <div class="mt-3">
                    <label class="block text-sm">
                        <span class="text-gray-700 font-semibold">Password Lama :</span> <span class="text-red-600 text-xs">*wajib diisi</span>
                        <input name="password" required type="password" class="block w-full mt-1 text-sm text-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green dark:focus:shadow-outline-gray form-input" placeholder="***">
                    </label>
                </div>
                <div class="mt-3">
                    <button
                        class="w-full inline-block px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                    >
                        Edit Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>

        function init() {

          return {
            imageTypeUrl: "{{$user->photo ? Storage::url($user->photo) : asset('images/user-default.jpg')}}",

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
