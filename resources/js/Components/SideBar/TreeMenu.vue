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
        v-model:passwords="passwords"
        >

        </tree-menu>
        {{ passwords }}
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
                required: true
            },
            'passwords': {
                type: Object
            },
        },
        emits: ['update:passwords'],
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
                this.$emit('update:passwords', this.element.nodes)
                console.log(this.element.title)
            }
        },
    }
</script>
