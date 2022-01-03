<template>
  <div class="tree-menu" :style="indent">
    <details v-if="element.type == 'folder' || element.type == 'vault'">
        <summary>
            <element-menu :bullet="'icons/'+element.type+'.png'" :title="element.title"></element-menu>
            <button @click="greet"><i class="bi bi-plus"></i></button>
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
            greet: function (event) {
                // `this` inside methods point to the Vue instance
                // `event` is the native DOM event
                
                this.form.data = this.element.nodes
                
            }
        },
    }
</script>
