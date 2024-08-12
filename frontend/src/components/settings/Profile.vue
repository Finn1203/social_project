<script setup>
const { user } = defineProps({
    user: Object,
})
const emits = defineEmits(['updateProfile']);

const updateProfile = () => {
    emits('updateProfile', user);
}
</script>

<template>
    <div class="py-4">
        <div class="space-py-4">
		<h1 class="font-semibold">Profile</h1>
        <div>
        <form class="space-y-4">
            <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input v-model="user.first_name"
                    type="text" placeholder="enter your firstname"
              class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"/>
              <small class="text-red-500"></small>
          </div>
          <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input v-model="user.last_name"
                    type="text" placeholder="enter your lastname"
              class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"/>
              <small class="text-red-500"></small>
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input v-model="user.email"
            type="email" placeholder="enter your email" id="email" name="email"
              class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300"/>
          </div>
            <div class=" text-center">
                <button type="button" @click="updateProfile" class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Save</button>
            </div>
        </form>
    </div>
    </div>
    </div>
</template>