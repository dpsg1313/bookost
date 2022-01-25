<template>
    <Head title="Neue Anmeldung" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Anmeldung bearbeiten
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
                                Impfungen
                            </h2>
                            <p>Wir empfehlen die Impfung gegen Tetanus (Wundstarrkrampf) sowie Zecken (FSME) für alle Teilnehmenden des Zeltlagers. Bitte überprüft euren Impfschutz rechtzeitig und sprecht ggf. mit eurem Hausarzt.</p>
                            <p>Zur Teilnahme am Zeltlager ist möglicherweise der Nachweis einer Corona-Impfung erforderlich. Welche Regelungen im Sommer 2022 gelten, können wir zum jetzigen Zeitpunkt noch nicht abschätzen.</p>
                            <div class="mt-2">
                                <svg class="w-8 h-8 inline text-indigo-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd"></path></svg>
                                <svg class="w-6 h-6 inline text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <BreezeCheckbox id="vaccination_info_confirmed" class="m-1" v-model:checked="form.vaccination_info_confirmed" />
                                <BreezeLabel for="vaccination_info_confirmed" class="inline m-1 text-base text-gray-800" value="Ich habe die obenstehenden Hinweise zum Thema Impfung gelesen und verstanden" />
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
                                Vereinbarung über die Nutzung von Fotografien und Filmen
                            </h2>
                            <div class="mt-2">
                                Zwischen dem Bezirk München-Ost der Deutschen Pfadfinderschaft Sankt Georg (DPSG) und o.g. Person (bzw. deren Erziehungsberechtigten) wird folgende Nutzungsvereinbarung für Fotografien und Videos getroffen:
                                <ol class="pl-8 list-decimal">
                                    <li>Es wird zugestimmt, dass von der o.g. Person Aufnahmen erstellt und dem Bezirk München-Ost unentgeltlich zum Zwecke der Berichterstattung in Medien, zur Werbung und zur Verwendung nach Ziffer 2 zur Verfügung gestellt werden.</li>
                                    <li>Für die Nutzung wird keine inhaltliche, zeitliche oder räumliche Beschränkung vereinbart. Der Nutzung für folgende Zwecke wird uneingeschränkt zugestimmt:
                                        <ul class="pl-8 list-disc">
                                            <li>Veröffentlichung in den Medien des Bezirks und der Stämme (z.B. Zeitschrift, Newsletter)</li>
                                            <li>Veröffentlichung in der Presse (z.B. Pressefotos)</li>
                                            <li>Veröffentlichung im Internet (z.B. auf den Homepages des Verbandes oder den Auftritten des Verbandes bei Facebook, YouTube, Twitter etc.)</li>
                                        </ul>
                                    </li>
                                    <li>Die/der Fotografierte/Gefilmte stimmt einer Nutzung ihres/seines Fotos/Films zur Nutzung innerhalb von Fotomontagen unter Entfernung oder Ergänzung von Bildbestandteilen bzw. für verfremdete Bilder (keine Entstellung) der Originalaufnahmen zu.</li>
                                    <li>Ein Anspruch auf eine Nutzung im Sinne der Ziffern 1 und 2 wird durch diese Vereinbarung nicht begründet. Der/die Fotografierte/Gefilmte kann beim Bezirk München-Ost die Art der Bild-Nutzung jederzeit erfragen.</li>
                                    <li>Die/der Fotografierte/Gefilmte überträgt dem Fotografen alle zur Ausübung der Nutzung gem. Ziffer 2 notwendigen Rechte an den erstellten Fotografien und Filmen.</li>
                                    <li>Der Name der/des Fotografierten/Gefilmten wird im Sinne des Datenschutzes nicht veröffentlicht. Eine Weitergabe zum Zwecke der Markt- und Meinungsforschung findet nicht statt.</li>
                                    <li>Ein Honorar für die Fotografien und Filme wird nicht gezahlt.</li>
                                    <li>Eine Veränderung an dieser Vereinbarung bedarf der Schriftform.</li>
                                </ol>
                            </div>

                            <div class="mt-2">
                                <svg class="w-8 h-8 inline text-indigo-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.672 1.911a1 1 0 10-1.932.518l.259.966a1 1 0 001.932-.518l-.26-.966zM2.429 4.74a1 1 0 10-.517 1.932l.966.259a1 1 0 00.517-1.932l-.966-.26zm8.814-.569a1 1 0 00-1.415-1.414l-.707.707a1 1 0 101.415 1.415l.707-.708zm-7.071 7.072l.707-.707A1 1 0 003.465 9.12l-.708.707a1 1 0 001.415 1.415zm3.2-5.171a1 1 0 00-1.3 1.3l4 10a1 1 0 001.823.075l1.38-2.759 3.018 3.02a1 1 0 001.414-1.415l-3.019-3.02 2.76-1.379a1 1 0 00-.076-1.822l-10-4z" clip-rule="evenodd"></path></svg>
                                <svg class="w-6 h-6 inline text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <BreezeCheckbox id="foto_consent_confirmed" class="m-1" v-model:checked="form.foto_consent_confirmed" />
                                <BreezeLabel for="foto_consent_confirmed" class="inline m-1 text-base text-gray-800" value="Ich akzeptiere die obenstehende Vereinbarung über die Nutzung von Fotografien und Filmen" />
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
    props: {
        participation: {
            type: Object,
        },
    },

    data() {
        console.log(this.participation.birthday)
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
                vaccination_info_confirmed: !!this.participation.vaccination_info_confirmed,
                food: this.participation.food,
                gluten: !!this.participation.gluten,
                lactose: !!this.participation.lactose,
                allergies: this.participation.allergies,
                parent_name: this.participation.parent_name,
                parent_phone: this.participation.parent_phone,
                parent_mobile: this.participation.parent_mobile,
                parent_address: this.participation.parent_address,
                foto_consent_confirmed: !!this.participation.foto_consent_confirmed,
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
                dunno: 'Weiß ich noch nicht',
            }
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
            this.form.post(this.route('participation.update', this.participation.id), {})
        },
        apply() {
            if(confirm('Sicher anmelden?')) {
                this.form.post(this.route('participation.update-and-apply', this.participation.id), {})
            }
        }
    }
}
</script>
