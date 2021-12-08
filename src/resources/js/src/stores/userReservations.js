import { writable } from 'svelte/store';

const reservations = writable([]);

async function load() {
    let res = await fetch('/api/user_reservations/' + window.localStorage.getItem('userId'), {
        method: "GET",
        headers: {
            Authorization: `Bearer ${window.localStorage.getItem('apiKey')}`,
        },
    });
    res = await res.json();
    reservations.set(res.reverse());
    // console.log(res);
}
load();

export default reservations;