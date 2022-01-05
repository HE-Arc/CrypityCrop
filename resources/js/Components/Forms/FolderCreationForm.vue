<template>
    <p>vault:{{ form.vaultId }}</p>
    <p>folder:{{ form.folderId }}</p>
    <div>
        <form @submit.prevent="form.post(route('folders.store'))">
            <label for="name">Name: </label>
            <input id="name" @input="form.name = $event.target.value" type="text" name="name" >
            <input id="submit" type="submit" value="Submit">
        </form>
    </div>
</template>
<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    export default {
        props: ["vaultId","folderId"],
        data() {
            return {
                form: useForm({
                    name: null,
                    vaultId: this.vaultId,
                    folderId: this.folderId,
                })
            }
        },
        watch: { 
            vaultId: function(newVal, oldVal) {
                console.log("vault")
                this.form.vaultId = newVal
            },
            folderId: function(newVal, oldVal) {
                console.log("folder")
                this.form.folderId = newVal
            }
        }
    }
</script>
