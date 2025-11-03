<template>
    <div class="rounded-xl border bg-white p-5 shadow-sm dark:bg-neutral-900">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold">
                    Room {{ room.room_number }}
                </h3>
                <p class="text-gray-500">{{ room.type }}</p>
            </div>

            <span
                class="h-10 rounded-full bg-green-500 px-3 py-2 text-sm text-white"
            >
                Available
            </span>
        </div>

        <div class="mt-4 space-y-2 text-sm">
            <p class="text-gray-500">Floor {{ room.floor }}</p>
            <p class="text-gray-500">Capacity: {{ room.capacity }}</p>
            <p class="text-gray-500">Price: {{ room.price }} Ks/night</p>
            <p class="text-gray-500">{{ room.description }}</p>
        </div>

        <div class="mt-3 flex flex-wrap gap-2">
            <span
                v-for="f in room.facilities"
                :key="f"
                class="rounded-full border border-gray-200 px-3 py-1 text-sm dark:bg-neutral-800"
            >
                {{ f }}
            </span>
        </div>

        <div class="mt-4">
            <label class="text-sm font-medium">Update Status</label>
            <select
                v-model="status"
                class="mt-1 w-full rounded-lg border px-3 py-2 dark:border-neutral-700 dark:bg-neutral-800"
            >
                <option>Available</option>
                <option>Booked</option>
                <option>Maintenance</option>
            </select>
        </div>

        <div class="mt-4 flex justify-between">
            <button
                @click="$emit('edit', room)"
                class="rounded-lg border px-4 py-2 dark:border-neutral-700"
            >
                Edit
            </button>

            <button
                @click="$emit('delete', room)"
                class="rounded-lg border px-4 py-2 dark:border-neutral-700"
            >
                Delete
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    room: {
        type: Object,
        required: true,
    },
});

const status = ref('Available');
</script>
