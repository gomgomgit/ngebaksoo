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
            <form action="{{route('client.account.edit')}}" method="POST">
                @csrf
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
@endsection
