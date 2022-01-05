<template>
   
    <button id="close"><i class="bi bi-x-lg"></i></button>
    <br>
    <input type="radio" id="folder" value="folder" v-model="modelType">
    <label for="folderId">Folder</label>
    <br>
    <input type="radio" id="key" value="key" v-model="modelType">
    <label for="key">Key</label>
    <br>
    <KeyCreationForm v-if="modelType == 'key'" :vaultId="vaultId" :folderId="folderId"></KeyCreationForm>
    <FolderCreationForm v-else-if="modelType == 'folder'" :vaultId="vaultId" :folderId="folderId"></FolderCreationForm>
</template>
<script>
import Input from '../Input.vue'
import KeyCreationForm from './KeyCreationForm.vue'
import FolderCreationForm from './FolderCreationForm.vue'

    export default {
        components:{
            KeyCreationForm,
            FolderCreationForm,
        },
        props: ['vaultId', 'folderId', 'modelType'],
        emits: ['update:modelType'],
        methods: {
            
        },
    }
</script>
 