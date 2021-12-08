<script>
    export let params;

    const init = () => {
        new QRCode(document.getElementById("qrcode"), params.number);
    };
</script>

<svelte:head>
    <script
        src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"
        on:load={init}></script>
</svelte:head>

<div class="w-100 h-screen flex justify-center items-center bg-blue-500">
    <div id="qrcode" class="bg-white p-5 rounded-md" />
</div>
