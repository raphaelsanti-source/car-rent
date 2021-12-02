import { writable } from 'svelte/store';

const reservations = writable([]);

async function load() {
    let res = await fetch('/api/user_reservations', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${window.localStorage.getItem('apiKey')}`,
        },
        body: JSON.stringify({
            user_id: window.localStorage.getItem('userId')
        })
    });
    res = await res.json();
    reservations.set(res.reverse());
    console.log(res);
}
load();

export default reservations;