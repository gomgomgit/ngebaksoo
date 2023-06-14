@extends('layouts.app')

@section('title', 'Customer')

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
                          src="{{$customer->photo ? $customer->photo : asset('images/user-default.jpg')}}"
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
{{--
                  <td class="px-4 py-3 text-sm">
                      <div class="flex items-center gap-4">
                          <button class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Edit">
                              <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                              </svg>
                          </button>
                          <button class="flex items-center justify-between px-1.5 py-1.5 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" aria-label="delete">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                              </svg>
                          </button>
                      </div>
                  </td> --}}
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>
@endsection
