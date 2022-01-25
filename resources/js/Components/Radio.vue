<template>
    <div>
        <template v-for='(value, index) in options'>
            <label class="whitespace-nowrap" :for="name + 'Choice' + index">
                <input type="radio" :disabled="disabled" class="ml-4 mr-1 border-gray-300 checked:bg-indigo-600 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" :id="name + 'Choice' + index" :name="name" :value='index' v-model="modelValue" @change="$emit('update:modelValue', $event.target.value)" />
                {{ value }}
            </label>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {

        },
        name: {
            type: String
        },
        options: {
            type: Object
        },
        disabled: {
            type: Boolean
        },
    },

    emits: ['update:modelValue'],
}
</script>
