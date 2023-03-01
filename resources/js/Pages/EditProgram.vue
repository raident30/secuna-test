<template>
  
    <AppLayout title="Edit Program">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Programs
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
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name"> Name </label>
                                
                                        <input v-model="form.name" 
                                            class="border border-gray-400 p-2 w-full" 
                                            type="text" 
                                            name="name" 
                                            id="name" 
                                            required
                                        />
                                        <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
                                    </div>
                                
                                    <div class="mb-6">
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="pentest-date-start"> Pentesting Date Start </label>
                                
                                        <input @change="formatStart()"
                                        v-model="form.pentesting_start"
                                        class="border border-gray-400 p-2 w-full"
                                        type="datetime-local"
                                        name="pentest-date-start"
                                        id="pentest-date-start"
                                        required
                                        step="1"
                                        />
                                        <div v-if="form.errors.pentesting_start" v-text="form.errors.pentesting_start" class="text-red-500 text-xs mt-1"></div>
                                    </div>
                                
                                    <div class="mb-6">
                                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="pentest-date-end"> Pentesting Date End </label>
                                
                                        <input @change="formatEnd()"
                                        v-model="form.pentesting_end"
                                        class="border border-gray-400 p-2 w-full"
                                        type="datetime-local"
                                        name="pentest-date-end"
                                        id="pentest-date-end"
                                        required
                                        step="1"
                                        />
                                        <div v-if="form.errors.pentesting_end" v-text="form.errors.pentesting_end" class="text-red-500 text-xs mt-1"></div>
                                    </div>
                                
                                    <div class="mb-6">
                                        <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" 
                                        :disabled="form.processing">Submit</button>
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
import { ref } from "vue";

let props = defineProps({
    program: Array
});

let form = useForm({
    name            : ref(props.program.name),
    pentesting_start: ref(props.program.pentesting_start),
    pentesting_end  : ref(props.program.pentesting_end),
});

let submit = () => {
    form.patch('/programs/'+props.program.id);
};
function formatStart(){
    form.pentesting_start = form.pentesting_start.replace('T', ' ');
}
function formatEnd(){
    form.pentesting_end = form.pentesting_end.replace('T', ' ');
}
</script>