<template>
    <Head title="Liste des mots de passe" /> <!-- on charge le component Head qui représente le header de notre page -->

    <breeze-authenticated-layout> <!-- système qui permet d'avoir accès seuement si on est logged, sinon on nous renvoie au login -->
        <h2 class="h4 font-weight-bold">
            Liste des mots de passe
        </h2>
        <Modal :param="formRepo">
            <div>
                <ElementCreationForm :vaultId="formRepo.vault_id" :folderId="formRepo.folder_id"></ElementCreationForm>
            </div>
        </Modal>
        
        <div class="container">
            
            <div class="row">
                <div class="col-3">
                    <tree-menu v-for="vault in tree" v-bind:key="vault" :element="vault" :form="formRepo"></tree-menu>
                </div>
                <CredentialsTable class="col" :passwords="formRepo.data"></CredentialsTable>
            </div>
        </div>
        <!--{{ tree }}-->
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CredentialsTable from '@/Components/Table/CredentialsTable.vue'
import TreeMenu from '@/Components/SideBar/TreeMenu.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import  ElementCreationForm from '@/Components/Forms/ElementCreationForm'
import Button from '@/Components/Button.vue'
import Modal from '@/Components/Modal/Modal.vue'

export default {
    data() {
        return {
            formRepo: {
                'data': [],
                'vault_id': 0,
                'folder_id': 0,
                'creation_modal_displayed': false,
            }
        };
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CredentialsTable,
        TreeMenu,
        ElementCreationForm,
        Button,
        Modal,
    },
    props: {
        'tree': {
            type: Object,
            required: true
        },
    },
    methods: {
    },
}
</script>

<style>

</style>
