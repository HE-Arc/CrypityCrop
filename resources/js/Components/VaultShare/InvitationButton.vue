<template>
	<button @click="context_displayed = !context_displayed"><img src="/icons/vault.png" width="20">Vault invitations</button>
	<div v-show="context_displayed">
		<div v-for="invitation in invitations" v-bind:key="invitation">
			<span>Invitation from {{ invitation.sender }} to join {{ invitation.vaultName }}</span>
			<button @click="context_displayed = !context_displayed"><i class="bi bi-bookmark-check-fill"></i></button>
			<button @click="context_displayed = !context_displayed"><i class="bi bi-bookmark-x-fill"></i></button>
		</div>
	</div>
</template>

<script>

import { defineComponent } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default defineComponent({
props: {
	invitations: {
		type: Object,
		default: [],
	},

},
data() {
	return {
		context_displayed: false,
	
	}
}
})
</script>
