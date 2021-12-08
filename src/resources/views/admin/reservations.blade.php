@extends('dashboard')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-col">
    <div class="w-100">
        <h1 class="text-3xl">Reservations</h1>
        <h2 class="text-lg">Info:</h2>
    </div>
    <table class="w-100">
        <tr class="border-2 border-solid border-black">
            <th class="text-white bg-black">Id</th>
            <th class="text-white bg-black">User</th>
            <th class="text-white bg-black">Car</th>
            <th class="text-white bg-black">Start</th>
            <th class="text-white bg-black">End</th>
            <th class="text-white bg-black">Status</th>
        </tr>
        @foreach ($reservations as $item)
            <tr class="hover:bg-redish hover:text-white border-2 border-solid border-black">
                <td class="text-center">
                    <a href="/admin/reservations/{{$item->id}}">
                        {{$item->id}}
                    </a>
                </td>
                <td class="text-center">
                    <a href="/admin/users/{{$item->user_id}}">
                        {{$item->user_id}}
                    </a>
                </td>
                <td class="text-center">
                    <a href="/admin/cars/{{$item->car_id}}">
                        {{$item->car_id}}
                    </a>
                </td>
                <td class="text-center">{{$item->start_date}}</td>
                <td class="text-center">{{$item->end_date}}</td>
                <td class="text-center">{{$item->status}}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection