<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="font-weight-bold">CEP</label>
                <input id="cep" name="cep" v-model="endereco.cep"  type="text" v-mask="'#####-###'" class="form-control" @change="pesquisarCep" >
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="font-weight-bold">UF</label>
                <input id="uf" name="uf" v-model="endereco.uf" type="text" class="form-control" >
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
            <div class="form-group col-md-5">
                <label class="font-weight-bold">Município</label>
                <input id="localidade" name="localidade" v-model="endereco.localidade"  type="text" class="form-control" >
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
            <div class="form-group col-md-5">
                <label class="font-weight-bold">Bairro</label>
                <input id="bairro" name="bairro" v-model="endereco.bairro" type="text" class="form-control">
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
               <label class="font-weight-bold">Logradouro</label>
               <input id="logradouro" name="logradouro" v-model="endereco.logradouro"  type="text" class="form-control">
               <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
            <div class="form-group col-md-2">
                <label class="font-weight-bold">Número</label>
                <input id="numero" name="numero" v-model="endereco.numero" type="text" class="form-control">
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Complemento</label>
                <input id="complemento" name="complemento" v-model="endereco.complemento"  type="text" class="form-control" >
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
             <div class="form-group col-md-2">
                <label class="font-weight-bold">Ibge</label>
                <input readonly id="ibge" name="ibge" v-model="endereco.ibge"  type="text" class="form-control disabled" >
                <span v-if="erro == true" class="badge badge-danger">CEP não localizado!</span>
            </div>
        </div> 
    </div>     
</template>

<script>
    import {mask} from 'vue-the-mask'
    import axios from "axios";
    export default {
        directives: {mask},
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                cep: null,
                loading: true,
                endereco: {},
                erro: false
            }
        },
        methods: {
            pesquisarCep(e) {
                this.cep = e.target.value;
                this.cep = this.cep.replace('-', '');
                var self = this;
                
                $.getJSON("https://viacep.com.br/ws/" + this.cep + "/json/", function(endereco){
                    if(endereco.erro == true)
                    {
                        self.endereco = {};
                        self.erro = true;
                        $("#cep").focus();
                    }else {
                        self.erro = false;
                        console.log(endereco);
                        self.endereco = endereco;
                        $("#numero").focus();
                    }
                });
            }
        }
    }
</script>
