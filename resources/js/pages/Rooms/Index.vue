<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import RoomCard from './RoomCard.vue';

// ✅ Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Rooms',
        href: '/rooms',
    },
];

// ✅ Props from Laravel Controller (RoomController@index)
const props = defineProps<{
    rooms: Array<{
        id: number;
        room_number: string;
        floor: number;
        capacity: number;
        price: number;
        facilities: string[];
        description: string;
    }>;
}>();

const editRoom = (room: any) => {
    console.log('Edit:', room);
};

const deleteRoom = (room: any) => {
    console.log('Delete:', room);
};
</script>

<template>
    <Head title="Rooms" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-hidden rounded-xl p-4"
        >
            <!-- Header -->
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <p>{{ props.rooms.length }} total rooms</p>
                </div>

                <button
                    class="flex items-center gap-2 rounded-lg bg-black px-4 py-2 text-white"
                >
                    <span>＋</span> Add Room
                </button>
            </div>

            <!-- Rooms Grid -->
            <div
                class="grid auto-rows-min grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3"
            >
                <RoomCard
                    v-for="room in props.rooms"
                    :key="room.id"
                    :room="room"
                    @edit="editRoom"
                    @delete="deleteRoom"
                />
            </div>
        </div>
    </AppLayout>
</template>
