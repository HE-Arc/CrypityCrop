<template>
    <span class="element-menu">
		<img :src="bullet" alt="" width="20"/>

		<!-- Title of element, disapear to be replaced by an input at modification -->
		<span :class="form.selectedElement.id == element.id && form.selectedElement.type == element.type ? 'selected' : ''" v-show="!modify">
			{{ element.title }}
		</span>
		
		<!-- Rename folder -->
		<form v-if="element.type == 'folder'" v-show="modify" @submit.prevent="formUpdate.put(route('folders.update', {id: element.id})); modify=!modify">
            <input id="name" @input="formUpdate.name = $event.target.value" :value="element.title" type="text" name="name" >
        </form>

		<!-- Rename vault -->
		<form v-else-if="element.type == 'vault'" v-show="modify" @submit.prevent="formUpdate.put(route('vaults.update', {id: element.id})); modify=!modify">
            <input id="name" @input="formUpdate.name = $event.target.value" :value="element.title" type="text" name="name" >
        </form>
		
		<!-- Rename password -->
		<form v-else-if="element.type == 'password'" v-show="modify" @submit.prevent="formPassword.put(route('passwords.update', {id: element.id})); modify=!modify">
            <input id="title" @input="formPassword.title = $event.target.value" :value="element.title" type="text" name="title" >
        </form>

		<!-- Depends od element type, display on hover--> 
		<span class="btn-options">
			<i @click.prevent="add" v-if="element.type == 'folder' || element.type == 'vault'" class="bi bi-plus"></i>
			<i @click.prevent="modify = !modify" class="bi bi-pencil-fill"></i>
			<i @click.prevent="remove" class="bi bi-trash-fill"></i>
			<i @click.prevent="share" v-if="element.type == 'vault'" class="bi bi-share-fill"></i>
		</span>
		
    </span>

</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
import Modal from '@/Components/Modal/Modal.vue'

export default {
	components: {
        Modal,

    },
	props: {
		bullet : {
			type: String,
		}, 
		element: {
			type: Object,
		}, 
		form: {
			type: Object,
		}, 
		modify: {
			type: Boolean,
			default: false,
		},
		share_email_displayed: {
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
    methods: {
		add: function (event) {
			if (this.element.type == "vault") {
				this.form.vaultId = this.element.id
				this.form.folderId = 0
			} else {
				this.form.vaultId = this.element.vault_id
				this.form.folderId = this.element.id
			}
			this.form.modalAdd.modal_displayed = true
		},

		share: function (event) {
			this.form.vaultId = this.element.id
			this.form.modalShare.modal_displayed = true
		},

		remove: function (event) {
			switch(this.element.type)
			{
				case "vault":
					Inertia.delete(route("vaults.destroy", this.element.id)); // remove only when it's last user to have this folder
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
.element-menu {
	width: 80%;

	display: inline-block;
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
	z-index: 50;
	background-color:#F3F4F6;
	color: var(--bs-body-color);
}
</style>