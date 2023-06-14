@extends('layouts.app')

@section('title', 'Dashboard')

@section('head-addon')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
<!-- Cards -->
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card -->
    <div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
    <div
        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
        ></path>
        </svg>
    </div>
    <div>
        <p
        class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
        Total Customer
        </p>
        <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
        {{$counter->customer}} User
        </p>
    </div>
    </div>
    <!-- Card -->
    <div
    class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
    >
    <div
        class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
        </svg>
    </div>
    <div>
        <p
        class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
        Total Menu
        </p>
        <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
            {{$counter->menu}} Menu
        </p>
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
        Penjualan Bulan Ini
        </p>
        <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
            {{$counter->sold}} Item
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
        Penghasilan Bulan Ini
        </p>
        <p
        class="text-lg font-semibold text-gray-700 dark:text-gray-200"
        >
            Rp {{number_format($counter->profit, 0, '.', '.')}}
        </p>
    </div>
    </div>
</div>

{{-- CTA --}}
@if ($counter->order > 0)
    <div>
        <a class="flex items-center justify-between p-4 mb-4 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple" href="/admin/order">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span>Ada {{$counter->order}} Pesanan yang perlu disiapkan</span>
            </div>
            <span>Cek Pesanan →</span>
        </a>
    </div>
@endif

<!-- Charts -->
<h2
class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
>
Charts
</h2>
<div
  class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
>
  <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
    Revenue 6 month back
  </h4>
  <canvas id="line"></canvas>
</div>
</div>

@section('script')

<script>
    var ctx = document.getElementById('line').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',

        data: {
            labels: [
                @foreach ($revenue as $rev)
                    '{!! $rev->month !!}',
                @endforeach
            ],
            datasets: [
            {
                label: 'Revenue',
                backgroundColor: '#0694a2',
                borderColor: '#0694a2',
                data: [
                    @foreach ($revenue as $rev)
                    {!! $rev->value !!},
                    @endforeach
                ],
                fill: false,
            }
            ],
        },
        options: {
            responsive: true,
            legend: {
            display: false,
            },
            tooltips: {
            mode: 'index',
            intersect: false,
            },
            hover: {
            mode: 'nearest',
            intersect: true,
            },
            scales: {
            x: {
                display: true,
                scaleLabel: {
                display: true,
                labelString: 'Month',
                },
            },
            y: {
                display: true,
                scaleLabel: {
                display: true,
                labelString: 'Value',
                },
            },
            },
        },
    });
</script>
@endsection
@endsection
