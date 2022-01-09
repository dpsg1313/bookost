<template>
    <span
        :class="'text-status-' + color + '-dark' + ' bg-status-' + color + '-light'"

        class="mx-1 px-2 py-1 rounded-full inline-block"
        >
        <slot />
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
    },

    computed: {
        color() {
            return this.status ? 'done' : 'open';
        }
    }
};
</script>
