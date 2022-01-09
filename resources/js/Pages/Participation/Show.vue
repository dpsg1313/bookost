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
                    <div class="p-6 bg-white border-b border-gray-200" v-if="participation.applied_at" >
                        <a :href="route('participation.pdf', { id: participation.id })" class="ml-4" download >
                            <BreezeButton type="button">
                                PDF herunterladen
                            </BreezeButton>
                        </a>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200" v-else >
                        <BreezeValidationErrors class="mb-4" />

                        <form @submit.prevent="submit">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Verbindlich anmelden
                            </BreezeButton>
                        </form>
                        <a :href="route('participation.edit', { id: participation.id })" class="ml-4" v-if="!participation.applied_at">
                            <BreezeButton type="button">
                                Bearbeiten
                            </BreezeButton>
                        </a>
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

    props: {
        participation: {
            type: Object,
        },
    },

    data() {
        return {
            form: this.$inertia.form({
            }),
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('participation.send', this.participation.id), {})
        }
    }
}
</script>
