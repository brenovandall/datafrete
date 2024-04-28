<?php

class CepAbertoService {
    function verificaCepExistente($cep) {
        $url = "https://www.cepaberto.com/api/v3/cep?cep={$cep}";
        $headers = [
            'Authorization: Token token=9c5ab9d416b420b4b6a16c77c8b7c460'
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($response, true);
    }
}