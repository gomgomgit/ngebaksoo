@extends('layouts.selection')

@section('main')
    <div class="flex flex-col justify-between h-full">
        <div>
            <h2 class="text-green-600 text-center font-bold w-full">Order Sukses</h2>
            <h4 class="text-green-600 text-center font-bold w-full">Pesanan anda akan segera kami proses</h4>
        </div>
        <div class="grow">
            <div class="mt-3">
                <a href="{{route('client.history')}}"
                class="w-full inline-block rounded-full text-center font-semibold px-5 py-3 text-sm leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                >
                    Lihat Pesanan
                </a>
            </div>
            <div class="mt-3">
                <a href="{{route('client.type')}}"
                class="w-full inline-block rounded-full text-center font-semibold px-5 py-3 text-sm leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                >
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
