<template>
    <nav class="bg-gray-50 p-1 border-b-2 border-gray-200 shadow-lg shadow-gray-200">

        <!--    Desktop-->
        <div class="hidden md:visible md:flex justify-between m-10 text-center items-center">
            <!-- Left  -->
            <div>
                <Link href="/" class="font-bold text-2xl">VLBlog</Link>
            </div>


            <!-- Center -->
            <div class="flex gap-20 justify-center text-center items-center">
                <Link href="/posts"
                    class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
                Posts</Link>
                <Link href="/create"
                    class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
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
                <CircleUser />
                </Link>

            </div>
        </div>

        <div class="sm:hidden">
            <div class="flex justify-between m-2 text-center items-center">
                <Link href="/" class="font-bold text-2xl">VLBlog</Link>
                <button @click="isOpen = !isOpen" type-=button>
                    <Menu />
                </button>
            </div>

            <div v-if="isOpen" class="flex flex-col">
                <div class="flex flex-col justify-center text-center items-center">
                    <div class="border-b-1 p-1 border-gray-300 border-t-1 bg-gray-100 w-full">
                        <Link href="/posts"
                            class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
                        Posts</Link>
                    </div>
                    <div class="border-b-1 p-1 border-gray-300 bg-gray-200 w-full">
                    <Link href="/create"
                        class="text-lg hover:bg-gray-200 p-2 pl-4 pr-4 rounded-2xl text-gray-800 font-semibold">
                    Create post</Link>
                    </div>
                </div>

                <div class="flex justify-center gap-5 bg-gray-100 p-2">
                    <Link v-if="!user" href="/login"
                        class="text-lg hover:bg-gray-200 p-2 rounded-2xl text-gray-800 font-semibold">Sign in</Link>
                    <Link v-if="!user" href="/register"
                        class="text-lg bg-indigo-500 hover:bg-indigo-400 text-white p-2 pl-4 pr-4 rounded-2xl font-semibold">
                    Register</Link>

                    <Link v-else href="/dashboard"
                        class="text-2xl text-black hover:text-gray-300 p-2 pl-4 pr-4 rounded-2xl font-semibold">
                    <CircleUser />
                    </Link>

                </div>
            </div>
        </div>



    </nav>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { CircleUser, Menu } from 'lucide-vue-next';


const page = usePage()
const user = computed(() => page.props?.auth?.user ?? null)
const isOpen = ref(false)

console.log("Navbar user:", user.value);



</script>
