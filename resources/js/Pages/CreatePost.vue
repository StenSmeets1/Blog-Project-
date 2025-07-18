<template>
    <Navbar />
    <form @submit.prevent="submit">
        <div class="flex justify-center mt-10 mb-10 flex-col items-center">

            <div class="flex items-center mb-10">
                <div class="mr-20 ">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Post title
                    </label>
                    <input id="title" v-model="form.title" type="text" required
                        class=" px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors"
                        placeholder="Title of your post" />
                </div>
                <button type="submit" class="w-20 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-7">Post</button>
            </div>
            <div class="max-w-5xl h-2xl flex justify-center">
                <div id="editor" class="shadow-lg" />
            </div>

            
        </div>
    </form>

</template>

<script setup>
import { Editor } from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import Navbar from '../Components/Navbar.vue';
import { onMounted, ref } from 'vue';
import 'tui-color-picker/dist/tui-color-picker.css';
import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';
import colorSyntax from '@toast-ui/editor-plugin-color-syntax';
import 'prismjs/themes/prism.css';
import '@toast-ui/editor-plugin-code-syntax-highlight/dist/toastui-editor-plugin-code-syntax-highlight.css';
import codeSyntaxHighlight from '@toast-ui/editor-plugin-code-syntax-highlight';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    content: ''
})

const editor = ref(null)

const submit = () => {
    form.content = editor.value.getMarkdown();
    form.post('/create')
}

onMounted(() => {
    editor.value = new Editor({
        el: document.querySelector("#editor"),
        initialEditType: 'markdown',
        height: '600px',
        plugins: [colorSyntax, codeSyntaxHighlight]
    })
})



</script>