@extends('layouts.client')

@section('main')
    <div class="">
        <h2 class="text-green-600 font-bold text-center">Pilih Pesanan Anda</h2>
        <div class="flex justify-center items-center gap-6 mt-8">
            @foreach ($types as $type)
                <div class="w-1/5">
                    <a href="/choose-menu/{{$type->id}}" class="cursor-pointer group">
                        <div class="-mb-6 flex justify-center"><img class="w-24 h-24 object-contain group-hover:scale-125 transition-all duration-300" src="{{Storage::url($type->image)}}" alt=""></div>
                        <div class="bg-green-500 text-white p-4 pt-10 rounded-xl text-center">
                            {{$type->name}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
