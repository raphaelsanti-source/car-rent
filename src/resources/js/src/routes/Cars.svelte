<script>
    import cars from "../stores/cars";
</script>

<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2">
    {#await $cars then car}
        {#each car as item}
            <div class="w-100 p-3">
                <h2>{item.made} {item.model}</h2>
                <h3>{item.type}</h3>
                <h4>{item.year}</h4>
                <h3>Cena: {item.price} PLN/H</h3>
            </div>
        {/each}
    {/await}
</div>
