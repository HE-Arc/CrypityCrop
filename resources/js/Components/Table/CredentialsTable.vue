<template>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">Title</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Password</th>
				<th scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="cred in passwords" v-bind:key="cred">
				<credential v-if="cred.type=='password'" :data="cred"></credential>
			</tr>
		</tbody>
	</table>
</template>

<script>
import Credential from './Credential.vue'

export default {
    components: {
        Credential,
	},

    props: {
		passwords: {
			type: Object,
		},
	},

	data() {
		return {
		}
	},
}
</script>
