<template>
    <div>
        <!-- Hide background, quit modal when clicked -->
        <div @click="param.modal_displayed = !param.modal_displayed" class="hidder" v-show="param.modal_displayed"></div>
        <!-- Modal, with quit button -->
        <div class="modal_content"  v-show="param.modal_displayed">
            <i @click.prevent="disable" class="bi bi-x-lg"></i>
            <!-- Content of modal -->
            <slot></slot>
        </div>
    </div>
</template>
<script>


export default {
    props: {
        param: { // must have modal_displayed attribute
            type: Object,
            default: false,
        }
    },
    methods:
    {
        disable: function(event)
        {
            this.param.modal_displayed = !this.param.modal_displayed
        }
    }
}
</script>
<style>
    .modal_content {
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
        z-index: 110;
        border-radius: 5px;
    }
    .modal_content > i {
        position: absolute;
        top: 7px;
        right: 10px;
        z-index: 110;
    }
    .hidder {
        position: fixed;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.2);
        width: 100vw;
        height: 100vh;
        z-index:100;
    }
</style>