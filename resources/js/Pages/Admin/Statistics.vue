<template>
    <Head title="Statistiken" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Statistiken
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th class="px-1">
                                Stamm
                            </th>
                            <th class="px-1">
                                Teilnehmer
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(tn, stamm) in byStamm">
                            <td class="border-r border-t px-1">{{getStamm(stamm)}}</td>
                            <td class="border-r border-t px-1">{{tn}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th class="px-1">
                                Stufe
                            </th>
                            <th class="px-1">
                                Teilnehmer
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(tn, stufe) in byStufe">
                            <td class="border-r border-t px-1">{{getStufe(stufe)}}</td>
                            <td class="border-r border-t px-1">{{tn}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dropdown from "@/Components/Dropdown";

export default {
    components: {
        Dropdown,
        BreezeAuthenticatedLayout,
        BreezeButton,
        Head,
        Link,
    },
    props: {
        byStamm: {
            type: Object,
        },
        byStufe: {
            type: Object,
        },
        tribes: {
            type: Object,
        },
        stufen: {
            type: Object,
        },
    },
    methods: {
        getStamm(nummer){
            return this.tribes[nummer].name
        },
        getStufe(stufe){
            return this.stufen[stufe]
        },
    }
}
</script>
