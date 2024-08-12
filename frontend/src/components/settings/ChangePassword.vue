<script setup>
import { reactive } from 'vue';
const emits = defineEmits(['changePassword']);

const { errors } = defineProps(['errors']);

const passwordData = reactive({})

const changePassword = () => {
    emits('changePassword', passwordData);
}
</script>

<template>
    <div class="py-4">
        <div class="space-y-4">
            <h1 class="font-semibold">Change Password</h1>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input v-model="passwordData.current_password" type="password" placeholder="Current Password"
                    name="password"
                    class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" />
                <small class="text-red-500" v-if="errors.current_password">{{ errors.current_password[0] }}</small>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input v-model="passwordData.password" type="password" placeholder="New Password" name="password"
                    class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" />
                <small class="text-red-500" v-if="errors.password">{{ errors.password[0] }}</small>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input v-model="passwordData.password_confirmation" type="password"
                    placeholder="New Password Confirmation" name="password"
                    class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300" />
                <small class="text-red-500"></small>
            </div>
            <div class=" text-center">
                <button type="button" @click="changePassword"
                    class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Change
                    Password</button>
            </div>
        </div>
    </div>
</template>