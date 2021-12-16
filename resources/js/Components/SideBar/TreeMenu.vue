<template>
  <div class="tree-menu" :style="indent">

    <details v-if="element.type == 'folder' || element.type == 'vault'">
        <summary>
            <element-menu :bullet="'icons/'+element.type+'.png'" :label="element.label"></element-menu>
            <button><i class="bi bi-plus"></i></button>
        </summary>
        <tree-menu
        v-for="node in element.nodes"
        v-bind:key="node"
        :element="node"
        :depth ="1"
        >
        </tree-menu>
    </details>
    <div v-else>
        <element-menu :bullet="'icons/'+element.type+'.png'" :label="element.label"></element-menu>
    </div>
  </div>
</template>
<script>
    import ElementMenu from './ElementMenu.vue'

    export default {
        components: {
            ElementMenu,
        },
        props: [ 'element', 'depth'],
        name: 'tree-menu',
        computed: {
            indent() {
                return { transform: `translate(${this.depth * 20}px)` }
            }
        }
    }
</script>
