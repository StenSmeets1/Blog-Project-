<template>
    <nav class="bg-gray-50 p-1 border-b-2 border-gray-200 shadow-lg shadow-gray-200">
        <div class="flex justify-between m-10 text-center items-center">
            <!-- Left  -->
            <div>
                <Link href="/" class="font-bold text-2xl">VLBlog</Link>
            </div>

            <!-- Center -->
            <div class="flex gap-20 justify-center text-center items-center">
                <Link href="#" class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
                Posts</Link>
                <Link href="#" class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
                Categories</Link>
                <Link href="/create" class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
                Create post</Link>
            </div>

            <div class="flex gap-5">
                <Link v-if="!user" href="/login"
                    class="text-lg hover:bg-gray-200 p-2 rounded-2xl text-gray-800 font-semibold">Sign in</Link>
                <Link v-if="!user" href="/register"
                    class="text-lg bg-indigo-500 hover:bg-indigo-400 text-white p-2 pl-4 pr-4 rounded-2xl font-semibold">
                Register</Link>

                <Link v-else href="/dashboard"
                    class="text-2xl text-black hover:text-gray-300 p-2 pl-4 pr-4 rounded-2xl font-semibold">
                <CircleUser/></Link>

            </div>

        </div>


    </nav>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { CircleUser } from 'lucide-vue-next';

const page = usePage()
const user = computed(() => page.props?.auth?.user ?? null)

console.log("Navbar user:", user.value);



</script>
