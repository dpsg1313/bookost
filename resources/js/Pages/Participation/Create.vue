<template>
    <Head title="Neue Anmeldung" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Neue Anmeldung
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BreezeValidationErrors class="mb-4" />

                    <form action="#" @submit.prevent="">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Basisdaten
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="firstname" value="Vorname" />
                                <BreezeInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="lastname" value="Nachname" />
                                <BreezeInput id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="birthday" value="Geburtstag" />
                                <BreezeInput id="birthday" type="date" class="mt-1 block w-full" v-model="form.birthday" required />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="gender" value="Geschlecht" />
                                <BreezeSelect id="gender" class='mt-1 block' required :options="genders" v-model='form.gender' />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Gruppe
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="stamm" value="Stamm" />
                                <BreezeSelect id="stamm" class='mt-1 block' required :options="staemme" v-model='form.stamm' />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="stufe" value="Stufe" />
                                <BreezeSelect id="stufe" class='mt-1 block' required :options="stufen" v-model='form.stufe' />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200" v-if="form.stufe==='leiter'">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Für Leitende
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="role" value="Rolle/Aufgabe" />
                                <BreezeSelect id="role" class='mt-1 block' required :options="roles" v-model='form.role' />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="prevention" value="Ich habe eine Präventionsschulung (Modul 2d + 2e) besucht" />
                                <BreezeCheckbox id="prevention" class="mt-1 block" v-model:checked="form.prevention" />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Email
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="mail" value="Bitte schickt wichtige Infos zum Lager an folgende Email-Adresse:" />
                                <BreezeInput id="mail" type="email" class="mt-1 block w-full" v-model="form.mail" required />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Krankenversicherung
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="insurance_person" value="Name des/der Hauptversicherten (über wen versichert?):" />
                                <BreezeInput id="insurance_person" type="text" class="mt-1 block w-full" v-model="form.insurance_person" required />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="insurance" value="Krankenversicherung (z.B. AOK, Barmer GEK etc.):" />
                                <BreezeInput id="insurance" type="text" class="mt-1 block w-full" v-model="form.insurance" required />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Impfungen
                            </h2>
                            <p>// Empfehlung Tetanus, Zecken!</p>
                            <p>// Corona Impfung ggf. erforderlich zur Teilnahme, je nach Regelung im Sommer.</p>
                            <BreezeLabel for="vaccination_info_confirmed" value="Ich habe die obenstehenden Hinweise zum Thema Impfung gelesen und verstanden" />
                            <BreezeCheckbox id="vaccination_info_confirmed" class="mt-1 block" v-model:checked="form.vaccination_info_confirmed" />
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Ernährung
                            </h2>
                            <div class="mt-2">
                                <BreezeRadio id="food" class="mt-1 block w-full" :options="foods" v-model="form.food" required />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Kontaktdaten der Erziehungsberechtigten
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="parent_phone" value="Telefon" />
                                <BreezeInput id="parent_phone" type="tel" class="mt-1 block w-full" v-model="form.parent_phone" required autofocus />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="parent_mobile" value="Handy" />
                                <BreezeInput id="parent_mobile" type="tel" class="mt-1 block w-full" v-model="form.parent_mobile" required />
                            </div>

                            <div class="mt-2">
                                <BreezeLabel for="parent_address" value="Anschrift (während des Lagers)" />
                                <BreezeInput id="parent_address" type="text" class="mt-1 block w-full" v-model="form.parent_address" required />
                            </div>
                        </div>


                        <div class="flex items-center justify-end mt-4 p-6">
                            <BreezeButton class="ml-4" @click="save" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Speichern und später fortsetzen
                            </BreezeButton>
                            <BreezeButton class="ml-4" @click="apply" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Verbindlich anmelden
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeSelect from '@/Components/Select.vue'
import BreezeRadio from '@/Components/Radio.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeSelect,
        BreezeRadio,
        BreezeCheckbox,
        BreezeLabel,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeValidationErrors,
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                firstname: '',
                lastname: '',
                birthday: '',
                gender: '',
                stamm: '',
                stufe: '',
                role: '',
                prevention: false,
                mail: '',
                insurance_person: '',
                insurance: '',
                vaccination_info_confirmed: false,
                food: '',
                parent_phone: '',
                parent_mobile: '',
                parent_address: '',
                apply: false,
            }),
            staemme: {
                131302: 'Ottobrunn',
                131304: 'Camilo Torres (Hohenbrunn)',
                131305: 'Galileo Galilei (Messestadt Riem)',
                131306: 'Unterhaching 1',
                131307: 'Columbus (Neukeferloh)',
                131308: 'Condor (Waldtrudering)',
                131309: 'Arche Noah (Putzbrunn)',
                131312: 'St. Michael Perlach'
            },
            genders: {
                m: 'männlich',
                w: 'weiblich',
                d: 'divers',
            },
            stufen: {
                woes: 'Wölflinge',
                jupfis: 'Jupfis',
                pfadis: 'Pfadis',
                rover: 'Rover',
                leiter: 'Leiter*innen / Staff'
            },
            foods: {
                vegetarian: 'vegetarisch',
                meet: 'esse auch Fleisch',
                vegan: 'vegan',
                gluten_free: 'glutenfrei',
                lactose_free: 'laktosefrei',
            },
            roles: {
                woeleiter: 'Wö-Leiter*in',
                jupfileiter: 'Jupfi-Leiter*in',
                pfadileiter: 'Pfadi-Leiter*in',
                roverleiter: 'Rover-Leiter*in',
                kitchen: 'Küche',
                cafe: 'Café',
                bildung: 'Bildungscafé',
                dunno: 'Weiß ich noch nicht',
            }
        }
    },

    methods: {
        save() {
            this.form.apply = false
            this.form.post(this.route('participation.store'), {})
        },
        apply() {
            if(confirm('Sicher anmelden?')) {
                this.form.apply = true
                this.form.post(this.route('participation.store'), {})
            }
        }
    }
}
</script>
