<template>
    <form @submit.prevent="logout">
        <button type="submit" class="bg-green-500">Log out</button>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm();

const logout = () => {
    form.post('/logout');
}
</script>