<template>
    <Head title="Liste des mots de passe" /> <!-- on charge le component Head qui représente le header de notre page -->

    <breeze-authenticated-layout> <!-- système qui permet d'avoir accès seuement si on est logged, sinon on nous renvoie au login -->
        <h2 class="h4 font-weight-bold">
            Liste des mots de passe
            <CredentialsTable :folder="passwords"></CredentialsTable>
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
        'passwords': {
            type: Object,
            required: true 
        }
    },
    methods: {

    }
}
</script>

<style>

</style>