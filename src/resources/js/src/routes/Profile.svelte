<script>
    import auth from "../stores/auth";
    // import reservations from "../stores/userReservations";

    import Prof from "../components/Prof.svelte";

    if ($auth.key == null) {
        window.location.href = "/#/login";
    }
    // console.log($auth);
    let reservations = fetch(
        "/api/user_reservations/" + window.localStorage.getItem("userId"),
        {
            method: "GET",
            headers: {
                Authorization: `Bearer ${window.localStorage.getItem(
                    "apiKey"
                )}`,
            },
        }
    )
        .then((response) => response.json())
        .then((data) => {
            return data;
        });
    // let xd = window.localStorage.getItem("prolonged");
    let prolonged = false;
    const prolongedCheck = async () => {
        let revs = await reservations;
        // console.log(revs);
        // console.log(xd);
        for (let i = 0; i < revs.length; i++) {
            if (revs[i].prolonged) {
                prolonged = true;
                break;
            }
        }
        // console.log(prolonged);
        if (prolonged) {
            window.localStorage.setItem("prolonged", true);
        } else {
            window.localStorage.removeItem("prolonged");
        }
    };
    prolongedCheck();

    const change = async (id, operation) => {
        let status;
        await fetch("/api/change_reservation", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${$auth.key}`,
            },
            body: JSON.stringify({
                id: id,
                operation: operation,
            }),
        }).then((response) => {
            status = response.status;
        });
        if (status == 200) {
            if (alert("Zmieniono status rezerwacji.")) {
            } else window.location.reload();
        } else {
            alert("Wystąpił problem podczas operacji.");
        }
    };
    const qr = () => {
        window.location.href = "/#/qr/" + $auth.name + "|" + $auth.email;
    };
</script>

<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2">
    <div class="flex flex-col p-3">
        <h1 class="font-bold text-gray-700 text-3xl">Twój profil:</h1>
        <Prof name={$auth.name} email={$auth.email} />
        <h2 class="font-semibold text-gray-500 text-xl">Twoje rezerwacje:</h2>
        {#if prolonged}
            <h1 class="text-xl">
                Przetrzymujesz samochód, twoje członkostwo jest obecnie
                zawieszone.
            </h1>
        {/if}
        {#await reservations then reservation}
            {#each reservation as item}
                <div class="flex flex-row my-2">
                    <img
                        src={item.desc}
                        class="w-52 object-cover rounded-lg"
                        alt="car"
                    />
                    <div class="flex flex-col w-52 ml-5">
                        <h4 class="font-semibold text-gray-500 text-sm">
                            Numer rezerwacji: {item.id}
                        </h4>
                        <h3
                            class="font-bold text-gray-700 text-lg"
                            id="info-qr"
                        >
                            {item.made}
                            {item.model}
                            {item.year}
                        </h3>
                    </div>
                    <div class="flex flex-col ml-5">
                        <h4 class="font-semibold text-gray-500 text-sm">
                            Status rezerwacji:
                        </h4>
                        {#if item.status == "waiting"}
                            <span
                                class="border-yellow-600 border-2 border-solid text-yellow-600 rounded-lg p-2 w-36 text-center font-bold"
                            >
                                Oczekujące
                            </span>
                        {/if}
                        {#if item.status == "canceled"}
                            <span
                                class="border-red-600 border-2 border-solid text-red-600 rounded-lg p-2 w-36 text-center font-bold"
                            >
                                Anulowane
                            </span>
                        {/if}
                        {#if item.status == "ended"}
                            <span
                                class="border-gray-600 border-2 border-solid text-gray-600 rounded-lg p-2 w-36 text-center font-bold"
                            >
                                Zakończone
                            </span>
                        {/if}
                        {#if prolonged && item.status != "ended"}
                            <span
                                class="border-purple-600 border-2 border-solid text-purple-600 rounded-lg p-2 w-36 text-center font-bold"
                            >
                                Przetrzymany
                            </span>
                        {:else}
                            {#if item.status == "accepted"}
                                <span
                                    class="border-blue-600 border-2 border-solid text-blue-600 rounded-lg p-2 w-36 text-center font-bold"
                                >
                                    Zaakceptowane
                                </span>
                            {/if}
                            {#if item.status == "ongoing"}
                                <span
                                    class="border-green-600 border-2 border-solid text-green-600 rounded-lg p-2 w-36 text-center font-bold"
                                >
                                    Aktywne
                                </span>
                            {/if}
                        {/if}
                    </div>
                    <div class="flex flex-col ml-5">
                        <h4 class="font-semibold text-gray-500 text-sm">
                            Data rozpoczęcia:
                        </h4>
                        <p>{item.start_date}</p>
                        <h4 class="font-semibold text-gray-500 text-sm">
                            Data ostatecznego zakończenia:
                        </h4>
                        <p>{item.end_date}</p>
                    </div>
                    {#if item.status == "waiting"}
                        <div class="flex flex-col ml-5">
                            <button
                                on:click={() => change(item.id, "canceled")}
                                class="bg-red-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-red-500 hover:text-red-500 hover:bg-whiter transition duration-300"
                                >Anuluj</button
                            >
                        </div>
                    {/if}
                    {#if prolonged && item.status != "ended"}
                        <div class="flex flex-col ml-5">
                            <button
                                on:click={() => qr()}
                                class="bg-purple-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-purple-500 hover:text-purple-500 hover:bg-whiter transition duration-300"
                                >QR</button
                            >
                            <button
                                on:click={() => change(item.id, "ended")}
                                class="bg-purple-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-purple-500 hover:text-purple-500 hover:bg-whiter transition duration-300"
                                >Zakończ</button
                            >
                        </div>
                    {:else}
                        {#if item.status == "ongoing"}
                            <div class="flex flex-col ml-5">
                                <button
                                    on:click={() => qr()}
                                    class="bg-blue-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-blue-500 hover:text-blue-500 hover:bg-whiter transition duration-300"
                                    >QR</button
                                >
                                <button
                                    on:click={() => change(item.id, "ended")}
                                    class="bg-blue-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-blue-500 hover:text-blue-500 hover:bg-whiter transition duration-300"
                                    >Zakończ</button
                                >
                            </div>
                        {/if}
                        {#if item.status == "accepted"}
                            <div class="flex flex-col ml-5">
                                <button
                                    on:click={() => change(item.id, "ongoing")}
                                    class="bg-green-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-green-500 hover:text-green-500 hover:bg-whiter transition duration-300"
                                    >Rozpocznij</button
                                >
                            </div>
                        {/if}
                    {/if}
                </div>
            {/each}
        {/await}
    </div>
</div>
