<script>
    import cars from "../stores/cars";
    import auth from "../stores/auth";
    if ($auth.key == null) {
        window.location.href = "/";
    }
</script>

<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2">
    <h2 class="font-semibold text-gray-600 text-xl">Filtry</h2>
    <div class="flex flex-col">
        <h3 class="font-semibold text-gray-500 text-lg">Marka:</h3>
        <div class="flex flex-row">aaa</div>
        <h3 class="font-semibold text-gray-500 text-lg">Typ nadwozia:</h3>
        <div class="flex flex-row">aaa</div>
    </div>
    {#await $cars then car}
        {#each car as item}
            <div class="w-100 p-3 flex flex-row">
                <img
                    src={item.desc}
                    class="w-1/4 object-cover rounded-lg"
                    alt="car"
                />
                <div class="flex flex-col ml-5">
                    <h2 class="font-bold text-gray-700 text-xl">
                        {item.made}
                        {item.model}
                    </h2>
                    <h3 class="font-bold text-gray-600 text-lg">
                        Nadwozie: {item.type}
                    </h3>
                    <h4 class="font-bold text-gray-500 text-md">
                        Rocznik: {item.year}
                    </h4>
                    <h3 class="font-bold text-gray-600 text-lg">
                        Cena: {item.price} PLN/H
                    </h3>
                    <a href={`/#/reservation/${item.id}`}>
                        <button
                            class="bg-blue-500 rounded-lg mt-5 p-2 text-whiter border-2 border-transparent hover:border-solid hover:border-blue-500 hover:text-blue-500 hover:bg-whiter transition duration-300"
                            >Zarezerwuj</button
                        >
                    </a>
                </div>
            </div>
        {/each}
    {/await}
</div>
