<template>
    <div>
        <div id="bo-alert-success" class="alert alert-success row" :texto="texto" v-show="elementVisible">
            <div class="text-left">
                {{texto}}
            </div>
            <div class="right-close-button ml-4">
                <span v-on:click="elementVisible=false">x</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            texto: String,
        },
        data() {
            return {
                elementVisible: false
            }
        },
        created() {
            this.elementVisible = this.texto ? true : false;

            if(this.texto)
                setTimeout(() => this.elementVisible = false, 6000)
        }
    }
</script>
<style scoped>

#bo-alert-success{
    display: flex;
    position: fixed;
    bottom: 50px;
    right: 25px;
}

</style>