<template>
    <Head title="Email Prüfung" />

    <div class="mb-4 text-sm text-gray-600">
        Danke für deine Registrierung! Bevor du so richtig loslegen kannst, bestätige bitte noch deine Email-Adresse, indem du auf den Link in der Email klickst, die wir dir soeben geschickt haben. Wenn du keine Email bekommen hast, überprüfe bitte deinen Spam-Folder oder lasse dir die Email erneut zusenden.
    </div>

    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent" >
        Ein neuer Link wurde an die Email-Adresse geschickt, die du während der Registrierung angegeben hast.
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Bestätigungslink erneut senden
            </BreezeButton>

            <Link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Ausloggen</Link>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        Head,
        Link,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form()
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('verification.send'))
        },
    },

    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent';
        }
    }
}
</script>
