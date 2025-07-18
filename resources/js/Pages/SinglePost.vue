<template>
    <Navbar />
    <div class="flex justify-center text-center items-center mb-10">
        <div
            class="flex justify-start text-start flex-col items-start p-10 mt-10 bg-gray-50 border border-gray-200 shadow-lg rounded-2xl max-w-5xl">

            <div class="mb-10 flex justify-between gap-80">
                <div class="flex flex-col">
                    <h1 class="text-5xl font-bold">{{ post.title }}</h1>
                    <p class="text-sm text-gray-500">By: {{ user_map[post.user_id] || 'Unknown Author' }}</p>
                    <h4 class="text-sm text-gray-500">Category: {{ category_map[post.category_id] ||
                        'Unknown Category' }}</h4>
                </div>
                <div class="flex text-end items-center justify-end">
                    <button v-if="auth_user && (auth_user.id === post.user_id || auth_user.isAdmin )" type="submit" @click="deletePost(post.id)"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>
                </div>
            </div>

            <p class="prose break-all" v-html="post.content_html"></p>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';
import Navbar from '../Components/Navbar.vue';
const { post, categories, users, auth_user } = defineProps({
    post: Object,
    categories: Array,
    users: Array,
    auth_user: Object,
})

function deletePost(id) {
    router.delete(`/posts/${id}`);
}

const category_map = computed(() => {
    return Object.fromEntries(categories.map(c => [c.id, c.category]));
})

const user_map = computed(() => {
    return Object.fromEntries(users.map(u => [u.id, u.name]));
})
</script>