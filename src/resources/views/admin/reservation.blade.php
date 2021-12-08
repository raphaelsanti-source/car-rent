@extends('dashboard')

@section('content')
<script>
    const apiKey = window.localStorage.getItem('adminKey');
    
    setTimeout(() => {
        let end_date_og = document.getElementById('end_date_og').value;
        // console.log(end_date_og)
        let str = end_date_og.replace(' ', 'T');
        // str = str.substring(0, 10);
        document.getElementById('end_date').value = str;
    }, 200);
    
    const updt = async () => {
        const toUpdate = document.getElementById('status').value;
        const num = document.getElementById('num').value;
        let status;
        await fetch(`/api/reservations/${num}`, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${apiKey}`,
            },
            body: JSON.stringify({
                status: toUpdate
            })
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
    }

    const chng = async () => {
        const num = document.getElementById('num').value;
        const newEndDate = document.getElementById('end_date').value;
        let str = newEndDate.replace('T', ' ');
        let status;
        await fetch("/api/reservations/"+num, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${apiKey}`,
            },
            body: JSON.stringify({
                end_date: str
            }),
        }).then((response) => {
            status = response.status;
        });
        if (status == 200) {
            if(!alert('Updated.')){window.location.reload();}
        } else {
            alert("Something went wrong.");
            console.log(status);
        }
    }
</script>
<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2 flex flex-col">
    <div class="w-100">
        <h1 class="text-3xl">Reservation No.{{$reservation->id}}</h1>
        <h2 class="text-lg">Info:</h2>
        <h3 class="text-md">User No.
            <a href="/admin/users/{{$reservation->user_id}}">{{$reservation->user_id}}</a>
        </h3>
    </div>
    <div class="w-100 ">
        <input type="hidden" id="num" value="{{$reservation->id}} flex flex-col">
        <div class="flex flex-row p:2">
            <select id="status" class="w-32 border-2 border-solid border-black p-2 m-1 rounded-md">
                <option value="waiting" 
                @if ($reservation->status == 'waiting')
                    selected
                @endif>Waiting</option>
                <option value="canceled" 
                @if ($reservation->status == 'canceled')
                    selected
                @endif>Canceled</option>
                <option value="accepted"
                @if ($reservation->status == 'accepted')
                selected
                @endif
                >Accepted</option>
                <option value="ongoing"
                @if ($reservation->status == 'ongoing')
                    selected
                @endif
                >Ongoing</option>
                <option value="ended"
                @if ($reservation->status == 'ended')
                    selected
                @endif
                >Ended</option>
            </select>
            <button onclick="updt()" class="w-24 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Change</button>
        </div>
        <div class="flex flex-row p:2">
            <input type="hidden" id="end_date_og" value="{{$reservation->end_date}}">
            <input type="datetime-local" id="end_date">
            <button onclick="chng()" class="w-24 border-2 border-solid border-black p-2 m-1 rounded-md hover:text-white hover:bg-redish hover:border-transparent transition duration-300">Change</button>
        </div>
    </div>
</div>
@endsection