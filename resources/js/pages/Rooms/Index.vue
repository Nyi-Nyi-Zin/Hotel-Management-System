<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { dashboard } from '@/routes'
import { type BreadcrumbItem } from '@/types'
import { Head, usePage } from '@inertiajs/vue3'
import PlaceholderPattern from '@/components/PlaceholderPattern.vue'
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'

// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: dashboard().url },
  { title: 'Rooms', href: '/rooms' },
]

// Props from controller
const props = defineProps({ rooms: Array })

// Modals visibility
const showCreate = ref(false)
const showEdit = ref(false)

// Form data
const createForm = ref({
  room_number: '',
  floor: '',
  capacity: '',
  price: '',
  facilities: '',
  description: '',
})

const editForm = ref({})

// Functions
const submitCreate = () => {
  const payload = {
    ...createForm.value,
    facilities: createForm.value.facilities
      .split(',')
      .map(f => f.trim()),
  }
  Inertia.post(route('rooms.store'), payload, {
    onSuccess: () => (showCreate.value = false),
  })
}

const openEdit = room => {
  editForm.value = {
    ...room,
    facilities: room.facilities.join(', '),
  }
  showEdit.value = true
}

const submitEdit = () => {
  const payload = {
    ...editForm.value,
    facilities: editForm.value.facilities
      .split(',')
      .map(f => f.trim()),
  }
  Inertia.put(route('rooms.update', editForm.value.id), payload, {
    onSuccess: () => (showEdit.value = false),
  })
}

const deleteRoom = id => {
  if (confirm('Are you sure you want to delete this room?')) {
    Inertia.delete(route('rooms.destroy', id))
  }
}
</script>

<template>
  <Head title="Rooms" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Rooms</h1>

      <!-- Button to open Create Modal -->
      <button
        @click="showCreate = true"
        class="bg-blue-500 text-white px-4 py-2 rounded mb-4"
      >
        Add Room
      </button>

      <!-- Rooms Table -->
      <table class="w-full border-collapse border">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2 text-left">Room Number</th>
            <th class="border px-4 py-2 text-left">Floor</th>
            <th class="border px-4 py-2 text-left">Capacity</th>
            <th class="border px-4 py-2 text-left">Price</th>
            <th class="border px-4 py-2 text-left">Facilities</th>
            <th class="border px-4 py-2 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="room in rooms" :key="room.id">
            <td class="border px-4 py-2">{{ room.room_number }}</td>
            <td class="border px-4 py-2">{{ room.floor }}</td>
            <td class="border px-4 py-2">{{ room.capacity }}</td>
            <td class="border px-4 py-2">${{ room.price }}</td>
            <td class="border px-4 py-2">
              <span v-for="f in room.facilities" :key="f">{{ f }} </span>
            </td>
            <td class="border px-4 py-2">
              <button
                @click="openEdit(room)"
                class="text-blue-600 mr-2"
              >
                Edit
              </button>
              <button
                @click="deleteRoom(room.id)"
                class="text-red-600"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Create Modal -->
      <div
        v-if="showCreate"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
      >
        <div class="bg-white p-6 rounded w-1/2">
          <h2 class="text-xl font-bold mb-4">Add Room</h2>
          <form @submit.prevent="submitCreate">
            <input
              v-model="createForm.room_number"
              placeholder="Room Number"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="createForm.floor"
              type="number"
              placeholder="Floor"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="createForm.capacity"
              type="number"
              placeholder="Capacity"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="createForm.price"
              type="number"
              step="0.01"
              placeholder="Price"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="createForm.facilities"
              placeholder="Facilities (comma separated)"
              class="border p-2 w-full mb-2"
            />
            <textarea
              v-model="createForm.description"
              placeholder="Description"
              class="border p-2 w-full mb-2"
            ></textarea>
            <div class="flex justify-end gap-2">
              <button
                type="button"
                @click="showCreate = false"
                class="bg-gray-500 text-white px-4 py-2 rounded"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded"
              >
                Save
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Edit Modal -->
      <div
        v-if="showEdit"
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
      >
        <div class="bg-white p-6 rounded w-1/2">
          <h2 class="text-xl font-bold mb-4">Edit Room</h2>
          <form @submit.prevent="submitEdit">
            <input
              v-model="editForm.room_number"
              placeholder="Room Number"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="editForm.floor"
              type="number"
              placeholder="Floor"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="editForm.capacity"
              type="number"
              placeholder="Capacity"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="editForm.price"
              type="number"
              step="0.01"
              placeholder="Price"
              class="border p-2 w-full mb-2"
            />
            <input
              v-model="editForm.facilities"
              placeholder="Facilities (comma separated)"
              class="border p-2 w-full mb-2"
            />
            <textarea
              v-model="editForm.description"
              placeholder="Description"
              class="border p-2 w-full mb-2"
            ></textarea>
            <div class="flex justify-end gap-2">
              <button
                type="button"
                @click="showEdit = false"
                class="bg-gray-500 text-white px-4 py-2 rounded"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded"
              >
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
