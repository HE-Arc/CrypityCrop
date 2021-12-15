<template>
    <input type="radio" id="folder" value="folder" v-model="modelType">
    <label for="folder">Folder</label>
    <br>
    <input type="radio" id="key" value="key" v-model="modelType">
    <label for="key">Key</label>
    <br>
    <KeyCreationForm v-if="modelType == 'key'"></KeyCreationForm>
    <FolderCreationForm v-else-if="modelType == 'folder'"></FolderCreationForm>
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
        props: ['elementid', 'modelType'],
        emits: ['update:modelType'],
    }
</script>
