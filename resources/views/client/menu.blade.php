@extends('layouts.client')

@section('main')

@php
use App\Models\Cart;

function selectedMenus() {
    return Auth::guard('customer')->user() ? Cart::with('menu')->where('customer_id', Auth::guard('customer')->user()->id)->get()->pluck('menu.id')->toArray() : 0;
}
@endphp
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
            <h2 class="text-green-600 font-bold text-center w-full">Pilih Pesanan Anda</h2>
            <h2 class="text-green-600 font-bold text-center"></h2>
        </div>
        <div class="flex justify-center items-center gap-6 mt-8 flex-wrap">
            @foreach ($menus as $menu)
                <div class="w-1/5 box-border">
                    <div class="group rounded-xl bg-green-500 p-3">
                        <div class="flex justify-center rounded-xl bg-white overflow-hidden"><img class="w-full h-24 rounded-xl object-cover group-hover:scale-125 transition-all duration-300" src="{{$menu->image ? Storage::url($menu->image) : asset('images/food-default.png')}}" alt=""></div>
                        <div class="text-white text-sm rounded-xl grid grid-cols-2 my-3">
                            <div class="">
                                <p class="font-semibold text-md">{{$menu->name}}</p>
                                <p>{{$menu->description}}</p>
                            </div>
                            <div class="text-end font-semibold">
                                Rp {{number_format($menu->price, 0, '.', '.')}}
                            </div>
                        </div>
                        <div class="mt-5">
                            @if (Auth::guard('customer')->user())
                                <div>
                                    @if (in_array($menu->id, selectedMenus()))
                                        <div class="flex justify-center items-center gap-2 w-full font-semibold rounded-full px-4 py-2 text-sm leading-5 transition-colors duration-150 border border-transparent bg-green-700 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>Ditambahkan</p>
                                        </div>
                                    @else
                                        <button @click="openDetail({{$menu}})" class="flex justify-center items-center gap-2 w-full font-semibold rounded-full px-4 py-2 text-sm leading-5 text-green-700 transition-colors duration-150 bg-white border border-transparent hover:bg-green-700 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>Tambahkan</p>
                                        </button>
                                    @endif
                                </div>
                            @else
                                <a href="/sign-in" class="flex justify-center items-center gap-2 w-full font-semibold rounded-full px-4 py-2 text-sm leading-5 text-green-700 transition-colors duration-150 bg-white border border-transparent hover:bg-green-700 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p>Tambahkan</p>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div
            x-show="isModalAdd"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        >
            <div
                x-show="isModalAdd"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2"
                @click.away="isModalAdd = false"
                @keydown.escape="isModalAdd = false"
                class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog"
                id="modal"
            >
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <form method="POST" action="/add-to-cart/" enctype="multipart/form-data">
                @csrf
                    <header class="flex justify-between">

                        <p
                        class="mb-2 text-lg font-semibold text-gray-700"
                        >
                            <span x-text="menu.name"></span>
                        </p>
                        <button
                        type="button"
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover: hover:text-gray-700"
                        aria-label="close"
                        @click="isModalAdd = false"
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
                        <div class="flex justify-between items-start">
                            <div>
                                <div>
                                    <p class="text-lg" x-text="menu.description"></p>
                                    <input name="menu_id" type="hidden" :value="menu.id">
                                </div>
                                <div class="mt-2 flex items-end gap-4">
                                    <p class="text-md font-semibold text-gray-400">
                                        Rp <span x-text="menu.price"></span> x  <span x-text="menu.qty"></span>
                                    </p>
                                    <p class="text-xl font-bold">
                                        Rp <span x-text="menu.price * menu.qty"></span>
                                    </p>
                                </div>
                                <div class="flex gap-2 items-center mt-3">
                                    <button type="button" @click="minQty()">
                                        <div :class="menu.qty <= 1 ? 'cursor-pointer bg-gray-300 p-2 rounded-lg text-gray-700' : 'cursor-pointer bg-green-500 p-2 rounded-lg text-white'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div class="border-2 border-gray-300 w-8 h-8 flex justify-center items-center rounded-lg">
                                        <span x-text="menu.qty"></span>
                                    </div>
                                    <button type="button" @click="addQty()">
                                        <div class="cursor-pointer bg-green-500 p-2 rounded-lg text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                    </button>
                                    <input name="qty" type="hidden" :value="menu.qty">
                                </div>
                                <div class="mt-4">
                                    <p class="text-md mb-2">Catatan :</p>
                                    <textarea class="border border-gray-300 rounded-lg w-full p-2" name="notes" id="" rows="3" cols="25"></textarea>
                                </div>
                            </div>
                            <div class="bg-green-500 p-3 rounded-xl">
                                <div class="rounded-xl overflow-hidden">
                                    <img class="object-cover object-center h-30 w-full" :src="menu.image ?? '/images/food-default.png'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer
                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50"
                    >
                        <button type="button"
                        @click="isModalAdd = false"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                        >
                        Cancel
                        </button>
                        <button
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                        >
                        Tambahkan
                        </button>
                    </footer>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('script')

<script>
    function init() {

      return {
        isModalAdd: false,

        menu: {},

        minQty() {
            if (this.menu.id && this.menu.qty > 1) {
                this.menu.qty -= 1
            }
        },
        addQty() {
            if (this.menu.id) {
                this.menu.qty += 1
            }
        },
        openDetail(data) {
            this.menu = {...data, qty: 1}
            this.isModalAdd = true
        }
      };

    }
</script>
@endsection
