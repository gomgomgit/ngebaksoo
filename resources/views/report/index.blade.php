@extends('layouts.app')

@section('title', 'Laporan')

@section('head-addon')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
<!-- Cards -->
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card -->
    <div
    class="flex items-center col-span-2 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
    <div
        class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
      </svg>

    </div>
    <div>
        <p
        class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
        Tanggal
        </p>
        <form action="/admin/report">
            <div class="flex items-center gap-4">
                <div class="flex-grow">
                    <label class="block text-sm">
                        <input type="date" name="start" value="{{$data->start}}" class="block w-full mt-1 text-sm text-gray-700 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                    </label>
                </div>
                <div>
                    sampai
                </div>
                <div class="grow">
                    <label class="block text-sm">
                        <input type="date" name="end" value="{{$data->end}}" class="block w-full mt-1 text-sm text-gray-700 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                    </label>
                </div>
                <div>
                    <button href="" class="flex items-center justify-between px-4 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple gap-3">
                        <span>Atur</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                          </svg>

                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <!-- Card -->
    <div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
    <div
        class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
        ></path>
        </svg>
    </div>
    <div>
        <p
        class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
        Total Penjualan
        </p>
        <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
            {{$data->orders->sum(function ($q) {
                return $q->orderDetails->sum('quantity');
            })}} Item
        </p>
    </div>
    </div>
    <!-- Card -->
    <div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
    <div
        class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
            fill-rule="evenodd"
            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
            clip-rule="evenodd"
            ></path>
        </svg>
    </div>
    <div>
        <p
        class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
        Total Penghasilan
        </p>
        <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
            Rp {{number_format($data->orders->sum('total'), 0, '.', '.')}}
        </p>
    </div>
    </div>
</div>

<div x-data="init()">
    {{-- Table --}}
    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
        <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Item</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Action</th>
            </tr>
            </thead>
            <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
            >
                @foreach ($data->orders as $order)
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                          <div class="flex items-center text-sm">
                          <div>
                              <p class="font-semibold">{{$order->customer->username}}</p>
                          </div>
                          </div>
                      </td>
                      <td class="px-4 py-3">
                          <div>
                              <p class="">{{date('d-M-Y', strtotime($order->date))}}</p>
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
          Close
        </button>
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
          console.log($data)
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
