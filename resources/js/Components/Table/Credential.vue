<template>
	<td>{{ data.title }}</td>
	<td>{{ data.username }}<button @click="copyToClipboard(data.username)" class="btn"><i class="bi bi-clipboard"></i></button></td>
	<td>{{ data.email }}<button @click="copyToClipboard(data.email)" class="btn"><i class="bi bi-clipboard"></i></button></td>
	<td>{{ data.password }}<button @click="copyToClipboard(data.password)" class="btn"><i class="bi bi-clipboard"></i></button></td>
	<td>
		<!--<Link :href="route('credential.edit', data.id)" class="btn btn-primary"><i class="bi bi-pencil"></i></Link>-->
		<Link href="/dashboard" class="btn btn-primary"><i class="bi bi-pencil"></i></Link>
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
