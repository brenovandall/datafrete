<template>
  <!-- Este é o template pincipal do Vue, aqui está sendo renderizado os outros componentes -->
  <Header />
  <div class="container">
      <History :listaPercursos="listaPercursos" />
      <AddPercurso @update="fetchData" />
  </div>
</template>

<script>
import Header from './components/Header.vue';
import History from './components/History.vue';
import AddPercurso from './components/AddPercurso.vue';
import axios from 'axios';

export default {
  // Definindo os componentes usados
  components: { 
    Header,
    History,
    AddPercurso
  },
  // lista de percursos usadas no componentes 'History'
  data() {
    return {
      listaPercursos: [],
    }
  },
  methods: {
    // fetchData é usado para atualizar a lista de percursos quando algum é adicionado, sendo assim, não é necessário o reload da página
    fetchData() {
      axios.get('http://localhost/datafrete/percursos/listar')
      .then(response => {
        this.listaPercursos = response.data.result;
      })
      .catch(error => {
        console.error(error);
      })
    }
  },
  created() {
    this.fetchData();
  }
}
</script>