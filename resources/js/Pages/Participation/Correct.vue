<template>
    <Head title="Anmeldung korrigieren" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Anmeldung korrigieren
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BreezeValidationErrors class="mb-4" />

                    <form action="#" @submit.prevent="">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Teilnehmer*in
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
                                <BreezeCheckbox id="prevention" class="m-1" v-model:checked="form.prevention" />
                                <BreezeLabel for="prevention" class="inline m-1 text-base text-gray-800" value="Ich habe eine Präventionsschulung (Modul 2d + 2e) besucht" />
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
                                Ernährung
                            </h2>
                            <div class="mt-2">
                                <BreezeRadio id="food" class="mt-1 block w-full" name="food" :options="foods" v-model="form.food" required />
                            </div>
                            <div class="mt-2">
                                <BreezeCheckbox id="gluten" class="m-1" v-model:checked="form.gluten" />
                                <BreezeLabel for="gluten" class="inline m-1 text-base text-gray-800" value="glutenfrei" />
                            </div>
                            <div class="mt-2">
                                <BreezeCheckbox id="lactose" class="m-1" v-model:checked="form.lactose" />
                                <BreezeLabel for="lactose" class="inline m-1 text-base text-gray-800" value="laktosefrei" />
                            </div>
                            <div class="mt-2">
                                <BreezeLabel for="allergies" value="Allergien und sonstige Essensbesonderheiten" />
                                <BreezeInput id="allergies" type="text" class="mt-1 block w-full" v-model="form.allergies" />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200" v-if="!isOver18">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Kontaktdaten der Erziehungsberechtigten
                            </h2>
                            <p>Kontaktdaten eines/einer Erziehungsberechtigten, der/die während des Lagers unter folgenden Kontaktdaten für den Notfall erreichbar ist.</p>
                            <div class="mt-2">
                                <BreezeLabel for="parent_name" value="Vor- und Nachname" />
                                <BreezeInput id="parent_name" type="text" class="mt-1 block w-full" v-model="form.parent_name" required  />
                            </div>
                            <div class="mt-2">
                                <BreezeLabel for="parent_phone" value="Telefon" />
                                <BreezeInput id="parent_phone" type="tel" class="mt-1 block w-full" v-model="form.parent_phone" required  />
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

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Reise Info
                            </h2>
                            <div class="mt-2">
                                <BreezeCheckbox id="bus_there" class="m-1" v-model:checked="form.bus_there" />
                                <BreezeLabel for="bus_there" class="inline m-1 text-base text-gray-800" value="Bus Hinfahrt" />
                            </div>
                            <div class="mt-2">
                                <BreezeCheckbox id="bus_back" class="m-1" v-model:checked="form.bus_back" />
                                <BreezeLabel for="bus_back" class="inline m-1 text-base text-gray-800" value="Bus Rückfahrt" />
                            </div>
                            <div class="mt-2">
                                <BreezeLabel for="travel_comment" value="Kommentar zur Fahrt (optional)" />
                                <BreezeInput id="travel_comment" type="text" class="mt-1 block w-full" v-model="form.travel_comment" />
                            </div>
                            <div class="mt-2">
                                <BreezeLabel for="bus_stop" value="Abfahrtsort" />
                                <BreezeSelect id="bus_stop" class='mt-1 block' :options="bus_stops" v-model='form.bus_stop' />
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Abgabedaten
                            </h2>
                            <div class="mt-2">
                                <BreezeLabel for="signed_at" value="Unterschriebene Anmeldung abgegeben am" />
                                <BreezeInput id="signed_at" type="datetime-local" class="mt-1 block w-full" v-model="form.signed_at" />
                            </div>
                            <div class="mt-2">
                                <BreezeLabel for="paid_at" value="Beitrag bezahlt am" />
                                <BreezeInput id="paid_at" type="datetime-local" class="mt-1 block w-full" v-model="form.paid_at" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4 p-6">
                            <BreezeButton class="ml-4" @click="save" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Speichern
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
import moment from "moment";

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
    props: {
        participation: {
            type: Object,
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                firstname: this.participation.firstname,
                lastname: this.participation.lastname,
                birthday: this.participation.birthday,
                gender: this.participation.gender,
                stamm: this.participation.stamm,
                stufe: this.participation.stufe,
                role: this.participation.role,
                prevention: !!this.participation.prevention,
                mail: this.participation.mail,
                insurance_person: this.participation.insurance_person,
                insurance: this.participation.insurance,
                food: this.participation.food,
                gluten: !!this.participation.gluten,
                lactose: !!this.participation.lactose,
                allergies: this.participation.allergies,
                parent_name: this.participation.parent_name,
                parent_phone: this.participation.parent_phone,
                parent_mobile: this.participation.parent_mobile,
                parent_address: this.participation.parent_address,
                bus_there: !!this.participation.bus_there,
                bus_back: !!this.participation.bus_back,
                bus_stop: this.bus_stop,
                travel_comment: this.participation.travel_comment,
                signed_at: moment(this.participation.signed_at).format('YYYY-MM-DDTHH:mm'),
                paid_at: moment(this.participation.paid_at).format('YYYY-MM-DDTHH:mm'),
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
            },
            roles: {
                woeleiter: 'Wö-Leiter*in',
                jupfileiter: 'Jupfi-Leiter*in',
                pfadileiter: 'Pfadi-Leiter*in',
                roverleiter: 'Rover-Leiter*in',
                kitchen: 'Küche',
                cafe: 'Café',
                bildung: 'Bildungscafé',
                crew: 'Crew/Planungsteam',
                staff: 'Staff/Helfer',
                missing: 'Meine Aufgabe fehlt in der Auswahl',
                dunno: 'Weiß ich noch nicht',
            },
            bus_stops: {
                perlach: 'Perlach',
                riem: 'Riem',
                ottobrunn: 'Ottobrunn',
                vortrupp: 'Vortrupp',
                none: 'Eigene Anreise',
            },
        }
    },

    computed: {
        isOver18() {
            let b = new Date(this.form.birthday)
            return new Date(b.getFullYear() + 18, b.getMonth(), b.getDate()) <= new Date();
        }
    },

    methods: {
        save() {
            this.form
                .transform((data) => {
                    const signedAt = moment(data.signed_at, 'YYYY-MM-DDTHH:mm')
                    const paidAt = moment(data.paid_at, 'YYYY-MM-DDTHH:mm')
                    return {
                        ...data,
                        signed_at: signedAt.isValid() ? signedAt.format('YYYY-MM-DD HH:mm:ss') : null,
                        paid_at: paidAt.isValid() ? paidAt.format('YYYY-MM-DD HH:mm:ss') : null,
                    }
                })
                .post(this.route('participation.saveCorrection', this.participation.id))
        },
    }
}
</script>
