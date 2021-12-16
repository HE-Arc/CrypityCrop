<template>
    <div>
        <form @submit.prevent="form.post(route('key.store'))">
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" @input="name = $event.target.value" >
            <br>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" @input="username = $event.target.value">
            <br>
            <label for="email">Email: </label>
            <input type="text" id="email" name="email" @input="email = $event.target.value">
            <br>
            <label for="password">Password: </label>
            <input type='password' id="password" name="password" @input="password = $event.target.value">
            <input id="submit" type="submit" value="Submit">
        </form>
    </div>
</template>
<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    export default {
        props: ['vaultId', 'folderId'],
        data() {
            return {
                form: useForm({
                    name: null,
                    username: null,
                    email: null,
                    password: null,
                    vault_id: this.vaultId,
                    folder_id: this.folderId,
                })
            }
        },
    }
</script>
