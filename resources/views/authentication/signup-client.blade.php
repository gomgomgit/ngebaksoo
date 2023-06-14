@extends('layouts.auth-client')

@section('main')
    <div class="mt-6">
        <form action="{{route('client.signup.process')}}" method="post">
            @csrf
            <div class="w-full">
                <label class="block text-md font-semibold">
                    <span class="text-white">Username</span>
                    <input
                        name="username"
                      class="block w-full mt-1 text-sm border-none focus:border-green-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-green form-input"
                      placeholder="username"
                    />
                </label>
                @if ($errors->has('username'))
                    <span class="text-red-500">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="w-full mt-4">
                <label class="block text-md font-semibold">
                    <span class="text-white">No Handphone</span>
                    <input
                        name="phone_number"
                      class="block w-full mt-1 text-sm border-none focus:border-green-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-green form-input"
                      placeholder="08**********"
                    />
                </label>
                @if ($errors->has('phone_number'))
                    <span class="text-red-500">{{ $errors->first('phone_number') }}</span>
                @endif
            </div>
            <div class="w-full mt-4">
                <label class="block text-md font-semibold">
                    <span class="text-white">Password</span>
                    <input
                        name="password"
                        type="password"
                      class="block w-full mt-1 text-sm border-none focus:border-green-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-green form-input"
                      placeholder="password"
                    />
                </label>

                @if ($errors->has('password'))
                    <span class="text-red-500">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="w-full mt-8">
                <button class="w-full font-semibold rounded-full px-4 py-2 text-sm leading-5 text-green-700 transition-colors duration-150 bg-white border border-transparent hover:bg-green-700 hover:text-white">
                    Register
                </button>
            </div>
        </form>
        <div class="w-full mt-2 text-sm font-medium flex justify-end ">
            <a class="text-white hover:text-green-800" href="/sign-in">sudah punya akun? ke halaman login</a>
        </div>
    </div>
@endsection
