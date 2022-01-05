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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" v-if="participations" v-for="participation in participations">
                        Name: {{participation.firstname}} {{participation.lastname}}
                        Geburtstag: {{participation.birthday}}
                        Stamm: {{participation.stamm}}
                        <Link :href="route('participation.show', {id: participation.id})" class="ml-4" >
                            Weiter
                        </Link>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200" v-else>
                        <Link :href="route('participation.create')" class="ml-4" >
                            Anmelden
                        </Link>
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

export default {
    components: {
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
