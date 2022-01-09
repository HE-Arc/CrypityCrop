<template>
	<td v-show="!modify">{{ form.title }}</td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', {id: data.id})); modify=!modify">
			<input id="title" @input="form.title = $event.target.value" :value="form.title" type="text" name="title" >
		</form>
	</td>
	<td  v-show="!modify">{{ form.username }}<button @click="copyToClipboard(form.username)" class="btn"><i class="bi bi-clipboard"></i></button></td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', {id: data.id})); modify=!modify">
			<input id="username" @input="form.username = $event.target.value" :value="form.username" type="text" name="username" >
		</form>
	</td>
	<td v-show="!modify">{{ form.email }}<button @click="copyToClipboard(form.email)" class="btn"><i class="bi bi-clipboard"></i></button></td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', {id: data.id})); modify=!modify">
			<input id="email" @input="form.email = $event.target.value" :value="form.email" type="text" name="email" >
		</form>
	</td>
	<td  v-show="!modify">{{ form.password }}<button @click="copyToClipboard(form.password)" class="btn"><i class="bi bi-clipboard"></i></button></td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', {id: data.id})); modify=!modify">
			<input id="password" @input="form.password = $event.target.value" :value="form.password" type="text" name="password" >
		</form>
	</td>
	<td>
		<!--<Link :href="route('credential.edit', data.id)" class="btn btn-primary"><i class="bi bi-pencil"></i></Link>-->
		<button @click="modify = !modify" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
		<button @click="destroy(data.id)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
	</td>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
		Link
    },

	data() {
		return {
			form: useForm({
				title: this.data.title,
				username: this.data.username,
				email: this.data.email,
				password : this.data.password
			}),
			
		}
    },

    props: {
		data: {
			type: Object,
			required: true,
		},
		modify: {
			type: Boolean,
			default: false,
		}
	},
	methods: {
		destroy(id) {
			console.log(id)
            Inertia.delete(route("passwords.destroy", id));
        },
		copyToClipboard(textToCopy) {
			navigator.clipboard.writeText(textToCopy)
			.then(() => {
				console.log("Successfully wrote password in the clipboard")
				// TODO: spawn a little toast to notify user about copy success
			})
			.catch(err => {
				console.log("Couldn't write password in the clipboard", err);
				// TODO: spawn a little toast to notify user about copy failure
			});
		},
	}
}
</script>
