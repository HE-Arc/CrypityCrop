<template>
    <Head title="Liste des mots de passe" /> <!-- on charge le component Head qui représente le header de notre page -->

    <breeze-authenticated-layout> <!-- système qui permet d'avoir accès seuement si on est logged, sinon on nous renvoie au login -->
        <h2 class="h4 font-weight-bold">
            Liste des mots de passe
        </h2>
        <CredentialsTable :passwords="tree[1].nodes"></CredentialsTable>
        <tree-menu v-for="vault in tree" v-bind:key="vault" :element="vault" :depth="0"></tree-menu>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CredentialsTable from '@/Components/Table/CredentialsTable.vue'
import TreeMenu from '@/Components/SideBar/TreeMenu.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CredentialsTable,
        TreeMenu,
    },
    props: {
        'tree': {
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
