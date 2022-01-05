<template>
    <Head title="Abschließen" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Abschließen
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <BreezeValidationErrors class="mb-4" />

                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="firstname" value="Vorname" />
                                <BreezeInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus />
                            </div>

                            <div>
                                <BreezeLabel for="lastname" value="Nachname" />
                                <BreezeInput id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required />
                            </div>

                            <div>
                                <BreezeLabel for="birthday" value="Geburtstag" />
                                <BreezeInput id="birthday" type="text" class="mt-1 block w-full" v-model="form.birthday" required />
                            </div>

                            <div>
                                <BreezeLabel for="stamm" value="Stamm" />
                                <BreezeSelect id="stamm" class='mt-1 block w-full' required :options="staemme" v-model='form.stamm' />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Weiter
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeSelect from '@/Components/Select.vue'
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
                stamm: '',
            }),
            staemme: {
                131306: 'Unterhaching 1',
                131312: 'St. Michael Perlach'
            },
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('participation.store'), {})
        }
    }
}
</script>
