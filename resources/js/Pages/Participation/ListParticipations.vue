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
                        <a :href="route('participation.create')" class="ml-4" >
                            <BreezeButton type="button" >
                                Anmelden
                            </BreezeButton>
                        </a>
                    </div>
                </div>

                <div v-if="participations.length">
                    <h2 class="text-lg font-semibold">{{ 'Meine Anmeldung' + (participations.length > 1 ? 'en' : '') }}</h2>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200" v-for="participation in participations">
                            <span v-if="participations.length > 1">{{participation.firstname}} {{participation.lastname}}</span>
                            <StatusPill :status="!!participation.applied_at">angemeldet</StatusPill>
                            <StatusPill :status="!!participation.signed_at">unterschrieben</StatusPill>
                            <StatusPill :status="!!participation.paid_at">bezahlt</StatusPill>
                            <a :href="route('participation.edit', { id: participation.id })" v-if="!participation.applied_at" class="ml-4" >
                                <BreezeButton type="button" >
                                    Fortsetzen
                                </BreezeButton>
                            </a>
                            <a :href="route('participation.pdf', { id: participation.id })" v-if="participation.applied_at" class="ml-4" download >
                                <BreezeButton type="button">
                                    PDF herunterladen
                                </BreezeButton>
                            </a>
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
