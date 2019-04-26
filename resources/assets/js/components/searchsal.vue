<template>
    <div>
        <p>
        <input  type="text" v-model.lazy="keywords" >
        </p>
        <hr>

        <ul v-if="results.length > 0">
                <table-component :data="results"
                                  sort-by="name" sort-order="asc"
                                  :table-class="'table'"
                                  :filter-input-class="'form-control'"
                                  :loading="true"
                                  :loading-color="'red'"
                 >
                      <table-column show="nuit" label="Nuit"></table-column>
                      <table-column show="nome" label="Nome do Funcionario"></table-column>
                      <table-column show="dataDeNascimento" label="Data de Nascimento"></table-column>
                      <table-column show="codigoOrganico" label="Codigo Organico"></table-column>
                      <table-column show="descricaoDoOrganico" label="Descrição do Organico"></table-column>
                      <table-column show="tipoDeQuadro" label="Tipo de Quadro"></table-column>
                      <table-column show="tipoDeContrato" label="Tipo de Contrato"></table-column>
                      <table-column show="dataDoFimDeContrato" label="Data do Fim do Contrato"></table-column>
                      <table-column show="estadoDeConformidadeDaVinculacao" label="Estado de Confirmidade de Vinculação"></table-column>
                      <table-column show="nib" label="Nib"></table-column>
                      <table-column show="contacto" label="CONTACTO"></table-column>
                      <table-column show="salarioBruto" label="Salario Bruto"></table-column>
                 </table-component>
        </ul>
    </div>
</template>

<script>

export default {
    data() {
        return {
            
            keywords: null,
            results: []
        };
    },

before(request) {
      // set previous request on Vue instance
      this.previousRequest = request;
    },    

    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },

     directives: {
        
    },

    methods: {

        cancelUpload: function () {
        this.previousRequest.abort();
        },
        fetch() {
            axios.get('searchinfo', { params: { keywords: this.keywords } })
                .then(response => this.results = response.data)
                .catch(error => {});
        }

    }




   
}
</script>