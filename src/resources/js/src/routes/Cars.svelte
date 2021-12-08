<script>
    import cars from "../stores/cars";
    import auth from "../stores/auth";

    if ($auth.key == null || window.localStorage.getItem("prolonged")) {
        window.location.href = "/";
    }

    let mades = fetch("/api/mades")
        .then((response) => response.json())
        .then((data) => {
            return data;
        });
    let types = fetch("/api/types")
        .then((response) => response.json())
        .then((data) => {
            return data;
        });
    const changeFilter = () => {
        const made = document.getElementById("filter-made").value;
        const type = document.getElementById("filter-type").value;
        // console.log(type, made);
        let pass;
        if (made != "none" && type != "none") {
            pass = $cars.rawData.filter((record) => record.made == made);
            pass = pass.filter((record) => record.type == type);
            $cars.filteredData = [...pass];
        } else if (made != "none") {
            pass = $cars.rawData.filter((record) => record.made == made);
            $cars.filteredData = [...pass];
        } else if (type != "none") {
            pass = $cars.rawData.filter((record) => record.type == type);
            $cars.filteredData = [...pass];
        } else {
            $cars.filteredData = $cars.rawData;
        }
    };
</script>

<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2">
    <h2 class="font-semibold text-gray-600 text-xl">Filtry</h2>
    <div class="flex flex-col">
        <h3 class="font-semibold text-gray-500 text-lg">Marka:</h3>
        <select id="filter-made" class="w-24" on:change={() => changeFilter()}>
            <option value="none">None</option>
            {#await mades then made}
                {#each made as item}
                    <option value={item.made}>{item.made}</option>
                {/each}
            {/await}
        </select>
        <h3 class="font-semibold text-gray-500 text-lg">Typ nadwozia:</h3>
        <select id="filter-type" class="w-24" on:change={() => changeFilter()}>
            <option value="none">None</option>
            {#await types then type}
                {#each type as item}
                    <option value={item.type}>{item.type}</option>
                {/each}
            {/await}
        </select>
    </div>
    {#await $cars.filteredData then car}
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
