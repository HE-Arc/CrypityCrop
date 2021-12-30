<template>
    <img :src="bullet" alt="" width="20"/><span>{{ title }}</span>
</template>
<script>
  export default {
    props: ['bullet', 'title'],
    name: 'element-menu',
  }
</script>
