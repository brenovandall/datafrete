<?php

// Service responsável pela comunicação com a API CEP Aberto
class CepAbertoService {
    // função que faz uma requisição para a API CEP Aberto e verifica se o CEP é realmente válido
    function verificaCepExistente($cep) {
        $url = "https://www.cepaberto.com/api/v3/cep?cep={$cep}";
        $headers = [
            'Authorization: Token token=9c5ab9d416b420b4b6a16c77c8b7c460' // token de autorização da minha conta na CEP Aberto
        ];
    
        // faz a requisição usando curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch); // captura a resposta da API e fecha a requisição
    
        return json_decode($response, true); // retorna os dados da requisição em formato json
    }
}