@extends('dashboard')

@section('content')
<script>
    const apiKey = window.localStorage.getItem('adminKey');


    const del = async () => {
    const id = document.getElementById('num').value;

        if(confirm("Are you sure?")){
            let status;
            await fetch('/api/cars/' + id, {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${apiKey}`
                }
            }).then(response => response.status)
            .then(stat => {
                    status = stat;
            });
            if(status == 200) {
                if(!alert('Deleted.')){window.location.href="/admin/cars";}
            } else {
                alert("Something went wrong");
            }
        }
    }

    const update = async () => {
    const id = document.getElementById('num').value;

        const newMade = document.getElementById('made').value;
        const newType = document.getElementById('type').value;

        const newModel = document.getElementById('model').value;
        const newYear = document.getElementById('year').value;
        const newPrice = document.getElementById('price').value;
        const newDesc = document.getElementById('desc').value;
        if(newModel != "" && newYear != "" && newPrice != ""){
            let payload;
            if(newDesc != "") {
                payload = {
                    made_id: newMade,
                    model: newModel,
                    year: newYear,
                    type_id: newType,
                    price: newPrice,
                    desc: newDesc
                }
            } else {
                payload = {
                    made_id: newMade,
                    model: newModel,
                    year: newYear,
                    type_id: newType,
                    price: newPrice,
                    desc: null
                }
            }
            let status;
            await fetch("/api/cars/"+id, {
                method: 'PUT',
                headers: {
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${apiKey}`
                },
                body: JSON.stringify(payload),
            })
            .then(response => response.status)
            .then(stat => {
                    status = stat;
            });
            if(status == 200) {
                if(!alert('Updated.')){window.location.reload();}
            } else {
                alert("Something went wrong");
            }
        } else {
            alert("Info update is missing some information.")
        }
    }
</script>
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-col">
<h1 class="text-3xl">Car No.{{$car->id}}</h1>
<h2 class="text-lg">Info</h2>
<div>
    <input type="text" id="num" hidden value="{{$car->id}}">
    <label>Made</label>
    <select id="made" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
        @foreach ($mades as $made)
            @if ($made->id === $car->made_id)
            <option selected value="{{$made->id}}">{{$made->made}}</option>
            @else
            <option value="{{$made->id}}">{{$made->made}}</option>
            @endif
        @endforeach
    </select>
    <label>Model</label>
    <input type="text" id="model" value="{{$car->model}}" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
    <label>Year</label>
    <input type="text" id="year" value="{{$car->year}}" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
    <label>Type</label>
    <select id="type" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
        @foreach ($types as $type)
            @if ($type->id === $car->type_id)
            <option selected value="{{$type->id}}">{{$type->type}}</option>
            @else
            <option value="{{$type->id}}">{{$type->type}}</option>
            @endif
        @endforeach
    </select>
    <label>Image</label>
    <input type="text" id="desc" value="{{$car->desc}}" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
    <label>Price</label>
    <input type="number" id="price" value="{{$car->price}}" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
    <button onclick="update()" class="w-24 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Update</button>
    <button onclick="del()" class="w-24 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Delete</button>
</div>
</div>
@endsection