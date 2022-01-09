<template>
    <span :class="form.data.id == element.id && form.data.type == element.type ? 'element-menu selected' : 'element-menu'">
		<img :src="bullet" alt="" width="20"/><span v-show="!modify">{{ element.title }}</span>
		<form v-if="element.type == 'folder'" v-show="modify" @submit.prevent="formUpdate.put(route('folders.update', {id: element.id})); modify=!modify">
            <input id="name" @input="formUpdate.name = $event.target.value" :value="element.title" type="text" name="name" >
        </form>
		<form v-else-if="element.type == 'vault'" v-show="modify" @submit.prevent="formUpdate.put(route('vaults.update', {id: element.id})); modify=!modify">
            <input id="name" @input="formUpdate.name = $event.target.value" :value="element.title" type="text" name="name" >
        </form>
		<form v-else-if="element.type == 'password'" v-show="modify" @submit.prevent="formPassword.put(route('passwords.update', {id: element.id})); modify=!modify">
            <input id="title" @input="formPassword.title = $event.target.value" :value="element.title" type="text" name="title" >
        x</form>
		<span class="btn-options">
			<i v-if="element.type == 'folder' || element.type == 'vault'" @click="add" class="bi bi-plus"></i>
			<i @click.prevent="modify = !modify" class="bi bi-pencil-fill"></i>
			<i @click.prevent="remove" class="bi bi-trash-fill"></i>
			<i @click.prevent="share_email_displayed = !share_email_displayed" v-if="element.type == 'vault'" class="bi bi-share-fill"></i>
		</span>
		<form v-show="share_email_displayed" @submit.prevent="formShare.post(route('usersvaults.shareVaultWithEmail'))">
			<input id="email" @input="formShare.email = $event.target.value" placeholder="Email" type="email" name="email" >
		</form>
    </span>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
export default {
	props: {
		'bullet' : {
			type: String,
		}, 
		'element': {
			type: Object,
		}, 
		'form': {
			type: Object,
		}, 
		'modify': {
			type: Boolean,
			default: false,
		},
		'share_email_displayed': {
			type: Boolean,
			default: false,
		}
	},
	data() {
		return {
			formUpdate: useForm({
				name: null,
			}),
			formPassword: useForm({
				title: null,
			}),
			formShare: useForm({
				email: null,
				vaultId: this.element.id,
			}),
		}
    },
    name: 'element-menu',
    methods: {
		add: function (event) {
			if (this.element.type == "vault") {
				this.form.vault_id = this.element.id
				this.form.folder_id = 0
			} else {
				this.form.vault_id = this.element.vault_id
				this.form.folder_id = this.element.id
			}
			this.form.modal_displayed = true
		},
		remove: function (event) {
			switch(this.element.type)
			{
				case "vault":
					console.log("vault supprimer")
					Inertia.delete(route("vaults.destroy", this.element.id));
					break;
				case "folder":
					Inertia.delete(route("folders.destroy", this.element.id));
					break;
				case "password":
					Inertia.delete(route("passwords.destroy", this.element.id));
					break;
			}
		},
		
	}
}
</script> 
<style>
.selected {
	background-color: blue;
	color: #f3f4f6;
}
.element-menu > span > i {
	margin: 3px;
}
.element-menu > .btn-options {
	visibility: hidden;
}
.element-menu:hover > .btn-options {
	visibility: visible;
}
.element-menu > form {
	display: inline;
	max-width: 50px;
	
}
.btn-options {
	position: absolute;
	left: 60%;
	z-index:50;
	background-color:#F3F4F6;
	color: var(--bs-body-color);
}
</style>