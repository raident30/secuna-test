

<template>
    <AppLayout title="Program">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Program
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mb-2 mx-auto sm:px-6 lg:px-8">
                <Link type="button" :href="`/program/${program.id}/report/create`" data-drawer-target="drawer-update-product-default" data-drawer-show="drawer-update-product-default" aria-controls="drawer-update-product-default" data-drawer-placement="right" 
                class="items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Report a Bug
                </Link>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container px-4 mx-auto lg:px-0 dark:bg-gray-900">
                    <h1 class="mb-3 text-3xl font-bold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight dark:text-white">Program: {{ program.name }}</h1>
                    <p class="text-lg font-normal text-gray-500 sm:text-xl dark:text-gray-400">Pentesting start: {{ program.pentesting_start }}</p>
                    <p class="text-lg font-normal text-gray-500 sm:text-xl dark:text-gray-400">Pentesting end: {{ program.pentesting_end }}</p>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Name
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Pentest Start
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Pentest End
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        <tr v-for="report in reports" :key="report.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ report.title }}</td>
                                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ report.severity }}</td>
                                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ report.status }}</td>
                                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                <ReportDescriptionModal :description="report.description">
                                                    <button type="button" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-500 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                                        Description
                                                    </button>
                                                </ReportDescriptionModal>
                                            </td>
                                        </tr>                    
                                    </tbody>
                                </table>
                                <h3 v-if="props.reports.length < 1" class="font-semibold text-xl text-gray-300 leading-tight">
                                    No reports yet!
                                </h3>
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
import ReportDescriptionModal from '@/Components/ReportDescriptionModal.vue'
let props = defineProps({
    program: Array,
    reports: Array
});



</script>
