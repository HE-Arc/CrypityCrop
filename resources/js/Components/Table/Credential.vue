<template>
	<!-- One form by element, but enter send all modifications -->
	<td v-show="!modify">{{ form.title }}</td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', { id: data.id })); modify=!modify">
			<input id="title" @input="form.title = $event.target.value" :value="form.title" type="text" name="title" required>
		</form>
	</td>

	<td  v-show="!modify">{{ form.username }}
		<!-- Button to copy content -->
		<button @click="copyToClipboard(form.username)" class="btn"><i class="bi bi-clipboard"></i></button>
	</td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', { id: data.id })); modify=!modify">
			<input id="username" @input="form.username = $event.target.value" :value="form.username" type="text" name="username" >
		</form>
	</td>

	<td v-show="!modify">{{ form.email }}
		<!-- Button to copy content -->
		<button @click="copyToClipboard(form.email)" class="btn"><i class="bi bi-clipboard"></i></button>
	</td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', { id: data.id })); modify=!modify">
			<input id="email" @input="form.email = $event.target.value" :value="form.email" type="text" name="email" >
		</form>
	</td>

	<td  v-show="!modify">{{ passwordDisplayMode(form.password) }}
		<!-- Button to copy content -->
		<button @click="copyToClipboard(form.password)" class="btn"><i class="bi bi-clipboard"></i></button>
	</td>
	<td v-show="modify">
		<form @submit.prevent="form.put(route('passwords.update', { id: data.id })); modify=!modify">
			<input id="password" @input="form.password = $event.target.value" :value="form.password" type="text" name="password" >
		</form>
	</td>

	<td>
		<button @click="modify = !modify" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
		<button @click="destroy(data.id)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
	</td>

</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
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
		destroy(id) { // not change displaying before refresh
            Inertia.delete(route("passwords.destroy", id));
        },
		
		copyToClipboard(textToCopy) {
			navigator.clipboard.writeText(textToCopy)
			.then(() => {
				console.log("Successfully wrote password in the clipboard")
			})
			.catch(err => {
				console.log("Couldn't write password in the clipboard", err);
			});
		},
		
		passwordDisplayMode(password) { // to change password to start (*********)
			if (password != null){

				let nbStars = Math.random() * 10 - 5 + password.length
				let res = ""
				if (nbStars < 8) 
					nbStars = 8
				for (let i = 0; i < nbStars; i++) {
					res += "*"
				}
				return res
			}
			return ""
		},
	}
}
</script>
