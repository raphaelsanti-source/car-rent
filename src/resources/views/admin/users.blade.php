@extends('dashboard')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-col">
    <div class="w-100">
        <h1 class="text-3xl">Users</h1>
        <h2 class="text-lg">Info:</h2>
    </div>
    <table class="w-100">
        <tr class="border-2 border-solid border-black">
            <th class="text-white bg-black">Id</th>
            <th class="text-white bg-black" >Name</th>
            <th class="text-white bg-black">E-mail</th>
        </tr>
        @foreach ($users as $item)
            <tr class="hover:bg-redish hover:text-white border-2 border-solid border-black">
                <td class="text-center">
                    <a href="/admin/users/{{$item->id}}">
                        {{$item->id}}
                    </a>
                </td>
                <td class="text-center">{{$item->name}}</td>
                <td class="text-center">{{$item->email}}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection