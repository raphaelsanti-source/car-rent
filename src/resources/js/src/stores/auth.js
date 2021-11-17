import { writable } from 'svelte/store';

const storage = window.localStorage;

const auth = writable({
    key: storage.getItem("apiKey"),
})

export default auth;