@extends('layouts.app')

@section('title', 'Customer')

@section('content')
<div x-data="init()">
  <form action="/admin/customer">
    <div class="relative text-gray-500 focus-within:text-purple-600">
      <input value="{{$request->search}}" name="search" class="block w-full pr-20 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Username / Phone Number">
      <button class="absolute flex items-center gap-3 inset-y-0 right-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        Cari
      </button>
    </div>
  </form>
  <div class="w-full overflow-hidden rounded-lg shadow-xs mt-4">
      <div class="w-full overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
          <thead>
          <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
          >
              <th class="px-4 py-3">Customer</th>
              <th class="px-4 py-3">Phone Number</th>
              {{-- <th class="px-4 py-3">Action</th> --}}
          </tr>
          </thead>
          <tbody
          class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
              @foreach ($customers as $customer)
                  <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                      <!-- Avatar with inset shadow -->
                      <div
                          class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                      >
                          <img
                          class="object-cover w-full h-full rounded-full"
                          src="{{$customer->photo ? Storage::url($customer->photo) : asset('images/user-default.jpg')}}"
                          alt=""
                          loading="lazy"
                          />
                          <div
                          class="absolute inset-0 rounded-full shadow-inner"
                          aria-hidden="true"
                          ></div>
                      </div>
                      <div>
                          <p class="font-semibold">{{$customer->username}}</p>
                      </div>
                      </div>
                  </td>

                  <td class="px-4 py-3 text-sm">
                    {{$customer->phone_number}}
                    </td>

                    <td class="px-4 py-3 text-sm">
                        <div class="flex items-center gap-4">
                            <button @click="openModal({{$customer}})" class="flex items-center gap-2 justify-between px-3 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                                <div>
                                    <span>ganti password</span>
                                </div>
                            </button>
                        </div>
                    </td>
                  </tr>
              @endforeach
          </tbody>
      </table>

      <div class="">
        {{ $customers->links('pagination::custome') }}
      </div>
  </div>


  <div
    x-show="isModalOpen"
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
      x-show="isModalOpen"
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
      <form action="{{route('customer.changePassword')}}" method="POST">
        @csrf
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
              <span x-text="datacustomer.username"></span>
            </p>
            <div>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password Baru</span>
                <input name="id" type="hidden" :value="datacustomer.id">
                <input name="password" required :value="password" class="block w-full mt-1 text-sm text-gray-700 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="password">
              </label>
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

            <button
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
            >
              Set Password
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
      isModalOpen: false,

      datacustomer: {
        id: 0,
        username: ''
      },
      password: '',

      openModal($data) {
        this.datacustomer = $data
        this.isModalOpen = true
        this.password = ''
      },
      closeDetail() {
        this.datacustomer = {
          id: 0,
          username: ''
        }
        this.password = ''
        this.isModalOpen = false
      }

    };

  }

</script>
@endsection
