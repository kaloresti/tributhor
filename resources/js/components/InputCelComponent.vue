<template>
    <div>
        <input id="cel" name="cel" type="text" v-mask="'(##) #####-####'" class="form-control">
    </div>
</template>

<script>
    import {mask} from 'vue-the-mask'
    export default {
        //props: ['message'],
        directives: {mask},
        mounted() {
            console.log('CEL mounted.')
        },
        data() {
            return {
                // cep: null,
                // loading: true,
                // endereco: {},
                // erro: false
            }
        },
        methods: {

        }
    }
</script>
