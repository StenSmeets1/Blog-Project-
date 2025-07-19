<template>
    <Navbar />
    <div class="flex justify-center items-center mt-10">
        <div class="grid lg:grid-cols-3 gap-10">
            <div v-for="post in posts.data" :key="post.id"
                class="bg-gray-50 h-60 w-80 md:w-lg p-4 rounded-2xl border border-gray-300 shadow-xl shadow-gray-300 relative hover:scale-110 transition-all duration-200">

                <div class="flex justify-between text-start items-center">
                    <h1 class="text-2xl font-bold text-gray-800">{{ post.title }}</h1>
                    <h4 class="text-sm font-bold bg-gray-200 p-2 rounded-2xl">{{ category_map[post.category_id] ||
                        'Unknown Category' }}</h4>
                </div>
                <p class="text-sm mb-5">By: {{ user_map[post.user_id] || 'Unknown Author' }}</p>
                <p class="line-clamp-3 mb-5 text-gray-700 prose">{{ post.content_plain }}</p>
                <Link :href="`/posts/${post.slug}`" class="underline hover:text-blue-500 text-lg font-semibold absolute bottom-2">Read
                further
                </Link>
                <p class="absolute bottom-2 right-4 opacity-50 font-bold">Views: {{ post.views }}</p>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-10 ml-10 mr-10 mb-10">
      <button
        v-if="posts.prev_page_url"
        @click="goToPage(posts.prev_page_url)"
        class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-500 border-1 border-blue-700 text-white shadow-sm shadow-black"
      >
        Previous
      </button>

      <button
        v-if="posts.next_page_url"
        @click="goToPage(posts.next_page_url)"
        class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-500 border-1 border-blue-700 text-white shadow-sm shadow-black"
      >
        Next
      </button>
    </div>

</template>


<script setup>
import Navbar from '../Components/Navbar.vue';
import { computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';

function goToPage(url) {
    router.visit(url)
}

const { posts, categories, users } = defineProps({
    posts: Object,
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
