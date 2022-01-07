<template>
  <div class="tree-menu" :style="indent">
    <details v-if="element.type == 'folder' || element.type == 'vault'">
        <summary @click="updatePasswords">
            <element-menu :bullet="'icons/'+element.type+'.png'" :title="element.title"></element-menu>
            <button @click="add"><i class="bi bi-plus"></i></button>
        </summary>
        <tree-menu
        v-for="node in element.nodes"
        v-bind:key="node"
        :element="node"
        :form=form
        >

        </tree-menu>
    </details>
    <div v-else>
        <element-menu :bullet="'icons/'+element.type+'.png'" :title="element.title"></element-menu>
    </div>
  </div>
</template>
<script>
    import ElementMenu from './ElementMenu.vue'

    export default {
        components: {
            ElementMenu,
        },
        props: {
            'element': {
                type: Object,
                required: true,
            },
            'form': {
                type: Object,
            }
        },
        name: 'tree-menu',
        computed: {
            indent() {
                return { transform: `translate(20px)` }
            }
        },
        methods: {
            updatePasswords: function (event) {
                // `this` inside methods point to the Vue instance
                // `event` is the native DOM event
                
                this.form.data = this.element.nodes
                
                
            },
            add: function (event){
                if (this.element.type == "vault"){
                    this.form.vault_id = this.element.id
                    this.form.folder_id = 0
                }
                else{
                    this.form.vault_id = this.element.vault_id
                    this.form.folder_id = this.element.id
                }
                this.form.creation_modal_displayed = true
                
                
            }
        },
    }
</script>
