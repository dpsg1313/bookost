<template>
    <Head title="Anmeldung - DPSG München-Ost" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('participation.index')" class="text-sm text-gray-700 underline">
                Anmeldung
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Anmelden
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Registrieren
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-8 justify-items-center sm:justify-items-start items-center grid-cols-1 sm:grid-cols-2 pt-2 sm:justify-start sm:pt-8">
                <img src="/images/München-Ost_Logo2_noBackground.png" alt="Logo DPSG München-Ost" />
                <div class="text-center">
                        <span class="text-lg font-bold text-center">Anmeldungen:</span><br>
                        <div class="inline-grid counter font-digital-clock tracking-wider bg-gray-800 px-2 py-0 rounded-md">
                            <p class="mt-0 mr-0 text-right text-white z-50">{{ participationCount }}</p>
                            <p class="mt-0 mr-0 text-right text-gray-700">8888</p>
                        </div>
                </div>
            </div>
            <div class="mt-8 flex pt-8 sm:justify-start sm:pt-0">
                <h1 class="ml-4 text-2xl font-bold text-gray-900 dark:text-white">Bezirkslager 2025</h1>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 justify-items-stretch justify-around">
                    <div class="p-6 sm:border-b sm:border-r lg:border-b-0 border-gray-200 dark:border-gray-700 text-center">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Termin</h2>
                        <ul class="">
                            <li>von 28. August</li>
                            <li>bis 4. September</li>
                        </ul>
                    </div>
                    <div class="p-6 sm:border-b sm:border-l lg:border-b-0 lg:border-r border-gray-200 dark:border-gray-700 text-center">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Kosten</h2>
                        <ul class="">
                            <li>100€ für Kinder/Jugendliche</li>
                            <li>50€ für Leiter*innen</li>
                        </ul>
                    </div>
                    <div class="p-6 sm:border-t sm:border-r lg:border-t-0 lg:border-l border-gray-200 dark:border-gray-700 text-center">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Ort</h2>
                        <div>
                            Zeltplatz Bucher Berg<br>
                            in Breitenbrunn (Oberpfalz)
                        </div>
                    </div>
                    <div class="p-6 sm:border-t sm:border-l lg:border-t-0 border-gray-200 dark:border-gray-700 text-center">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Anmeldeschluss</h2>
                        <div>
                            17. April 2022<br>
                            Ostersonntag
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <a :href="loginRoute" >
                    <BreezeButton type="button" class="text-xl" >
                        Zur Anmeldung
                    </BreezeButton>
                </a>
            </div>

            <div class="mt-8 flex pt-8 sm:justify-start sm:pt-0">
                <h1 class="ml-4 text-2xl font-bold text-gray-900 dark:text-white">Anmeldung zum Bezirkslager</h1>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-16 h-16 text-gray-500"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                            <div>
                                <div class="ml-4 text-2xl leading-7 font-bold text-gray-900 dark:text-white underline">Eltern</div>
                                <div class="ml-4 text-md leading-7 font-semibold text-gray-900 dark:text-white">die ihre Kinder anmelden möchten...</div>
                            </div>
                        </div>


                        <div class="ml-20">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-md">
                                ... können alle Kinder über ein einziges Benutzerkonto anmelden.
                                Bitte registrieren Sie sich mit Ihrem Namen und Ihrer Email-Adresse auf dieser Seite.
                                Anschließend füllen Sie für jedes Kind einzeln die Anmeldung aus.
                                Die Anmeldungen werden in einer Liste aufgeführt und können vor dem Absenden beliebig oft bearbeitet werden.
                                Nach dem Absenden erhalten Sie die Unterlagen zum Ausdrucken und Unterschreiben, um sie beim Stamm abzugeben.
                                Außerdem können Sie jederzeit den Status der Anmeldung einsehen.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-16 h-16 text-gray-500"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>
                            <div>
                                <div class="ml-4 text-2xl leading-7 font-bold text-gray-900 dark:text-white underline">Jugendliche</div>
                                <div class="ml-4 text-md leading-7 font-semibold text-gray-900 dark:text-white">die sich selbst anmelden möchten...</div>
                            </div>
                        </div>


                        <div class="ml-20">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-md">
                                ... registrieren sich und füllen anschließend die Anmeldung aus.<br>
                                Nachdem du deine Anmeldung abgeschickt hast, bekommst du ein PDF.
                                Das druckst du aus, unterschreibst es und lässt es deine Eltern unterschreiben, wenn du noch keine 18 Jahre alt bist.<br>
                                Anschließend gibst du es bei deinen Leiter*innen ab.<br>
                                Ganz einfach, das schaffst du locker!
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-16 h-16 text-gray-500"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                            <div>
                                <div class="ml-4 text-2xl leading-7 font-bold text-gray-900 dark:text-white underline">Leiter*innen</div>
                                <div class="ml-4 text-md leading-7 font-semibold text-gray-900 dark:text-white">die sich anmelden möchten...</div>
                            </div>
                        </div>


                        <div class="ml-20">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-md">
                                ... registrieren sich, füllen anschließend die Anmeldung aus und achten dabei darauf, bei der Auswahl Stufe 'Leiter*innen' anzuklicken.<br>
                                Wir wissen, das ist echt schwierig, aber um Baden Powell zu zitieren: "Hat man den Willen zu etwas, gelingt es auch, gleich, was einem im Wege steht."
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-16 h-16 text-gray-500"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                            <div>
                                <div class="ml-4 text-2xl leading-7 font-bold text-gray-900 dark:text-white underline">Verantwortliche</div>
                                <div class="ml-4 text-md leading-7 font-semibold text-gray-900 dark:text-white">die Zugriff auf die Daten ihres Stammes benötigen...</div>
                            </div>
                        </div>


                        <div class="ml-20">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-md">
                                ... registrieren sich ebenfalls, egal ob ihr aufs Lager mitfahren möchtet oder nicht.<br>
                                Danach meldet ihr euch bei den BeVos und lasst euch für die Verwaltung freischalten. Gebt dabei bitte die Emailadresse an, die ihr bei der Registrierung verwendet habt.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex pt-8 sm:justify-start sm:pt-0">
                <h1 class="ml-4 text-2xl font-bold text-gray-900 dark:text-white">Fragen & Antworten</h1>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div
                        class="accordion-item border-t-0 border-l-0 border-r-0 rounded-none bg-white border border-gray-200">
                        <h2 class="accordion-header mb-0" id="flush-headingOne">
                            <button class="accordion-button
                                    collapsed
                                    relative
                                    flex
                                    items-center
                                    w-full
                                    py-4
                                    px-5
                                    text-base text-gray-800 text-left
                                    bg-white
                                    border-0
                                    rounded-none
                                    transition
                                    focus:outline-none
                                    font-bold"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq-1"
                                    aria-expanded="false" aria-controls="faq-1">
                                Wie kommen wir zum Lagerplatz?
                            </button>
                        </h2>
                        <div id="faq-1" class="accordion-collapse border-0 collapse"
                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body py-4 px-5">
                                Wir fahren gemeinsam mit Reisebussen von München zum Lagerplatz und wieder zurück.<br>
                                Die genauen Abfahrtszeiten und -orte werden noch bekannt gegeben.<br>
                                Die Fahrtkosten sind im Lagerbeitrag enthalten.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-l-0 border-r-0 rounded-none bg-white border border-gray-200">
                        <h2 class="accordion-header mb-0" id="flush-headingTwo">
                            <button class="accordion-button
                                    collapsed
                                    relative
                                    flex
                                    items-center
                                    w-full
                                    py-4
                                    px-5
                                    text-base text-gray-800 text-left
                                    bg-white
                                    border-0
                                    rounded-none
                                    transition
                                    focus:outline-none
                                    font-bold"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq-2"
                                    aria-expanded="false" aria-controls="faq-2">
                                Was ist im Lagerbeitrag enhalten?
                            </button>
                        </h2>
                        <div id="faq-2" class="accordion-collapse border-0 collapse"
                             aria-labelledby="flush-headingTwo"
                             data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body py-4 px-5">
                                Im Lagerbeitrag enthalten sind:
                                <ul class="px-8 py-2 list-disc">
                                    <li>7 Übernachtungen im Zelt</li>
                                    <li>Hin- und Rückfahrt im Reisebus</li>
                                    <li>Vollverpflegung</li>
                                    <li>Pfadfinderisches Mitmachprogramm ;-)</li>
                                </ul>
                                Nicht enthalten sind:
                                <ul class="px-8 py-2 list-disc">
                                    <li>Zusätzliche Getränke oder Snacks in unserem Lager-Café</li>
                                    <li>eigene Fahrtkosten bei verspäteter Anreise oder frühzeitiger Abreise</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div
                        class="accordion-item border-l-0 border-r-0 border-b-0 rounded-none bg-white border border-gray-200">
                        <h2 class="accordion-header mb-0" id="flush-headingThree">
                            <button class="accordion-button
                                    collapsed
                                    relative
                                    flex
                                    items-center
                                    w-full
                                    py-4
                                    px-5
                                    text-base text-gray-800 text-left
                                    bg-white
                                    border-0
                                    rounded-none
                                    transition
                                    focus:outline-none
                                    font-bold"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq-3"
                                    aria-expanded="false" aria-controls="faq-3">
                                Was benötige ich für die Teilnahme?
                            </button>
                        </h2>
                        <div id="faq-3" class="accordion-collapse collapse"
                             aria-labelledby="flush-headingThree"
                             data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body py-4 px-5">
                                Als persönliche Lagerausstattung benötigst du einen Schlafsack und eine Isomatte sowie eigenes Geschirr und Besteck.<br>
                                Was du sonst noch zum Zeltlager mitnehmen solltest (vor allem an geeigneter Kleidung), fragst du am besten deine Leiter*innen. Die haben sicher einiges an Erfahrung!
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <a href="https://dpsg1313.de/datenschutz/" class="ml-1 underline">
                            Datenschutz
                        </a>

                        <a href="https://dpsg1313.de/impressum/" class="ml-1 underline">
                            Impressum
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0" v-if="laravelEnvironment !== 'production'">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @font-face{
        font-family:'digital-clock-font';
        src: url('/fonts/digital-7 (mono).ttf');
    }

    .font-digital-clock{
        font-family: 'digital-clock-font', serif;
    }

    .counter {
        font-size: 4rem;
        line-height: 4rem;
    }

    .counter > * {
        grid-area: 1/1;
    }

    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
import BreezeButton from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeButton,
        Head,
        Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        participationCount: Number,
    },

    computed: {
        loginRoute(){
            if(this.$page.props.auth.user){
                return this.route('participation.index')
            }else{
                return this.route('register')
            }
        }
    }
}
</script>
