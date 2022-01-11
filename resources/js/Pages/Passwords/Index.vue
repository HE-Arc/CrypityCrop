<template>
    <!-- Page title -->
    <Head title="Liste des mots de passe" />

    <!-- Menu header -->
    <breeze-authenticated-layout>
        <h2 class="h4 font-weight-bold">
            Liste des mots de passe
        </h2>

        <!-- Modal to add folder or password -->
        <Modal :param="dataTree.modalAdd">
            <h5>Création d'un mot de passe / dossier</h5>
            <p>Saisissez les données de l'objet que vous souahitez créer.</p>
            <div>
                <ElementCreationForm :vaultId="dataTree.vaultId" :folderId="dataTree.folderId"></ElementCreationForm>
            </div>
        </Modal>

        <!-- Modal to share Vault-->
        <Modal :param="dataTree.modalShare">
            <h5>Partager votre coffre avec quelqu'un</h5>
            <p>Saisissez l'adresse mail de la personne avec qui vous voulez partager votre coffre.</p>
            <div>
                <form @submit.prevent="formShare.post(route('usersvaults.shareVaultWithEmail'))">
                    <label for="email">Email: </label>
                    <input id="email" @input="formShare.email = $event.target.value; formShare.vaultId = dataTree.vaultId" placeholder="Email" type="email" name="email" >
                    <input type="submit"/>
			    </form>
            </div>
        </Modal>

        <!-- Modal to create Vault-->
        <Modal :param="modalAddVault">
            <h5>Création d'un nouveau coffre fort</h5>
            <p>Saisissez un nom pour votre coffre fort.</p>
            <div>
                <VaultCreationForm></VaultCreationForm>
            </div>
        </Modal>
        
        <!-- Tab of selected folder or vault -->
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <!-- Create a vault tree menu for all vault in tree (recursive) -->
                    <TreeMenu v-for="vault in tree" v-bind:key="vault" :element="vault" :form="dataTree"></TreeMenu>
                    <!-- Button to add vault -->
                    <button @click="modalAddVault.modal_displayed = true"><img src="/icons/vault.png" width="20"> Nouveau coffre</button>
                </div>
                <!-- Table of selected items -->
                <CredentialsTable class="col" :passwords="dataTree.selectedElement.nodes"></CredentialsTable>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>

import { Head, useForm } from '@inertiajs/inertia-vue3'


import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

import CredentialsTable from '@/Components/Table/CredentialsTable.vue'
import TreeMenu from '@/Components/SideBar/TreeMenu.vue'
import Modal from '@/Components/Modal/Modal.vue'
import ElementCreationForm from '@/Components/Forms/ElementCreationForm'
import VaultCreationForm from '@/Components/Forms/VaultCreationForm'

export default {
    data() {
        return {
            dataTree: {
                selectedElement: [], // contain a copy of selected element
                vaultId: 0, // vault id for share to add element in
                folderId: 0, // folder id to add element in
                modalAdd: { // object to transmit to the modal to change display
                    modal_displayed: false,
                },
                modalShare: { // object to transmit to the modal to change display
                    modal_displayed: false,
                }
            },
            modalAddVault: { // object to transmit to the modal to change display
                modal_displayed: false,
            },
            formShare: useForm({ // form to share a vault
				email: null,
				vaultId: null,
			}),
        };
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        CredentialsTable,
        TreeMenu,
        ElementCreationForm,
        VaultCreationForm,
        Modal,
    },
    props: {
        tree: { // contains all vaults of user
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
