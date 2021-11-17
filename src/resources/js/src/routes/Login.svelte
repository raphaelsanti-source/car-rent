<script>
    import auth from "../stores/auth";
    if ($auth.key != null) {
        window.location.href = "/#/profile";
    }
    let email = "";
    let password = "";
    const login = async () => {
        if (email == "" || password == "") {
            alert("Uzupełnij dane logowania");
        } else {
            let status = "";
            let resp = "";
            await fetch("/api/usr/login", {
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
                $auth.key = resp.token;
                window.localStorage.setItem("apiKey", resp.token);
                window.location.href = "/#/profile";
            } else {
                alert(resp.message);
            }
            //             {
            //     "name": "test3",
            //     "email": "test3@xd.com",
            //     "password": "test",
            //     "password_confirmation": "test"
            // }
        }
    };
</script>

<div class="w-100 h-screen flex justify-center items-center bg-blue-500">
    <div class="p-7 flex flex-col bg-whiter rounded-lg">
        <h2 class="font-semibold text-gray-500 text-lg">CarRent</h2>
        <h1 class="font-bold text-gray-700 text-3xl mb-5">Zaloguj się</h1>
        <label>E-mail:</label>
        <input
            bind:value={email}
            type="text"
            class="p-2 bg-blue-300 border-black border-solid border-b-2 outline-none"
        />
        <label class="mt-2">Hasło:</label>
        <input
            bind:value={password}
            type="password"
            class="p-2 bg-blue-300 border-black border-solid border-b-2 outline-none"
        />
        <button
            on:click={login}
            class="bg-blue-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-blue-500 hover:text-blue-500 hover:bg-whiter transition duration-300"
            >Zaloguj</button
        >
    </div>
</div>
