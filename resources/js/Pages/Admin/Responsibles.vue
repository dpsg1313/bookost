<template>
    <Head title="Verantwortliche" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Verantwortliche
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div v-if="users.length">
                    <div class="grid-cols-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-1">
                                    <table-head-sort-link column="name" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="admin.user.list">
                                        Name
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    <table-head-sort-link column="email" :sort-column="sortColumn" :sort-desc="sortDesc" routeName="admin.user.list">
                                        Email
                                    </table-head-sort-link>
                                </th>
                                <th class="px-1">
                                    Verantwortlich für
                                </th>
                                <th class="px-1 text-center">
                                    Nur lesen
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users">
                                <td class="border-r border-t px-1">{{user.name}}</td>
                                <td class="border-r border-t px-1">{{user.email}}</td>
                                <td class="border-t px-1">
                                    <select :name="'responsibility_'+user.id" @change="saveResponsibility(user.id, user.responsibleFor, user.readonly)" v-model="user.responsibleFor">
                                        <option value="none">keine</option>
                                        <option value="1313">ganzer Bezirk</option>
                                        <option :value="nummer" v-for="(stamm, nummer) in tribes">{{stamm.name}}</option>
                                    </select>
                                </td>
                                <td class="border-t px-1 text-center">
                                    <BreezeCheckbox class="mx-2" :name="'responsibility_readonly_'+user.id" :disabled="user.responsibleFor === 'none'" :true-value="true" :false-value="false" @change="saveResponsibility(user.id, user.responsibleFor, user.readonly)" v-model:checked="user.readonly" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div v-else>
                    Keine Daten gefunden
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import TableHeadSortLink from "@/Components/TableHeadSortLink";
import StatusBubble from "@/Components/StatusBubble";
import Dropdown from "@/Components/Dropdown";
import BreezeCheckbox from "@/Components/Checkbox";

export default {
    components: {
        Dropdown,
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeCheckbox,
        TableHeadSortLink,
        Head,
        Link,
    },
    props: {
        users: {
            type: Object,
        },
        tribes: {
            type: Object,
        },
        sortColumn: {
            type: String,
        },
        sortDesc: {
            type: Boolean,
        },
    },

    methods: {
        saveResponsibility(userId, group, readonly) {
            const data = {
                'group': group,
                'readonly': !!readonly,
            };
            this.$inertia.post(this.route('admin.user.responsibility', userId), data, {
                preserveScroll: true
            });
        }
    }
}
</script>
