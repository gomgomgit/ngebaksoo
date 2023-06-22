@extends('layouts.app')

@section('title', 'Order')

@section('head-addon')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('content')
<div x-data="init()">
  {{-- Table --}}
  <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
      <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
          <thead>
          <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
          >
              <th class="px-4 py-3">Code</th>
              <th class="px-4 py-3">Customer</th>
              <th class="px-4 py-3">Phone NUmber</th>
              <th class="px-4 py-3">Item</th>
              <th class="px-4 py-3">Total</th>
              <th class="px-4 py-3">Action</th>
          </tr>
          </thead>
          <tbody
          class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
              @foreach ($orders as $order)
                  <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div>
                            <p class="font-semibold">{{$order->order_code}}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                        <div>
                            <p class="font-semibold">{{$order->customer->username}}</p>
                        </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div>
                            <p class="">{{$order->customer->phone_number}}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div>
                            <p class="">{{$order->orderDetails->sum('quantity')}} Item</p>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div>
                            <p class="font-semibold">Rp {{number_format($order->total, 0, '.', '.')}}</p>
                        </div>
                    </td>

                    <td class="px-4 py-3 text-sm">
                      <div class="flex items-center gap-4">
                          <button @click="openDetail({{$order}})" class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-full active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green" aria-label="Edit">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="none" class="w-4 h-4">
                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                </svg>
                          </button>
                          <a href="{{route('order.invoice', $order->id)}}" class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-full active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" aria-label="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                            </svg>
                          </a>
                      </div>
                    </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  <div
    x-show="isDetailOpen"
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
      x-show="isDetailOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0  transform translate-y-1/2"
      @click.away="closeDetail()"
      @keydown.escape="closeDetail()"
      class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
      role="dialog"
      id="modal"
    >
      <header class="flex justify-end">
        <button
        type="button"
          class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
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
        <p
          class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
        >
          Detail Order
        </p>
        <div>
          <div class="flex justify-between">
            <div class="mb-2">
              <p
                class="text-md font-medium text-gray-700 dark:text-gray-300"
                x-text="dataorder.customer.username"
              >
              </p>
              <p
                class="text-sm text-gray-700 dark:text-gray-300"
                x-text="dataorder.customer.phone_number"
              >
              </p>
            </div>
            <p
              class="mb-2 text-md text-gray-700 dark:text-gray-300"
              x-text="dataorder.order_code"
            >
            </p>
          </div>
          <div class="mt-4">
            <table class="w-full whitespace-no-wrap">
                <template x-for="detail in dataorder.order_details">
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="">
                        <p
                          class="font-medium text-md text-gray-700 dark:text-gray-300"
                          x-text="detail.menu.name"
                        ></p>
                      </td>
                      <td class="">
                        <p class="font-medium"><span x-text="detail.quantity + ' pcs'"></span> x <span x-text="'Rp ' + detail.price"></span></p>
                      </td>
                      <td class="">
                        <p class="text-end font-medium text-md text-gray-700 dark:text-gray-300"><span x-text="'Rp ' + detail.subtotal"></span></p>
                      </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="pb-4">
                        <p
                          class="text-sm text-gray-700 dark:text-gray-300"
                          x-text="'catatatan: ' + (detail.notes ?? '-')"
                        ></p>
                      </td>
                    </tr>
                  </tbody>
                </template>
            </table>
          </div>

          <div class="border-b border-gray-700 mb-2 flex justify-between">
            <p
              class="mb-1 text-md font-medium text-gray-700 dark:text-gray-300"
            >
              Total :
            </p>
            <p
              class="mb-1 text-md font-medium text-gray-700 dark:text-gray-300"
            >
              Rp <span x-text="dataorder.total"></span>
            </p>
          </div>
          <div class="">
            <p
              class="mb-1 text-md font-medium text-gray-700 dark:text-gray-300"
            >
              Alamat :
            </p>
            <p
              class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
              x-text="dataorder.address"
            >
            </p>
          </div>
        </div>
      </div>
      <footer
        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-4 sm:flex-row bg-gray-50 dark:bg-gray-800"
      >

      <button type="button"
        @click="closeDetail()"
        class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
      >
        Close Detail
      </button>
        <form method="POST" :action="'/admin/order/cancel/' + dataorder.id">
          @csrf
          <button
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
          >
            Cancel Order
          </button>
        </form>
        <form method="POST" :action="'/admin/order/done/' + dataorder.id">
          @csrf
          <button
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Finish Order
          </button>
        </form>
      </footer>
    </div>
  </div>
</div>

<script>

  function init() {

    return {
      isDetailOpen: false,

      dataorder: {
        id: 0,
        customer: '',
        order_details: []
      },

      openDetail($data) {
        this.dataorder = $data
        this.isDetailOpen = true
      },
      closeDetail() {
        this.dataorder = {
          id: 0,
          customer: '',
          order_details: []
        }
        this.isDetailOpen = false
      }

    };

  }

</script>
@endsection
