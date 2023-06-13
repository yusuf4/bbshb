<template>
    <div class="flex justify-center my-4">
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="relative block rounded bg-transparent px-2 py-1.5 text-sm transition-all duration-300 dark:text-neutral-400"
            :class="{'text-gray-500': ! link.url, 'text-blue-600 font-medium': link.active }"
        />
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {

    props:{
        links: Array,
    }
}
</script>

