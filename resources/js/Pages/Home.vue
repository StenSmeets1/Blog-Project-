<template>

        <Navbar />

        <div
                class="flex flex-col justify-center items-center bg-gray-200 p-10 rounded-2xl  mt-10 border border-gray-600 shadow-sm shadow-black">
                <div class="flex text-center">
                        <h2 class="text-3xl mb-5 font-bold">Check out these random posts we think you'll like</h2>
                </div>
                <div class="grid lg:grid-cols-3 gap-10">
                        <div v-for="post in posts" :key="post.id"
                                class="bg-gray-50 h-66 w-80 md:w-lg p-4 rounded-2xl border border-gray-300 shadow-xl shadow-gray-300 relative hover:scale-110 transition-all duration-200">

                                <div class="flex justify-between text-start items-center">
                                        <h1 class="text-2xl font-bold text-gray-800">{{ post.title }}</h1>
                                        <h4 class="text-sm font-bold bg-gray-200 p-2 rounded-2xl">{{
                                                category_map[post.category_id] ||
                                                'Unknown Category' }}</h4>
                                </div>
                                <p class="text-sm mb-5">By: {{ user_map[post.user_id] || 'Unknown Author' }}</p>
                                <p class="line-clamp-3 mb-5 text-gray-700 prose">{{ post.content_plain }}</p>
                                <Link :href="`/posts/${post.slug}`"
                                        class="underline hover:text-blue-500 text-lg font-semibold absolute bottom-2">
                                Read
                                further
                                </Link>
                                <p class="absolute bottom-2 right-4 opacity-50 font-bold">Views: {{ post.views }}</p>
                        </div>
                </div>
        </div>
        <div class="text-2xl flex justify-center mt-10">
                <h3>Or look at all posts by clicking
                        <Link href="/posts" class="underline font-bold hover:text-blue-500">here!</Link>
                </h3>
        </div>

</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const { posts, categories, users } = defineProps({
        posts: Array,
        categories: Array,
        users: Array
})

const category_map = computed(() => {
        return Object.fromEntries(categories.map(c => [c.id, c.category]));
})

const user_map = computed(() => {
        return Object.fromEntries(users.map(u => [u.id, u.name]));
})
</script>