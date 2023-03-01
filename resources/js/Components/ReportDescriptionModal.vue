<template>
    <span>
        <span @click="startDialogModal">
            <slot />
        </span>

        <DialogModal :show="reportDescriptionModal" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ description }}

            </template>

            <template #footer>

            </template>
        </DialogModal>
    </span>
</template>

<script setup>
import DialogModal from './DialogModal.vue';
import { ref } from 'vue';

defineProps({
    description: String,
    title: {
        type: String,
        default: 'Report Description',
    },
});

const reportDescriptionModal = ref(false);

const startDialogModal = () => {
    reportDescriptionModal.value = true;
};

const closeModal = () => {
    reportDescriptionModal.value = false;
};
</script>