<template>
    <div>
        <div class="custom-file">
            <input  @change="onFileChange" type="file" ref="myFiles" class="custom-file-input col-md-12" id="customFile">
            <label class="custom-file-label" for="customFile"></label>
        </div>
        <div id="preview">
            <img class="rounded" v-if="url" :src="url" />
            <button @click="excluir" v-if="url" class="btn btn-danger">excluir</button>
        </div>
    </div>     
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                url: null,
            }
        },
        methods: {
            onFileChange(e) {
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
            },
            excluir(){
                this.url = null;
            },
        }
    }
</script>