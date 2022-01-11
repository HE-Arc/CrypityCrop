<template>
    <div>
        <form @submit.prevent="form.post(route('vaults.store'))">
            <label for="name">Nom: </label>
            <input id="name" @input="form.name = $event.target.value" type="text" name="name" >
            <input id="submit" type="submit">
        </form>
    </div>
</template>
<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    export default {
        data() {
            return {
                form: useForm({
                    name: null,
                })
            }
        },
    }
</script>
