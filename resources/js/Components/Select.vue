<template>
    <select
        id="stamm"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        v-model="modelValue"
        ref="input"
        @change="$emit('update:modelValue', $event.target.value)"
    >
        <option v-for='(name, index) in options' :value='index'>{{ name }}</option>
    </select>
</template>

<script>
export default {
    props: [
        'modelValue',
        'options'
    ],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
