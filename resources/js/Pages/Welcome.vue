<script setup>
import { Head, Link,useForm } from '@inertiajs/vue3';
import { onMounted, onUnmounted } from 'vue'

const form = useForm({
    file:""
})

function submit() {
  form.post(route('upload'));
}

</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
       <div class="w-full max-w-7xl mx-auto p-6 lg:p-8">

                    <div class="mt-16">
                        <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">

                                <div class="relative scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >

                                    <div>
                                        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                            <svg height="1792" viewBox="0 0 1792 1792" width="1792" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 stroke-red-500"><path d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z"/></svg>
                                        </div>

                                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Drag or upload your files here</h2>

                                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">

                                        </p>

                                    </div>
                                      <input type="file" name="file" id="csv" @input="form.file = $event.target.files[0]"  required="required" multiple="multiple" class=" absolute w-full h-full top-0 left-0 right-0 bottom-0 "/>

                                    </div>
                        </div>
                        <p class="text-red-700">{{ form.errors.file }}</p>
                        <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">UPLOAD</button>
                        </form>
                    </div>

                    <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                        <table class="table-auto text-gray-900 bg-white w-full ">
                            <thead>
                                <tr>
                                    <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Time.</th>
                                    <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">File Name</th>
                                    <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="upload in $page.props.uploaded" :key="upload.id">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{  upload.created_at }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ upload.FILENAME }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ upload.STATUS }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
