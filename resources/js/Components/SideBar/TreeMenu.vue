<template>
  <div class="tree-menu" :style="indent">
    <details v-if="element.type == 'folder' || element.type == 'vault'">
        <summary @click="updatePasswords">
            <element-menu :bullet="'icons/'+element.type+'.png'"  :element="element" :form="form"></element-menu>
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
        <element-menu :bullet="'icons/'+element.type+'.png'"  :element="element" :form="form"></element-menu>
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
                
                this.form.data = this.element
                
            },
        },
    }
</script>
