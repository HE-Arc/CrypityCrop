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
        </form>
		<i v-if="element.type == 'folder' || element.type == 'vault'" @click="add" class="bi bi-plus"></i>
		<i @click="modify = !modify" class="bi bi-pencil-fill"></i>
		<i @click="remove" class="bi bi-trash-fill"></i>
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
			event.preventDefault()
		},
		rename: function (event) {
			event.preventDefault()
			this.modify = !this.modify;

			//Inertia.put(route("folders.update", {id: this.element.id}), this.formUpdate);
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
			
			event.preventDefault()
		},
	}
}
</script> 
<style>
.selected {
	background-color: blue;
	color: white;
}
.element-menu > i {
	margin: 3px;
	visibility: hidden;
}
.element-menu:hover > i {
	visibility: visible;
}
.element-menu > form {
	display: inline;
	max-width: 50px;
	
}
</style>