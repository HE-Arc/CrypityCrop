<template>
	<td>{{ data.name }}</td>
	<td>{{ data.username }}<button @click="copyUsername()" class="btn"><i class="bi bi-trash"></i></button></td>
	<td>{{ data.email }}</td>
	<td>{{ data.password }}<button @click="copyPassword()" class="btn"><i class="bi bi-trash"></i></button></td>
	<td>
		<!--<Link :href="route('credential.edit', data.id)" class="btn btn-primary"><i class="bi bi-pencil"></i></Link>-->
		<a href="credential/edit" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
		<button @click="destroy(data.id)" class="btn btn-danger"><i class="bi bi-trash"></i></button>
	</td>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
		Link
    },

    props: {
		data: {
			type: Object,
			required: true,
		},
	},
	methods: {
		destroy(id) {
			console.log(id)
            //Inertia.delete(route("credential.destroy", id));
        },
		copyPassword() {
			navigator.clipboard.writeText(data.password)
			.then(() => {
				console.log("Successfully wrote password in the clipboard")
				// TODO: spawn a little toast to notify user about copy success
			})
			.catch(err => {
				console.log("Couldn't write password in the clipboard", err);
				// TODO: spawn a little toast to notify user about copy failure
			});
		},
	
		copyUsername() {
			navigator.clipboard.writeText(data.username)
			.then(() => {
				console.log("Successfully wrote username in the clipboard")
				// TODO: spawn a little toast to notify user about copy success
			})
			.catch(err => {
				console.log("Couldn't write username in the clipboard", err);
				// TODO: spawn a little toast to notify user about copy failure
			});
		},
	}
}
</script>
