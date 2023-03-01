<template>
  
    <AppLayout title="Programs">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bug Reporting
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
                                    <div class="mb-6">
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Title </label>
                                
                                        <input v-model="form.title" 
                                            class="border border-gray-400 p-2 w-full" 
                                            type="text" 
                                            name="name" 
                                            id="name" 
                                            required
                                        />
                                        <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
                                    </div>
                                
                                    <div class="mb-6">
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="pentest-date-start"> Severity </label>
                                
                                        <select v-model="form.severity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="None">None</option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                            <option value="Critical">Critical</option>
                                        </select>
                                        <div v-if="form.errors.severity" v-text="form.errors.severity" class="text-red-500 text-xs mt-1"></div>
                                    </div>
                                
                                    <div class="mb-6">
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="pentest-date-end"> Status </label>
                                
                                        <select v-model="form.status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="New">New</option>
                                            <option value="Low">Resolved</option>
                                        </select>
                                        <div v-if="form.errors.status" v-text="form.errors.status" class="text-red-500 text-xs mt-1"></div>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="pentest-date-end"> Description </label>
                                
                                        <textarea v-model="form.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter bug description here">

                                        </textarea>
                                        <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
                                    </div>
                                
                                    <div class="mb-6">
                                        <div>
                                            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mx-1" :disabled="form.processing">Submit</button>
                                            <Link :href="`/program/${program.id}`" class="bg-blue-500 text-white rounded py-2 px-4 mx-1 hover:bg-blue-500">Back</Link>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
                
</template>
    
    
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";

let props = defineProps({
    program: Object
});

let form = useForm({
    program_id : props.program.id,
    title      : '',
    severity   : '',
    status     : '',
    description: '',
});

let submit = () => {
    form.post('/report');
};

</script>