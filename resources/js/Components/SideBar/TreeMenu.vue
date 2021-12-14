<template>
  <div class="tree-menu" :style="indent">
    <img src="/icons/folder.png" alt="" width="20"/><span>{{ label }}</span>
    <tree-menu
      v-for="node in nodes"
      v-bind:key="node"
      :nodes="node.nodes"
      :label="node.label"
      :depth="depth + 1"
    >
    </tree-menu>
  </div>
</template>
<script>
  export default {
    props: [ 'label', 'nodes', 'depth' ],
    name: 'tree-menu',
    computed: {
      indent() {
        return { transform: `translate(${this.depth * 20}px)` }
      }
    }
  }
</script>
