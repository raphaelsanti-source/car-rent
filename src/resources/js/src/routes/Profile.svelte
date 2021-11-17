<script>
    import auth from "../stores/auth";
    if ($auth.key == null) {
        window.location.href = "/#/login";
    }
</script>

<div class="max-w-6xl mx-auto px-4 py-4 sm:py-4 md:py-2">
    <h1>profile</h1>
</div>
