<template>
    <Head title="Teilnehmen" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Teilnehmen
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a class="inline-flex my-1 ml-4" :href="route('participation.export')">
                            <BreezeButton type="button">
                                Alle Exportieren
                            </BreezeButton>
                        </a>
                    </div>
                </div>

                <div v-if="participations.length">
                    <h2 class="text-lg ml-2 font-semibold">Anmeldungen</h2>
                    <div class="grid-cols-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-1">
                                    <table-head-sort-link column="firstname" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="participation.list">
                                        Vorname
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    <table-head-sort-link column="lastname" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="participation.list">
                                        Nachname
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    <table-head-sort-link column="stamm" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="participation.list">
                                        Stamm
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    <table-head-sort-link column="stufe" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="participation.list">
                                        Stufe
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    <table-head-sort-link column="signed_at" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="participation.list">
                                        Unterschrift
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    <table-head-sort-link column="paid_at" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="participation.list">
                                        Beitrag
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    Aktionen
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="participation in participations">
                                <td class="border-r border-t px-1">{{participation.firstname}}</td>
                                <td class="border-r border-t px-1">{{participation.lastname}}</td>
                                <td class="border-r border-t px-1">{{getStamm(participation.stamm)}}</td>
                                <td class="border-r border-t px-1">{{getStufe(participation.stufe)}}</td>
                                <td class="border-r border-t px-1 text-center">
                                    <StatusBubble class="m-1" :status="!!participation.signed_at" :info="participation.signed_at"></StatusBubble>
                                </td>
                                <td class="border-r border-t px-1 text-center">
                                    <StatusBubble class="m-1" :status="!!participation.paid_at" :info="participation.paid_at"></StatusBubble>
                                </td>
                                <td class="border-t px-1">
                                    <a class="inline-flex m-1" :href="route('participation.sign', { id: participation.id })" v-if="!participation.signed_at">
                                        <BreezeButton type="button" >
                                            Unterschrieben
                                        </BreezeButton>
                                    </a>
                                    <a class="inline-flex m-1" :href="route('participation.pay', { id: participation.id })" v-if="!participation.paid_at">
                                        <BreezeButton type="button" >
                                            Bezahlt
                                        </BreezeButton>
                                    </a>
                                    <a class="inline-flex m-1" :href="route('participation.correct', { id: participation.id })">
                                        <BreezeButton type="button" >
                                            Korrigieren
                                        </BreezeButton>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div v-else>
                    Keine Daten gefunden
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import TableHeadSortLink from "@/Components/TableHeadSortLink";
import StatusBubble from "@/Components/StatusBubble";

export default {
    components: {
        StatusBubble,
        BreezeAuthenticatedLayout,
        BreezeButton,
        TableHeadSortLink,
        Head,
        Link,
    },
    props: {
        participations: {
            type: Array,
        },
        tribes: {
            type: Object,
        },
        stufen: {
            type: Object,
        },
        sortColumn: {
            type: String,
        },
        sortDesc: {
            type: Boolean,
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
