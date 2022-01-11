<template>
    <div>
        <form @submit.prevent="form.post(route('folders.store'))">
            <label for="name">Name: </label>
            <input id="name" @input="form.name = $event.target.value" type="text" name="name" required>
            <input id="submit" type="submit" value="Submit">
        </form>
    </div>
</template>
<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    export default {
        props: ["vaultId", "folderId"],
        data() {
            return {
                form: useForm({
                    name: null,
                    vaultId: this.vaultId,
                    folderId: this.folderId,
                }),
            }
        },
        watch: { 
            //check if vault id change and refresh (before modal, form was displayed on page)
            vaultId: function(newVal, oldVal) { 
                this.form.vaultId = newVal
            },
            
            //check if folder id change and refresh (before modal, form was displayed on page)
            folderId: function(newVal, oldVal) {
                this.form.folderId = newVal
            }
        }
    }
</script>
