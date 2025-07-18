<template>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Login to your Account</h2>
                <p class="text-gray-600">Login to get started</p>
            </div>

            <form @submit.prevent="handleSubmit" class="bg-white shadow-lg rounded-lg px-8 py-10 space-y-6">
                

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input id="email" v-model="form.email" type="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                        placeholder="Enter your email" />
                    <div v-if="errors.email" class="text-red-500">{{ errors.email }}</div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input id="password" v-model="form.password" type="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                        placeholder="Enter your password" />
                    <div v-if="errors.password" class="text-red-500">{{ errors.password }}</div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Log in
                </button>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        No account yet?
                        <Link href="/register" class="text-blue-600 hover:text-blue-700 font-medium">Sign up</Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

defineProps({ errors: Object })

const form = useForm({
    email: '',
    password: ''
})



const handleSubmit = () => {
    form.post('/login')
}
</script>