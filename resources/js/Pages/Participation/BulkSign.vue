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
                        <BreezeButton class="ml-4" @click="save" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Speichern
                        </BreezeButton>
                    </div>
                </div>

                <div v-if="participations.length">
                    <h2 class="text-lg ml-2 font-semibold">Anmeldungen</h2>
                    <div class="grid-cols-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-1">
                                    Nachname
                                </th>
                                <th class="px-1">
                                    Vorname
                                </th>
                                <th class="px-1">
                                    Unterschrift
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="participation in participations">
                                <td class="border-r border-t px-1">{{participation.lastname}}</td>
                                <td class="border-r border-t px-1">{{participation.firstname}}</td>
                                <td class="border-r border-t px-1 text-center">
                                    <BreezeCheckbox :id="'signed'[participation.id]" class="m-1" v-model:checked="form[participation.id]" />
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
import BreezeCheckbox from "@/Components/Checkbox.vue";

export default {
    components: {
        BreezeCheckbox,
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
    },

    data() {
        let formData = [];
        for(const participation of this.participations){
            formData[participation.id] = !!participation.signed_at;
        }
        return {
            form: this.$inertia.form(formData),
        }
    },

    methods: {
        save() {
            this.form.post(this.route('participation.saveSignatures'), {})
        },
    }
}
</script>
