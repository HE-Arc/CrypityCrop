<template>
ok
    <div>
        <form @submit.prevent="form.post(route('folders.insertion'))">
            <label for="name">Name: </label>
            <input id="name" @input="name = $event.target.value" type="text" name="name" >
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
                    vault_id: this.vaultId,
                    folder_id: this.folderId,
                })
            }
        },
    }
</script>
