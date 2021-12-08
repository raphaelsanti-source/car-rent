<script>
    import auth from "../stores/auth";
    if ($auth.key == null || window.localStorage.getItem("prolonged")) {
        window.location.href = "/";
    }
    export let params;
    let data = fetch(`/api/cars/${params.id}`)
        .then((response) => response.json())
        .then((data) => {
            return data;
        });
    let payload = {
        user_id: $auth.id,
        car_id: parseInt(params.id),
        start_date: "",
        end_date: "",
    };
    let available = fetch(`/api/check/${params.id}`)
        .then((response) => response.json())
        .then((data) => {
            return data;
        });
    const send = async () => {
        if (payload.start_date == "" || payload.end_date == "") {
            // console.log(payload.end_date);
            alert("Proszę uzupełnić daty najmu.");
        } else {
            let current = new Date();
            current.setDate(current.getDate() + 2);
            const start = Date.parse(payload.start_date);
            const end = Date.parse(payload.end_date);
            //&& start > current
            if (end > start) {
                payload.start_date = payload.start_date.replace("T", " ");
                payload.end_date = payload.end_date.replace("T", " ");
                let status;
                // console.log(payload);
                await fetch("/api/reservations", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${$auth.key}`,
                    },
                    body: JSON.stringify(payload),
                }).then((response) => {
                    status = response.status;
                });
                if (status == 201) {
                    window.location.href = "/#/profile";
                } else {
                    alert("Wystąpił błąd podczas składania rezerwacji.");
                    // console.log(status);
                }
            } else {
                alert("Data rezerwacji nie spełnia wymagań.");
            }
        }
    };
</script>

<div class="w-100 h-screen flex justify-center items-center bg-blue-500">
    {#await data then item}
        {#each item as car}
            <div class="p-7 flex flex-col bg-whiter rounded-lg w-1/2">
                <h2 class="font-semibold text-gray-500 text-lg">Zarezerwuj</h2>
                <h1 class="font-bold text-gray-700 text-3xl mb-5">
                    {car.made}
                    {car.model}
                    {car.year}
                </h1>
                <div class="flex justify-center">
                    <img
                        src={car.desc}
                        class="w-1/2 object-cover rounded-lg"
                        alt="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                    />
                </div>
                <h2 class="font-semibold text-gray-500 text-lg">Status:</h2>
                {#await available then stat}
                    {#if stat.taken}
                        <span
                            class="border-red-600 border-2 border-solid text-red-600 rounded-lg p-2 w-36 text-center font-bold"
                        >
                            Niedostępny
                        </span>
                    {:else if stat.queue}
                        <span
                            class="border-yellow-600 border-2 border-solid text-yellow-600 rounded-lg p-2 w-36 text-center font-bold"
                        >
                            Kolejka
                        </span>
                    {:else}
                        <span
                            class="border-green-600 border-2 border-solid text-green-600 rounded-lg p-2 w-36 text-center font-bold"
                        >
                            Dostępny
                        </span>
                    {/if}
                {/await}
                <label class="mt-2">Data rozpoczęcia najmu:</label>
                <input type="datetime-local" bind:value={payload.start_date} />
                <label class="mt-2">Data zakończenia najmu:</label>
                <input type="datetime-local" bind:value={payload.end_date} />
                <div class="w-100 flex justify-center">
                    <button
                        on:click={send}
                        class="bg-blue-500 rounded-lg w-36 mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-blue-500 hover:text-blue-500 hover:bg-whiter transition duration-300"
                        >Zarezerwuj</button
                    >
                </div>
            </div>
        {/each}
    {/await}
</div>
