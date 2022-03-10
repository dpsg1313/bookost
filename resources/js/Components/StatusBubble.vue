<template>
    <span
        :class="'text-status-' + color + '-dark' + ' bg-status-' + color + '-light'"

        class=" rounded-full inline-flex items-center p-1"
        :title="info"
        >
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path v-if="status" fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            <path v-else fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </span
    >
</template>

<script>
export default {
    props: {
        status: {
            type: Boolean,
            required: true,
        },
        info: {
            type: String,
        }
    },

    computed: {
        color() {
            return this.status ? 'done' : 'open';
        }
    }
};
</script>
