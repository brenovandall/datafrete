<template>
  <!-- Este é o template para adicionar um novo percurso -->
    <h3>Calcular nova rota</h3>
      <!-- Faz a chamada no método adicionarPercurso. Note que há campos hidden no formulário, para armazenar as latitude e longitude e calcular a distancia, respectivamente -->
      <form id="form" @submit.prevent="adicionarPercurso">
        <div class="form-control">
          <label for="text">CEP de origem <span style="color: red;">*</span></label>
          <input type="text" id="cep-origem" placeholder="Enter text..." 
            v-bind:class="{ succeededOrigem: validationSuccess, failedOrigem: !validationSuccess }" 
            v-model="cepOrigem" @blur="validarCepOrigem('origem')" ref="cepOrigemInput" />
          <input type="hidden" id="lat-origem" />
          <input type="hidden" id="lon-origem" />
        </div>
        <div class="form-control">
          <label for="text">CEP de destino <span style="color: red;">*</span></label>
          <input type="text" id="cep-destino" placeholder="Enter text..."
          v-bind:class="{ succeededDestino: validationSuccessDestino, failedDestino: !validationSuccessDestino }" 
          v-bind:disabled="isDisabled" v-model="cepDestino" @blur="validarCepDestino('destino')" ref="cepDestinoInput" />
          <input type="hidden" id="lat-destino" />
          <input type="hidden" id="lon-destino" />
        </div>
        <button class="btn" v-bind:disabled="isButtonDisabled">Adicionar Percurso</button>
      </form>
</template>


<script>
import axios from 'axios';
import Toast, { useToast } from 'vue-toastification';
import 'vue-toastification/dist/index.css';

export default {
  data() {
    return {
      cepOrigem: '',
      latOrigem: '',
      lonOrigem: '',
      cepDestino: '',
      latDestino: '',
      lonDestino: '',
      isDisabled: true,
      isButtonDisabled: true,
      validationSuccess: false,
      validationSuccessDestino: false,
    }
  },
  methods: {
    // Méotodo para validar o cep de origem
    validarCepOrigem(campo) {
      axios.post(`http://localhost/datafrete/percursos/validar?cep=${this.cepOrigem}`)
        .then(response => {
          if (campo === 'origem') {
            if(response.data.latitude !== undefined || response.data.longitude !== undefined) {
              if(this.cepOrigem.length < 8 || this.cepOrigem.length > 9) {
                this.isButtonDisabled = true;
                const toast = useToast();
                toast.error('Insira um CEP válido')
                return;
              }
              this.latOrigem = response.data.latitude;
              this.lonOrigem = response.data.longitude;
              this.isDisabled = false;
              this.validationSuccess = true;
            } else {
              this.validationSuccess = false;
              this.isDisabled = true;
              this.isButtonDisabled = true;
              if (campo === 'origem') {
                this.$refs.cepOrigemInput.focus();
              } else {
                this.$refs.cepDestinoInput.focus();
              }
            }
          }
        })
        .catch(error => {
          console.error(error);
        });
    },
    // Méotodo para validar o cep de destino
    validarCepDestino(campo) {
      axios.post(`http://localhost/datafrete/percursos/validar?cep=${this.cepDestino}`)
        .then(response => {
          if (campo === 'destino') {
            if(response.data.latitude !== undefined || response.data.longitude !== undefined) {
              if(this.cepOrigem.length < 8 || this.cepOrigem.length > 9) {
                this.isButtonDisabled = true;
                const toast = useToast();
                toast.error('Insira um CEP válido')
                return;
              } else if(this.cepDestino.length < 8 || this.cepDestino.length > 9) {
                this.isButtonDisabled = true;
                const toast = useToast();
                toast.error('Insira um CEP válido')
                return;
              } else {
                console.log(this.isButtonDisabled)
                this.latDestino = response.data.latitude;
                this.lonDestino = response.data.longitude;
                this.isButtonDisabled = false;
                this.validationSuccessDestino = true;
              }
            } else {
              this.validationSuccessDestino = false;
              this.isDisabled = true;
              this.isButtonDisabled = true;
              if (campo === 'destino') {
              this.$refs.cepOrigemInput.focus();
              } else {
                this.$refs.cepDestinoInput.focus();
              }
            }
          }
        })
        .catch(error => {
          console.error(error);
          this.validationSuccess = false;
          this.isButtonDisabled = true;
          if (campo === 'origem') {
            this.$refs.cepOrigemInput.focus();
          } else {
            this.$refs.cepDestinoInput.focus();
          }
        });
    },
    // Méotodo para enviar o formulário para a API
    adicionarPercurso() {
      console.log('antes');
      if(this.isButtonDisabled == false) {
        console.log('depois');
        axios.post(`http://localhost/datafrete/percursos/adicionar?cep_origem=${this.cepOrigem}&latitude_origem=${this.latOrigem}&longitude_origem=${this.lonOrigem}&cep_destino=${this.cepDestino}&latitude_destino=${this.latDestino}&longitude_destino=${this.lonDestino}`)
        .then(response => {
            console.log(response)
            const toast = useToast();
            toast.success('Percurso adicionado com sucesso!')
            this.cepOrigem = '';
            this.latOrigem = '';
            this.lonOrigem = '';
            this.cepDestino = '';
            this.latDestino = '';
            this.lonDestino = '';
            this.isDisabled = true;
            this.isButtonDisabled = true;
            this.validationSuccess = false;
            this.validationSuccessDestino = false;
        })
        .catch(error => {
            const toast = useToast();
            toast.error('Algo deu errado durante a inserção')
        })
        .finally(e => {
          this.$emit('update');
        });
      } else {
        const toast = useToast();
        toast.error('Algo deu errado durante a inserção')
      }
    }
  }
}
</script>