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
                    </div>
                </div>

                <div v-if="participations.length">
                    <h2 class="text-lg ml-2 font-semibold">{{ 'Meine Anmeldung' + (participations.length > 1 ? 'en' : '') }}</h2>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex flex-wrap items-center justify-between bg-white border-b border-gray-200" v-for="participation in participations">
                            <div class="items-center" v-if="participations.length > 1">
                                <span class="m-1">{{participation.firstname}} {{participation.lastname}}</span>
                            </div>
                            <div class="justify-end items-center">
                                <StatusPill class="m-1" :status="!!participation.applied_at">angemeldet</StatusPill>
                                <StatusPill class="m-1" :status="!!participation.signed_at">unterschrieben</StatusPill>
                                <StatusPill class="m-1" :status="!!participation.paid_at">bezahlt</StatusPill>
                            </div>
                            <div class="justify-end items-center">
                                <a class="inline-flex m-1" :href="route('participation.edit', { id: participation.id })" v-if="!participation.applied_at" >
                                    <BreezeButton type="button" >
                                        Fortsetzen
                                    </BreezeButton>
                                </a>
                                <a class="inline-flex m-1" :href="route('participation.pdf', { id: participation.id })" v-if="participation.applied_at" download >
                                    <BreezeButton type="button">
                                        PDF herunterladen
                                    </BreezeButton>
                                </a>
                                <a class="inline-flex m-1" :href="route('participation.preview', { id: participation.id })" v-if="participation.applied_at" >
                                    <BreezeButton type="button">
                                        Vorschau
                                    </BreezeButton>
                                </a>
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
    },
}
</script>
