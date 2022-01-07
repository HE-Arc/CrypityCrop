<template>
    <div id="modal_content" v-show="param.creation_modal_displayed">
        <button ref="button" @click="param.creation_modal_displayed = !param.creation_modal_displayed"><i class="bi bi-x-lg"></i></button>
        <slot></slot>
    </div>
</template>
<script>


export default {
    props: {
        param: {
            type: Object,
            default: false,
        }
    },
}
</script>
<style scoped>
    #modal_content {
        color: gainsboro;
        display: block;
        position: fixed;
        width: 45%;
        height: 20%;
        max-width: 500px;
        min-height: 200px;
        height: fit-content;
        margin: 0 auto;
        padding: 1%;
        left:0;
        right:0;
        background-color: #1E1E1E;
        opacity: 0.9;
        z-index: 100;
        border-radius: 5px;
    }
    button {
        position: absolute;
        top: 5px;
        right: 5px
    }
</style>