<template>
    <Head title="Abschließen" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Anmeldung anzeigen
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" v-if="participation.applied_at">
                        <div>
                            Vielen Dank für deine Anmeldung!
                        </div>
                        <div class="mt-8 text-lg font-semibold">
                            Wie geht es jetzt weiter?
                        </div>
                        <ol class="list-decimal ml-4 mt-2">
                            <li>Anmeldung herunterladen und ausdrucken.</li>
                            <li v-if="isOver18 || participation.mode === 'parent'">Anmeldung unterschreiben.</li>
                            <li v-else>Von deinen Eltern unterschreiben lassen.</li>
                            <li v-if="participation.mode === 'parent' || participation.stufe === 'leiter'">Anmeldung bis spätestens 15. Dezember beim Stamm abgeben.</li>
                            <li v-else>Anmeldung bis spätestens 15. Dezember bei deinen Leiter*innen (oder beim Stammesvorstand) abgeben.</li>
                            <li v-if="!participation.paid_at">
                                Teilnahmebeitrag bis spätestens 31. Dezember an den Stamm überweisen. <br>
                                Höhe des Beitrags sowie die Kontoverbindung erfährst du bei deinem Stamm.
                            </li>
                        </ol>
                        <div class="flex items-center">
                            <a :href="route('participation.pdf', { id: participation.id })" class="flex justify-center ml-4 mt-8" download >
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
import BreezeButton from '@/Components/Button.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeButton,
        BreezeValidationErrors,
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },

    props: {
        participation: {
            type: Object,
        },
        stamm: {
            type: Object,
        },
    },

    computed: {
        isOver18() {
            let b = new Date(this.participation.birthday)
            return new Date(b.getFullYear() + 18, b.getMonth(), b.getDate()) <= new Date();
        }
    }
}
</script>
