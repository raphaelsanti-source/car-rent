import { writable } from 'svelte/store';

const storage = window.localStorage;

const auth = writable({
    id: storage.getItem("userId"),
    key: storage.getItem("apiKey"),
    name: storage.getItem('userName'),
    email: storage.getItem('userEmail')
})

export default auth;