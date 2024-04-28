<template>
    <!-- Aqui é exibido o resultado do último cálculo realizado pelo usuário -->
    <h4>Último cálculo</h4>
    <div class="inc-exp-container">
        <div>
          <h4>Frete</h4>
          <!-- Faz um cálculo bastante superficial do frete, onde cada metro custa 0.10 centavos... Apenas para fins de estilização mesmo -->
          <p class="distancia plus">R$ {{ (ultimaDistancia * 0.10).toFixed(2) }}</p>
        </div>
        <div>
          <h4>Distância (m)</h4>
          <p class="distancia plus">{{ ultimaDistancia }}m</p>
        </div>
    </div>
    <!-- Aqui é listado todos os percursos já calculados -->
    <h3>Histórico</h3>
      <ul v-if="listaPercursos && listaPercursos.length > 0" id="list" class="list">
        <li class="minus percurso-item" v-for="percurso in listaPercursos" :key="percurso.id">
          <div class="percurso-info">
            <!-- Note que abaixo temos dois links para o google maps, ele redireciona para a página do maps com o cep demarcado -->
            <div>Origem - <a target="_blank" :href="'https://www.google.com/maps/search/?api=1&query=' + percurso.cep_origem">{{percurso.cep_origem}}</a></div>
            <div>Destino - <a target="_blank" :href="'https://www.google.com/maps/search/?api=1&query=' + percurso.cep_destino">{{percurso.cep_destino}}</a></div>
          </div>
          <div>
            <!-- Distancia total percorrida -->
            <span>{{percurso.distancia_total}}m</span>
          </div>
        </li>
      </ul>
</template>

<script>
// Consome a lista retornada no fetchData pelo App.vue
export default {
  props: ['listaPercursos'],
  computed: {
    // Retorna a distância do último percurso calculado
    ultimaDistancia() {
      if (this.listaPercursos.length > 0) {
        return this.listaPercursos[this.listaPercursos.length - 1].distancia_total;
      } else {
        return 0;
      }
    }
  }
}
</script>