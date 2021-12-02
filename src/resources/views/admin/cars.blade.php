@extends('dashboard')

@section('content')
<script>
    const apiKey = window.localStorage.getItem('adminKey');
    const addCar = async () => {
        const modelNew = document.getElementById('new-model').value;
        const yearNew = document.getElementById('new-year').value;
        const priceNew = document.getElementById('new-price').value;

        const madeNew = document.getElementById('new-made').value;
        const typeNew = document.getElementById('new-type').value;
        const imageNew = document.getElementById('new-image').value;
        if (modelNew != "" && yearNew != "" && priceNew != ""){
            let payload;
            if(imageNew == "") {
                payload = {
                    made_id: madeNew,
                    model: modelNew,
                    year: yearNew,
                    price: priceNew,
                    type_id: typeNew,
                }
            } else {
                payload = {
                    made_id: madeNew,
                    model: modelNew,
                    year: yearNew,
                    price: priceNew,
                    type_id: typeNew,
                    desc: imageNew
                }
            }
            let status;
            await fetch("/api/cars", {
                method: 'POST',
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
            if(status == 201) {
                if(!alert('Added.')){window.location.reload();}
            } else {
                alert("Something went wrong");
            }
        } else {
            alert("Fill up all the info.")
        }
    }
</script>
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-col">
    <div class="w-100 flex flex-col">
        <h1 class="text-3xl">Cars</h1>
        <h2 class="text-lg">Add new:</h2>
        <div class="flex flex-row">
            <div class="flex flex-col p-2">
                <label>Made:</label>
                <select id="new-made" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
                    @foreach ($mades as $made)
                        <option value="{{$made->id}}">{{$made->made}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col p-2">
                <label>Model:</label>
                <input id="new-model" type="text" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
            </div>
            <div class="flex flex-col p-2">
                <label>Year:</label>
                <input id="new-year" type="text" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
            </div>
            <div class="flex flex-col p-2">
                <label>Type:</label>
                <select id="new-type" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
                    @foreach ($types as $type)
                        <option value="{{$type->id}}">{{$type->type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col p-2">
                <label>Image:</label>
                <input id="new-image" type="text" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
            </div>
            <div class="flex flex-col p-2">
                <label>Price:</label>
                <input id="new-price" type="number" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
            </div>
        </div>
        <div class="flex flex-col p-2">
            <button onclick="addCar()" class="w-16 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Add</button>
        </div>
    </div>
    @if (count($cars) < 1)
    <p>There are not any cars in the database</p>
    @else
    <table class="w-100">
        <tr class="border-2 border-solid border-black">
            <th class="text-white bg-black">Id</th>
            <th class="text-white bg-black">Made</th>
            <th class="text-white bg-black">Model</th>
            <th class="text-white bg-black">Year</th>
            <th class="text-white bg-black">Type</th>
            <th class="text-white bg-black">Price</th>
            <th class="text-white bg-black">Image</th>
        </tr>
        @foreach ($cars as $car)
            <tr class="hover:bg-redish hover:text-white border-2 border-solid border-black">
                <td class="text-center">
                    <a href="/admin/cars/{{$car->id}}">
                        {{$car->id}}
                    </a>
                </td>
                <td class="text-center">{{$car->made}}</td>
                <td class="text-center">{{$car->model}}</td>
                <td class="text-center">{{$car->year}}</td>
                <td class="text-center">{{$car->type}}</td>
                <td class="text-center">{{$car->price}}</td>
                <td class="text-center">
                    @if ($car->desc === null)
                        NO
                    @else
                        YES
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection