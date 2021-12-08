<script>
    // Router
    import Router from "svelte-spa-router";
    // Pages
    import Home from "./routes/Home.svelte";
    import Login from "./routes/Login.svelte";
    import Register from "./routes/Register.svelte";
    import NotFound from "./routes/NotFound.svelte";
    import Profile from "./routes/Profile.svelte";
    import Cars from "./routes/Cars.svelte";
    import Reservation from "./routes/Reservation.svelte";
    import Qr from "./routes/Qr.svelte";

    // Partials
    import HeaderFirst from "./partials/HeaderFirst.svelte";
    import Header from "./partials/Header.svelte";
    import Footer from "./partials/Footer.svelte";
    // Check
    import auth from "./stores/auth";
    import Logout from "./routes/Logout.svelte";
</script>

{#if $auth.key != null}
    <Header />
{:else}
    <HeaderFirst />
{/if}
<Router
    routes={{
        "/": Home,
        "/login": Login,
        "/register": Register,
        "/logout": Logout,
        "/profile": Profile,
        "/cars": Cars,
        "/reservation/:id": Reservation,
        "/xd": NotFound,
        "/qr/:number": Qr,
    }}
/>
<Footer />
