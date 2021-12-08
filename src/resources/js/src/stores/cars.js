import { writable } from 'svelte/store';

const cars = writable({
    rawData: [],
    filteredData: []
});

async function load() {
    let res = await fetch('/api/cars', {
        method: "GET"
    });
    res = await res.json();
    cars.set({
        rawData: res,
        filteredData: res
    });
}
load();

export default cars;