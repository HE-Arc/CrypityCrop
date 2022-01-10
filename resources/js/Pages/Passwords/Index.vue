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

        <Modal :param="formVault">
            <div>
                <VaultCreationForm></VaultCreationForm>
            </div>
        </Modal>
        
        <div class="container">
            
            <div class="row">
                <div class="col-3">
                    <tree-menu v-for="vault in tree" v-bind:key="vault" :element="vault" :form="formRepo"></tree-menu>
                    <button @click="formVault.modal_displayed = true"><img src="/icons/vault.png" width="20">+</button>
                </div>
                <CredentialsTable class="col" :passwords="formRepo.data.nodes"></CredentialsTable>
            </div>
        </div>
        <InvitationButton :invitations="invitations"></InvitationButton>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CredentialsTable from '@/Components/Table/CredentialsTable.vue'
import TreeMenu from '@/Components/SideBar/TreeMenu.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import  ElementCreationForm from '@/Components/Forms/ElementCreationForm'
import  VaultCreationForm from '@/Components/Forms/VaultCreationForm'
import Button from '@/Components/Button.vue'
import Modal from '@/Components/Modal/Modal.vue'
import InvitationButton from '@/Components/VaultShare/InvitationButton.vue'
export default {
    data() {
        return {
            formRepo: {
                'data': [],
                'vault_id': 0,
                'folder_id': 0,
                'modal_displayed':false,
            },
            formVault: {
                'modal_displayed': false,
            },
            invitations: [
                {'sender': "Jean-Mouloude", 'vaultName': "vault1"},
                {'sender': "Albert Einstein", 'vaultName': "vaultAE"},
                {'sender': "GTrux", 'vaultName': "vaultsélkj"},
            ],
        };
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CredentialsTable,
        TreeMenu,
        ElementCreationForm,
        VaultCreationForm,
        Button,
        Modal,
        InvitationButton,
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
