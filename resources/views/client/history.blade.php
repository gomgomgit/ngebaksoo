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
            <h2 class="text-green-600 font-bold text-center w-full">Riwayat Pesanan</h2>
            <h2 class="text-green-600 font-bold text-center"></h2>
        </div>
        <div class="mt-4">
            @foreach ($orders as $order)
                <div @click="openDetail({{$order}})" class="flex justify-between cursor-pointer mb-2 border-b-2 border-gray-400 pb-2">
                    <div>
                        <div>
                            <span>{{$order->order_code}}</span>
                            @if ($order->status == 'done')
                                <span
                                class="text-green-700 bg-green-100 px-1 font-semibold leading-tight rounded-full text-xs"
                                >
                                    Done
                                </span>
                            @elseif ($order->status == 'canceled')
                                <span
                                class="text-red-700 bg-red-100 px-1 font-semibold leading-tight rounded-full text-xs"
                                >
                                    Canceled
                                </span>
                            @else
                                <span
                                class="text-yellow-700 bg-yellow-100 px-1 font-semibold leading-tight rounded-full text-xs"
                                >
                                    Pending
                                </span>
                            @endif
                        </div>
                        <div class="text-sm">
                            {{$order->orderDetails->sum('quantity')}} Item
                        </div>
                    </div>
                    <div class="">
                        <div class="text-xs text-end">
                            {{$order->date}}
                        </div>
                        <div class="font-semibold">
                            Rp {{number_format($order->total, 0, '.', '.')}}
                        </div>
                    </div>
                </div>
            @endforeach

            <div>
                {{ $orders->links('pagination::custome') }}
            </div>
        </div>
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
                <template x-if="detail.id">
                    <div class="mt-4 max-h-96">
                        <div class="flex justify-between border-b border-b-gray-700 py-3">
                            <div>
                                <span x-text="detail.order_code"></span>

                                <template x-if="detail.status == 'done'">
                                    <span
                                    class="text-green-700 bg-green-100 px-1 font-semibold leading-tight rounded-full text-xs"
                                    >
                                        Done
                                    </span>
                                </template>
                                <template x-if="detail.status == 'canceled'">
                                    <span
                                    class="text-red-700 bg-red-100 px-1 font-semibold leading-tight rounded-full text-xs"
                                    >
                                        Canceled
                                    </span>
                                </template>
                                <template x-if="detail.status == 'pending'">
                                    <span
                                    class="text-yellow-700 bg-yellow-100 px-1 font-semibold leading-tight rounded-full text-xs"
                                    >
                                        Pending
                                    </span>
                                </template>
                            </div>
                            <div>
                                <span x-text="detail.date"></span>
                            </div>
                        </div>
                        <template x-for="item in detail?.order_details">
                            <div class="flex justify-between items-center border-b border-b-gray-700 py-3">
                                <div>
                                    <div>
                                        <span x-text="item?.menu?.name"></span>
                                    </div>
                                    <div class="text-xs">
                                        notes: <span x-text="item?.notes ?? '-'"></span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs">
                                        Rp <span x-text="item?.menu?.price"></span> x <span x-text="item?.quantity"></span>
                                    </div>
                                    <div>
                                        Rp <span x-text="item?.menu?.price * item?.quantity"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="flex justify-between text-xl mt-4">
                            <div>
                                Total
                            </div>
                            <div>
                                Rp <span x-text="detail.total"></span>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 mt-4">
                            <button type="button"
                                @click="closeDetail()"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                            >
                                Close Detail
                            </button>

                            <template x-if="detail.status == 'pending'">
                                <form method="POST" :action="'/admin/order/cancel/' + detail?.id">
                                @csrf
                                    <button
                                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                                    >
                                        Cancel Order
                                    </button>
                                </form>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    function init() {

      return {
        isModalDetail: false,

        detail: {},

        openDetail(data) {
            this.detail = data
            this.isModalDetail = true
        },
        closeDetail() {
            this.detail = {}
            this.isModalDetail = false
        }
      };

    }
</script>
@endsection
