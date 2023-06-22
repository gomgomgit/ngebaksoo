<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ngebaksoo</title>
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
    />
    <script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
    ></script>
    <script src="{{asset('windmill/public/assets/js/init-alpine.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('windmill/public/assets/css/tailwind.output.css')}}" />
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style>
        @media print
        {
            @page
            {
                size: A5;
            }
            .noprint {display:none}
            .wrapper {
                padding: 0
            }
            .info {
                font-size: 14px
            }
        }

        @media screen
        {
        }
    </style>
  </head>
  <body class="">
    <div
      class="min-h-screen box-border px-96 pt-8 flex flex-col wrapper"
    >
        <div class="flex flex-col justify-between h-full">
            <div id="print">
                <div class="flex items-center justify-center">
                    <img class="w-48" src="{{asset('images/logo-bg.png')}}" alt="">
                </div>
                <div class="flex justify-between border-b border-gray-700 py-4 text-sm info">
                    <div class="">
                        <div>
                            Nama : {{$order->customer->username}}
                        </div>
                        <div>
                            No Hp : {{$order->customer->phone_number}}
                        </div>
                        <div>
                            Tanggal : {{$order->date}}
                        </div>
                    </div>
                    <div>
                        <div>
                            Alamat :
                        </div>
                        <div>
                            {{$order->address}}
                        </div>
                    </div>
                </div>
                <div class="mt-3 pb-3 border-b border-gray-700">
                    <div>
                        Kode Order : {{$order->order_code}}
                    </div>
                </div>
                @foreach ($order->orderDetails as $detail)
                    <div class="flex justify-between items-center border-b border-b-gray-700 py-3">
                        <div>
                            <div>
                                {{$detail->menu->name}}
                            </div>
                            <div class="text-xs">
                                notes: {{$detail->notes}}
                            </div>
                        </div>
                        <div>
                            <div class="text-xs">
                                Rp {{$detail->menu->price}} x {{$detail->quantity}}
                            </div>
                            <div>
                                Rp {{$detail->menu->price * $detail->quantity}}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-between text-xl mt-4">
                    <div>
                        Total :
                    </div>
                    <div>
                        Rp {{$order->total}}
                    </div>
                </div>
            </div>
            <div class="grow noprint mt-12">
                <div class="mt-3">
                    <button
                    onclick="printInvoice()"
                    class="w-full inline-block rounded-full text-center font-semibold px-5 py-3 text-sm leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                    >
                        Print Invoice
                </button>
                </div>
                <div class="mt-3">
                    <a href="{{url()->previous()}}"
                    class="w-full inline-block rounded-full text-center font-semibold px-5 py-3 text-sm leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent sm:px-4 sm:py-2 active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                    >
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printInvoice() {
            window.print()
        }
    </script>
  </body>
</html>
