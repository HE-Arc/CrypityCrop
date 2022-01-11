<template>
    <input type="radio" id="folder" name="folder" value="folder" v-model="modelType">
    <label for="folder">Folder</label>
    <br>
    <input type="radio" id="key" name="key" value="key" v-model="modelType">
    <label for="key">Key</label>
    <br>
    <KeyCreationForm v-if="modelType == 'key'" :vaultId="vaultId" :folderId="folderId"></KeyCreationForm>
    <FolderCreationForm v-else-if="modelType == 'folder'" :vaultId="vaultId" :folderId="folderId"></FolderCreationForm>
</template>
<script>
import KeyCreationForm from './KeyCreationForm.vue'
import FolderCreationForm from './FolderCreationForm.vue'

    export default {
        components:{
            KeyCreationForm,
            FolderCreationForm,
        },
        props: ['vaultId', 'folderId', 'modelType'],
        emits: ['update:modelType'],
    }
</script>
 