<script>
    export let name;
    export let email;
</script>

<div class="flex flex-col p-5">
    <img
        class="w-56 object-cover"
        src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Breezeicons-actions-22-im-user.svg/1200px-Breezeicons-actions-22-im-user.svg.png"
        alt="profile"
    />
    <h4 class="font-semibold text-gray-500 text-sm">Nazwa:</h4>
    <h3 class="font-bold text-gray-700 text-lg">
        {name}
    </h3>
    <h4 class="font-semibold text-gray-500 text-sm">Email:</h4>
    <h3 class="font-bold text-gray-700 text-lg">
        {email}
    </h3>
    <h3 class="text-md hover:text-blue-500 transition duration-300">
        <a href="/assets/regulamin.pdf" target="_blank"> Regulamin usługi </a>
    </h3>
</div>
