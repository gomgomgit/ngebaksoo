@extends('layouts.auth-client')

@section('main')
    <div class="mt-6">
        <form action="{{route('client.signin.process')}}" method="post">
            @csrf
            <div class="w-full">
                <label class="block text-md font-semibold">
                    <span class="text-white">Username</span>
                    <input
                      class="block text-gray-800 w-full mt-1 text-sm border-none focus:border-green-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-green form-input"
                      placeholder="username"
                      name="username"
                      value="{{old('username')}}"
                    />
                </label>
            </div>
            @error('username')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <div class="w-full mt-4">
                <label class="block text-md font-semibold">
                    <span class="text-white">Password</span>
                    <input
                        type="password"
                        class="block text-gray-800 w-full mt-1 text-sm border-none focus:border-green-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-green form-input"
                        placeholder="password"
                        name="password"
                        value="{{old('password')}}"
                    />
                </label>
            </div>


            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <div class="w-full mt-8">
                <button class="w-full font-semibold rounded-full px-4 py-2 text-sm leading-5 text-green-700 transition-colors duration-150 bg-white border border-transparent hover:bg-green-700 hover:text-white">
                    Login
                </button>
            </div>
        </form>
        <div class="w-full mt-2 text-sm font-medium flex justify-end ">
            <a class="text-white hover:text-green-800" href="/sign-up">belum punya akun? daftar disini</a>
        </div>
    </div>
@endsection
