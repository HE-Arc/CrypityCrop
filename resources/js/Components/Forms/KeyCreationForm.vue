<template>
    <p>vault:{{ form.vaultId }}</p>
    <p>folder:{{ form.folderId }}</p>
    <div>
        <form @submit.prevent="form.post(route('passwords.store'))">
            <label for="title">Name: </label>
            <input type="text" id="title" name="title" @input="form.title = $event.target.value" >
            <br>
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" @input="form.username = $event.target.value">
            <br>
            <label for="email">Email: </label>
            <input type="text" id="email" name="email" @input="form.email = $event.target.value">
            <br>
            <label for="password">Password: </label>
            <input type='password' id="password" name="password" @input="form.password = $event.target.value">
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
                    title: null,
                    username: null,
                    email: null,
                    password: null,
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
