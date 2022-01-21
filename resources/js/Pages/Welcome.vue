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
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <img src="/images/München-Ost_Logo2_noBackground.png" alt="Logo DPSG München-Ost" />
            </div>
            <div class="mt-8 flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1 class="ml-4 text-2xl font-bold text-gray-900 dark:text-white">Bezirkslager 2022</h1>
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

            <div class="mt-8 flex justify-center pt-8 sm:justify-start sm:pt-0">
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
                                Ich weiß, das ist echt schwierig, aber Baden Powell sagt: "Hat man den Willen zu etwas, gelingt es auch, gleich, was einem im Wege steht."
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
                                ... registrieren sich ebenfalls, auch wenn sie nicht mit aufs Lager fahren möchten.<br>
                                Danach müsst ihr leider noch ein wenig warten. Die Anzeige der Anmeldedaten für Verantwortliche befindet sich derzeit noch in der Entwicklung.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1 class="ml-4 text-2xl font-bold text-gray-900 dark:text-white">Trailer zum Bezirkslager</h1>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <video playsinline controls poster="/images/Trailer_Thumbnail.png" class="flex justify-center w-full" tabindex="-1" aria-label="Motto-Reveal-Trailer">
                    <source src="/images/MottoRevealTrailer.mp4" type="video/mp4" />
                    <img src="/img/Trailer_Thumbnail.png" alt="Motto-Logo">
                </video>

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
