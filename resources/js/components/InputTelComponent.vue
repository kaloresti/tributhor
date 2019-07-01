<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="font-weight-bold">Telefone</label>
                <input id="tel" name="tel" type="text" v-mask="'(##) ####-####'" class="form-control">
            </div>
        </div>
    </div>
</template>

<script>
    import {mask} from 'vue-the-mask'
    export default {
        //props: ['message'],
        directives: {mask},
        mounted() {
            console.log('Component mounted.')
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
