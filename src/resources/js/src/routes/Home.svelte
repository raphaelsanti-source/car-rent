<script>
    import cars from "../stores/cars";
    import auth from "../stores/auth";
    if ($auth.key != null) {
        window.location.href = "/#/profile";
    }
</script>

<div class="w-100 bg-blue-500 p-10">
    <div class="flex flex-row justify-center">
        <div class="bg-white rounded-lg p-5 md:w-108">
            <h2 class="font-semibold text-gray-500 text-lg">CarRent</h2>
            <h1 class="text-2xl text-center font-bold">
                Sprawdź nasze samochody!
            </h1>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-28 gap-y-8 mt-5 px-5">
        {#await $cars.rawData.slice(0, 6) then data}
            {#each data as item}
                <div class="bg-white p-5 rounded-lg mt-5 md:mt-0">
                    <div class="flex flex-row md:flex-col md:items-center">
                        <img
                            style="height: 150px;"
                            class="rounded-lg object-cover w-1/2 md:w-max"
                            src={item.desc}
                            alt="car"
                        />
                        <div class="m-5">
                            <h2 class="text-lg font-bold">
                                {item.made}
                                {item.model}
                                {item.year}
                            </h2>
                            <h3 class="text-md font-bold text-gray-500">
                                Cena: {item.price}
                            </h3>
                        </div>
                    </div>
                </div>
            {/each}
        {/await}
    </div>
</div>
