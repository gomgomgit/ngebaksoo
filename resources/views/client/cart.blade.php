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
            <h2 class="text-green-600 font-bold text-center w-full">Keranjang</h2>
            <h2 class="text-green-600 font-bold text-center"></h2>
        </div>
        <form action="{{route('client.checkout')}}" method="POST">
            @csrf
            <div class="mt-4">
                @foreach ($carts as $cart)
                    <div class="flex justify-between mb-2 border-b-2 border-gray-400 pb-2">
                        <div class="flex gap-3 items-center">
                            <div class="bg-green-500 p-1 rounded-lg overflow-hidden">
                                <img class="w-24 h-24 object-cover rounded-lg" src="{{$cart->menu->image ? Storage::url($cart->menu->image) : asset('images/food-default.png')}}" alt="">
                            </div>
                            <div>
                                <div class="text-lg font-semibold">
                                    {{$cart->menu->name}}
                                </div>
                                <div class="text-sm">
                                    notes: {{$cart->notes ?? '-'}}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-sm flex items-center gap-1">
                                <div>
                                    Rp {{number_format($cart->menu->price)}}
                                </div>
                                <div>
                                    x{{$cart->quantity}}
                                </div>
                            </div>
                            <div class="font-semibold text-lg">
                                Rp {{number_format($cart->quantity * $cart->menu->price)}}
                            </div>
                            <div class="flex h-full rounded-xl overflow-hidden">
                                <div @click="openDetail({{$cart}})" class="cursor-pointer bg-yellow-400 hover:bg-yellow-500 duration-150 p-2 text-white h-full flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>
                                <form action="{{route('client.delete.cart', $cart->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$cart->id}}">
                                    <div @click="deleteCart" class="cursor-pointer bg-red-500 hover:bg-red-600 duration-150 p-2 text-white h-full flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-between mb-2 border-b-2 border-gray-400 pb-2">
                    <div class="text-lg font-semibold">
                        Total:
                    </div>
                    <div class="text-lg font-semibold">
                        Rp
                        {{
                        $carts->sum(function($t){
                            return $t->quantity * $t->menu->price;
                        });
                        }}
                    </div>
                </div>
                <div class="mt-3">
                    <p class="mb-2 font-semibold">Alamat : <span class="text-red-500 text-xs">*wajib diisi</span></p>
                    <div>
                        <textarea name="address" class="p-2 w-full rounded-lg border-2 border-green-500" rows="4"></textarea>
                    </div>
                </div>
                <p class="text-red-500">*sistem ini merupakan sistem COD (cash And Delivery)</p>
                @if ($errors)
                    <p class="text-red-500">{{ $errors->first() }}</p>
                @endif
                <div class="mt-3">
                    <button
                    class="w-full font-semibold px-5 py-3 text-sm leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                    >
                    Pesan Sekarang
                    </button>
                </div>
            </div>
        </form>
        <div
        x-show="isModalDetail"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        >
            <div
                x-show="isModalDetail"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2"
                @click.away="closeDetail()"
                @keydown.escape="closeDetail()"
                class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog"
                id="modal"
            >
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <form method="POST" action="/edit-cart/" enctype="multipart/form-data">
                @csrf
                    <header class="flex justify-between">

                        <p
                        class="mb-2 text-lg font-semibold text-gray-700"
                        >
                            <span x-text="cart?.menu?.name"></span>
                        </p>
                        <button
                        type="button"
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover: hover:text-gray-700"
                        aria-label="close"
                        @click="closeDetail()"
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
                                    <p class="text-lg" x-text="cart?.menu?.description"></p>
                                    <input name="cart_id" type="hidden" :value="cart.id">
                                </div>
                                <div class="mt-2 flex items-end gap-4">
                                    <p class="text-md font-semibold text-gray-400">
                                        Rp <span x-text="cart?.menu?.price"></span> x  <span x-text="cart?.quantity"></span>
                                    </p>
                                    <p class="text-xl font-bold">
                                        Rp <span x-text="cart?.menu?.price * cart.quantity"></span>
                                    </p>
                                </div>
                                <div class="flex gap-2 items-center mt-3">
                                    <button type="button" @click="minQty()">
                                        <div :class="cart?.quantity <= 1 ? 'cursor-pointer bg-gray-300 p-2 rounded-lg text-gray-700' : 'cursor-pointer bg-green-500 p-2 rounded-lg text-white'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div class="border-2 border-gray-300 w-8 h-8 flex justify-center items-center rounded-lg">
                                        <span x-text="cart?.quantity"></span>
                                    </div>
                                    <button type="button" @click="addQty()">
                                        <div class="cursor-pointer bg-green-500 p-2 rounded-lg text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </div>
                                    </button>
                                    <input name="qty" type="hidden" :value="cart?.quantity">
                                </div>
                                <div class="mt-4">
                                    <p class="text-md mb-2">Catatan :</p>
                                    <textarea :value="cart?.notes" class="border border-gray-300 rounded-lg w-full p-2" name="notes" id="" rows="3" cols="25"></textarea>
                                </div>
                            </div>
                            <div class="bg-green-500 p-3 rounded-xl">
                                <div class="rounded-xl overflow-hidden">
                                    <img class="object-cover object-center h-30 w-full" :src="cart?.menu?.image ?? '/images/food-default.png'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer
                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50"
                    >
                        <button type="button"
                        @click="closeDetail()"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                        >
                        Cancel
                        </button>
                        <button
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                        >
                        Edit
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
        isModalDetail: false,

        cart: {},

        minQty() {
            if (this.cart.id && this.cart.quantity > 1) {
                this.cart.quantity -= 1
            }
        },
        addQty() {
            if (this.cart.id) {
                this.cart.quantity += 1
            }
        },
        openDetail(data) {
            console.log(data)
            this.cart = data
            this.isModalDetail = true
        },
        closeDetail() {
            this.cart = {}
            this.isModalDetail = false
        },
        deleteCart(event, callback) {
            event.preventDefault()
            let form = event.target.closest('form')
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Item akan dihapus dari Keranjang",
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
