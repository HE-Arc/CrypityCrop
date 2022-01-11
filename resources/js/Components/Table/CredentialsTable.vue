<template>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">Titre</th>
				<th scope="col">Nom d'utilisateur</th>
				<th scope="col">Email</th>
				<th scope="col">Mot de passe</th>
				<th scope="col">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<!-- Create a row for each password in password --> 
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
		passwords: { // contain lis of passords
			type: Object,
		},
	},

	data() {
		return {
		}
	},
}
</script>
