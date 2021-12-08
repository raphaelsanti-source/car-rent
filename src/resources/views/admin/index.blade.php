@extends('dashboard')

@section('content')
<script>
    const apiKey = window.localStorage.getItem('adminKey');
    // const time = async () => {

    // }
    const addMade = async () => {
        const newMade = document.getElementById('new-made').value;
        if (newMade != ""){
            let status;
            await fetch("/api/cars/mades", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${apiKey}`
                },
                body: JSON.stringify({
                    made: newMade
                }),
            })
            .then(response => response.status)
            .then(stat => {
                    status = stat;
            });
            if(status == 201) {
                document.getElementById('new-made').value = "";
                alert("Added.")
            } else {
                alert("Something went wrong");
            }
        } else {
            alert("Specify new made first.")
        }
    }
    const addType = async () => {
        const newMade = document.getElementById('new-type').value;
        if (newMade != ""){
            let status;
            await fetch("/api/cars/types", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${apiKey}`
                },
                body: JSON.stringify({
                    type: newMade
                }),
            })
            .then(response => response.status)
            .then(stat => {
                    status = stat;
            });
            if(status == 201) {
                document.getElementById('new-type').value = "";
                alert("Added.")
            } else {
                alert("Something went wrong");
            }
        } else {
            alert("Specify new type first.")
        }
    }
    const addUser = async () => {
        const admName = document.getElementById('usr-name').value;
        const admEmail = document.getElementById('usr-email').value;
        const admPass = document.getElementById('usr-pass').value;
        const admPassConf = document.getElementById('usr-pass-conf').value;
        if (admName != "" && admEmail != "" && admPass != "" && admPassConf != ""){
            let status;
            await fetch("/api/adm/register", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${apiKey}`
                },
                body: JSON.stringify({
                    name: admName,
                    email: admEmail,
                    password: admPass,
                    password_confirmation: admPassConf
                }),
            })
            .then(response => response.status)
            .then(stat => {
                    status = stat;
            });
            if(status == 201) {
                document.getElementById('usr-name').value = "";
                document.getElementById('usr-email').value = "";
                document.getElementById('usr-pass').value = "";
                document.getElementById('usr-pass-conf').value = "";
                alert("Added.")
            } else {
                alert("Something went wrong");
            }
        } else {
            alert("Fill up all the info.")
        }
    }
</script>
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-wrap">
    <div class="w-full p-2">
        <h1 class="text-3xl">Admin panel</h1>
        {{-- <h2 class="text-2xl">16:50</h2> --}}
    </div>
    {{-- <div class="w-100 md:w-1/2 p-4 flex flex-col">
        <h2 class="text-lg">Advance time</h2>
        <div class="flex flex-row">
            <button class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">-24h</button>
            <button class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">-1h</button>
            <button class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">+1h</button>
            <button class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">+24h</button>
        </div>
    </div> --}}
    <div class="w-100 md:w-1/2 p-4 flex flex-col">
        <h2 class="text-lg">Add made</h2>
        <input id="new-made" type="text" class="w-48 border-2 border-solid border-black p-2 m-1 rounded-md">
        <button onclick="addMade()" class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Add</button>
    </div>
    <div class="w-100 md:w-1/2 p-4 flex flex-col">
        <h2 class="text-lg">Add type</h2>
        <input id="new-type" type="text" class="w-48 border-2 border-solid border-black p-2 m-1 rounded-md">
        <button onclick="addType()" class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Add</button>
    </div>
    <div class="w-100 md:w-1/2 p-4 flex flex-col">
        <h2 class="text-lg">Add admin</h2>
        <label>Name:</label>
        <input id="usr-name" type="text" class="w-48 border-2 border-solid border-black p-2 m-1 rounded-md">
        <label>Email:</label>
        <input id="usr-email" type="text" class="w-48 border-2 border-solid border-black p-2 m-1 rounded-md">
        <label>Password:</label>
        <input id="usr-pass" type="password" class="w-48 border-2 border-solid border-black p-2 m-1 rounded-md">
        <label>Password confirmation:</label>
        <input id="usr-pass-conf" type="password" class="w-48 border-2 border-solid border-black p-2 m-1 rounded-md">
        <button onclick="addUser()" class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Add</button>
    </div>
</div>
@endsection