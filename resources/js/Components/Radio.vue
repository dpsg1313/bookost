<template>
    <div>
        <template v-for='(value, index) in options'>
            <input type="radio" :disabled="disabled" class="ml-4 mr-1" :id="name + 'Choice' + index" :name="name" :value='index' v-model="modelValue" @change="$emit('update:modelValue', $event.target.value)" />
            <label :for="name + 'Choice' + index">{{ value }}</label>
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
