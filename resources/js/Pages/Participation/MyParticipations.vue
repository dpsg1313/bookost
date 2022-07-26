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
                        <p class="text-lg font-bold">Der Anmeldezeitraum ist vorbei!</p>
                        <p>Für nachträgliche Anmeldungen wende dich bitte an bezirkslager@dpsg1313.de und wir schauen, was noch möglich ist.</p>
                        <a class="inline-flex my-1 ml-4" :href="route('admin.participation.manual')" v-if="$page.props.auth.isAdmin">
                            <BreezeButton type="button">
                                Nachmelden
                            </BreezeButton>
                        </a>
                        <!--
                        <a class="inline-flex my-1 ml-4" :href="route('participation.create')" >
                            <BreezeButton type="button" >
                                Mich selbst anmelden
                            </BreezeButton>
                        </a>
                        <a class="inline-flex my-1 ml-4" :href="route('participation.create', { mode: 'parent' })" >
                            <BreezeButton type="button" >
                                Mein Kind anmelden
                            </BreezeButton>
                        </a>
                        -->
                    </div>
                </div>

                <div v-if="participations.length">
                    <h2 class="text-lg ml-2 font-semibold">{{ 'Meine Anmeldung' + (participations.length > 1 ? 'en' : '') }}</h2>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex flex-wrap items-center justify-between bg-white border-b border-gray-200" v-for="participation in participations" :set="stamm = getStamm(participation.stamm)">
                            <div class="items-center" v-if="participations.length > 1">
                                <span class="m-1">{{participation.firstname}} {{participation.lastname}}</span>
                            </div>
                            <div class="justify-end items-center">
                                <StatusPill class="m-1" :status="!!participation.applied_at">angemeldet</StatusPill>
                                <StatusPill class="m-1" :status="!!participation.signed_at">unterschrieben</StatusPill>
                                <StatusPill class="m-1" :status="!!participation.paid_at">bezahlt</StatusPill>
                            </div>
                            <div class="justify-end items-center">
                                <!--<a class="inline-flex m-1" :href="route('participation.edit', { id: participation.id })" v-if="!participation.applied_at" >
                                    <BreezeButton type="button" >
                                        Fortsetzen
                                    </BreezeButton>
                                </a>-->
                                <a class="inline-flex m-1" :href="route('participation.pdf', { id: participation.id })" v-if="participation.applied_at" download >
                                    <BreezeButton type="button">
                                        PDF herunterladen
                                    </BreezeButton>
                                </a>
                                <a class="inline-flex m-1" :href="route('participation.preview', { id: participation.id })" v-if="participation.applied_at && admin" >
                                    <BreezeButton type="button">
                                        Druckvorschau
                                    </BreezeButton>
                                </a>
                            </div>
                            <div class="w-full" v-if="participation.applied_at && participation.mode !== 'manual'">
                                <ol class="list-decimal ml-4 mt-2">
                                    <template v-if="!participation.signed_at">
                                        <li>Anmeldung herunterladen und ausdrucken.</li>
                                        <li v-if="isOver18(participation.birthday) || participation.mode === 'parent'">Anmeldung unterschreiben.</li>
                                        <li v-else>Von deinen Eltern unterschreiben lassen.</li>
                                        <li v-if="participation.mode === 'parent' || participation.stufe === 'leiter'">Anmeldung bis spätestens 17. April beim Stamm abgeben.</li>
                                        <li v-else>Anmeldung bis spätestens 17. April bei deinen Leiter*innen (oder beim Stammesvorstand) abgeben.</li>
                                    </template>
                                    <template v-if="!participation.paid_at">
                                        <li>
                                            Teilnahmebeitrag ({{participation.stufe === 'leiter' ? 50 : 100}}€) überweisen bis spätestens 30. April.
                                            <p class="ml-8">
                                                Kontoinhaber: {{ stamm.bankAccountOwner }}<br>
                                                IBAN: {{ stamm.iban }}<br>
                                                BIC: {{ stamm.bic }}
                                            </p>
                                        </li>
                                    </template>
                                </ol>
                            </div>
                            <div class="w-full" v-if="participation.mode === 'manual'">
                                (Manuell nachgemeldet)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import StatusPill from "@/Components/StatusPill";

export default {
    components: {
        StatusPill,
        BreezeAuthenticatedLayout,
        BreezeButton,
        Head,
        Link,
    },
    props: {
        participations: {
            type: Array,
        },
        admin: {
            type: Boolean,
        },
        tribes: {
            type: Object,
        }
    },

    methods: {
        getStamm(nummer){
            return this.tribes[nummer]
        },
        isOver18(birthday) {
            let b = new Date(birthday)
            return new Date(b.getFullYear() + 18, b.getMonth(), b.getDate()) <= new Date();
        }
    }
}
</script>
