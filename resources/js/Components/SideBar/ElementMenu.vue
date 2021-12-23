<template>
    <img :src="bullet" alt="" width="20"/><span>{{ label }}</span>
</template>
<script>
  export default {
    props: ['bullet', 'label'],
    name: 'element-menu',
  }
</script>
