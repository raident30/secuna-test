<template>
    <div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center mb-4 sm:mb-0">
          <Component
            :is="data.links.url ? 'span' : 'Link'"
            v-for="link in data.links"
            :href="link.url"
            v-html="link.label"
            class="px-1"
            :class="{ 'text-gray-500': ! link.url, 'font-bold' : link.active }"
          />
        </div>
    </div>
</template>
  
  <script setup>

  let props = defineProps({
    data: Object,
  });
  </script>