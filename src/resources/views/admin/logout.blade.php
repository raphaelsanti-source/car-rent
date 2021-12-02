<script>
    const apiKey = window.localStorage.getItem('adminKey')
    if (apiKey == null) {
        window.location.href = "/";
    } else {
        const logout = async () => {
            // console.log($auth.key);
            fetch("/api/adm/logout", {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${apiKey}`,
                },
            }).then(() => {
                window.localStorage.clear();
                window.location.href = "/";
            });
        };
        logout();
    }
</script>

<div class="w-100 h-screen flex justify-center items-center bg-redish">
    <div class="p-7 flex flex-col bg-whiter rounded-lg">
        <h2 class="font-semibold text-gray-500 text-lg">CarRent</h2>
        <h1 class="font-bold text-gray-700 text-3xl">Do zobaczenia!</h1>
    </div>
</div>
