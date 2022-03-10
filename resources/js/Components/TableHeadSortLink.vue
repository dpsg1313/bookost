<template>
    <a :class="sortColumn===column ? 'underline' : ''" :href="getUrl(column)">
        <slot />
        <svg v-if="sortColumn===column && !sortDesc" class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
        <svg v-if="sortColumn===column && sortDesc" class="w-6 h-6 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </a>
</template>

<script>
export default {
    props: {
        column: {
            type: String,
        },
        routeName: {
            type: String,
        },
        sortColumn: {
            type: String,
        },
        sortDesc: {
            type: Boolean,
        },
    },
    methods: {
        getUrl(column){
            let desc = false
            if(this.sortColumn === column && !this.sortDesc){
                desc = true
            }
            return route(this.routeName, { _query: {sort: column, desc: desc} })
        },
    }
}
</script>