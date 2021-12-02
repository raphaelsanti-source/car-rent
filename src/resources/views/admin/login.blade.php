@extends('login')

@section('content')
<script>
    const authKey = window.localStorage.getItem("adminKey");
    const login = async () => {
        let email = document.getElementById("email").value;
        let password = document.getElementById("passwd").value;
        if (email == "" || password == "") {
            alert("Uzupełnij dane logowania");
        } else {
            let status = "";
            let resp = "";
            await fetch("/api/adm/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                }),
            })
                .then((response) => [response.json(), response.status])
                .then(async ([data, stat]) => {
                    status = stat;
                    resp = await data;
                });
            if (status == 201) {
                window.localStorage.setItem("adminKey", resp.token);
                window.location.href = "/admin/dashboard";
            } else {
                alert(resp.message);
            }
        }
    };
</script>
<div class="w-100 h-screen flex justify-center items-center bg-redish">
    <div class="p-7 flex flex-col bg-whiter rounded-lg">
        <h2 class="font-semibold text-gray-500 text-lg">CarRent</h2>
        <h1 class="font-bold text-gray-700 text-3xl mb-5">Zaloguj się</h1>
        <label>E-mail:</label>
        <input
            id="email"
            type="text"
            class="p-2 bg-blue-300 border-black border-solid border-b-2 outline-none"
        />
        <label class="mt-2">Hasło:</label>
        <input
            id="passwd"
            type="password"
            class="p-2 bg-blue-300 border-black border-solid border-b-2 outline-none"
        />
        <button
            onclick="login()"
            class="bg-redish rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-redish hover:text-redish hover:bg-whiter transition duration-300"
            >Zaloguj</button
        >
    </div>
</div>

@endsection