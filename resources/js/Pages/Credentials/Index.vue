<template>
    <Head title="Liste des livres" /> <!-- on charge le component Head qui représente le header de notre page -->

    <breeze-authenticated-layout> <!-- système qui permet d'avoir accès seuement si on est logged, sinon on nous renvoie au login -->
        <h2 class="h4 font-weight-bold">
            Liste des Credentials
        </h2>
        <ElementCreationForm elementid="1"></ElementCreationForm>
        <tree-menu v-for="vault in folder.tree" v-bind:key="vault" :element="vault" :depth="0"></tree-menu>
        <CredentialsTable :folder="folder"></CredentialsTable>

    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CredentialsTable from '@/Components/Table/CredentialsTable.vue'
import TreeMenu from '@/Components/SideBar/TreeMenu.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import  ElementCreationForm from '@/Components/Forms/ElementCreationForm'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CredentialsTable,
        TreeMenu,
        ElementCreationForm,
    },
    props: {
        'folder': {
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
