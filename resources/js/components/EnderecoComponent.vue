<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="font-weight-bold">CEP</label>
                <input type="text" class="form-control" id="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="font-weight-bold">UF</label>
                <select id="" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="font-weight-bold">Município</label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="form-group col-md-5">
                <label class="font-weight-bold">Bairro</label>
                <input type="text" class="form-control" id="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
               <label class="font-weight-bold">Logradouro</label>
               <input type="text" class="form-control" id="">
            </div>
            <div class="form-group col-md-2">
                <label class="font-weight-bold">Número</label>
                <input type="text" class="form-control" id="">
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Complemento</label>
                <input type="text" class="form-control" id="">
            </div>
        </div> 
    </div>     
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>