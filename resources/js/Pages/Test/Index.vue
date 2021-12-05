<template>
    <Head title="Liste des livres" />

    <breeze-authenticated-layout>
        <h2 class="h4 font-weight-bold">
            Liste des livres
            {{display()}}
            <CredentialsTable :folder="folder"></CredentialsTable>
        </h2>

    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CredentialsTable from '@/Components/Table/CredentialsTable.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CredentialsTable,
    },
    props: {
        'folder': {
            type: Object,
            required: true
        }
    },
    methods: {
        display() {
            console.log("TESTs : ")
            //console.log(folder)
        },
    }
}
</script>

<style>

</style>