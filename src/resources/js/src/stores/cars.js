import { writable } from 'svelte/store';

const cars = writable([]);

async function load() {
    let res = await fetch('/api/cars', {
        method: "GET"
    });
    res = await res.json();
    cars.set(res);
}
load();

export default cars;