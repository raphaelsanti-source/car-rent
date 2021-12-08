@extends('dashboard')
@section('content')
<script>
    const apiKey = window.localStorage.getItem('adminKey');
    const ban = async () => {
        const num = document.getElementById('num').value;
        let status;
        await fetch(`/api/usr/show/${num}`, {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${apiKey}`,
            },
        })
        .then(response => response.status)
        .then(stat => {
            status = stat;
        });
        if(status == 200) {
            if(!alert('Banned.')){window.location.href='/admin/users';}
        } else {
            alert("Something went wrong");
        }
    }
</script>
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-col">
    <div class="w-100">
        <h1 class="text-3xl">User No.{{$user->id}}</h1>
        <h2 class="text-lg">Info:</h2>
        <h3 class="text-md">{{$user->name}}</h3>
        <h3 class="text-md">{{$user->email}}</h3>
    </div>
    <input type="hidden" id="num" value="{{$user->id}}">
    <button onclick="ban()" class="w-24 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Ban account (delete)</button>
</div>
@endsection