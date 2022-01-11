<template>
  <div :style="indent">
    <!-- If element is folder or vault TreeMenu is recursive -->
    <details v-if="element.type == 'folder' || element.type == 'vault'">
        <summary @click="updatePasswords">
            <ElementMenu @click.prevent="" :bullet="'icons/'+element.type+'.png'"  :element="element" :form="form" />
        </summary>
        <TreeMenu
        v-for="node in element.nodes"
        v-bind:key="node"
        :element="node"
        :form=form
        />
    </details>
    <!-- If element is password -->
    <div v-else>
        <ElementMenu :bullet="'icons/'+element.type+'.png'"  :element="element" :form="form"></ElementMenu>
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
            element: {
                type: Object,
                required: true,
            },
            form: {
                type: Object,
            }
        },
        computed: {
            indent() {
                return { transform: `translate(20px)` }
            }
        },
        methods: {
            updatePasswords: function (event) { //change element to display on table
                this.form.selectedElement = this.element
            },
        },
    }
</script>
