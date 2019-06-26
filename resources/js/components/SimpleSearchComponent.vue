<template>
    <div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-search"></i></span>
            </div>
            <input id="search" name="search" v-model="input_search"  @change="search" type="text" class="form-control" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-default">
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
                word: null,
                component: null,
                input_search: null
            }
        },
        methods: {
            
            search(e)
            {
                this.word = e.target.value;
                this.componet = $('#secretarias');

                console.log(this.component);
            }
        }
    }
</script>