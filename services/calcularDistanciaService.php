<?php

// Service responsável pela conversão de duas latitude e longitude (origem e destino) para distância em metros
class CalcularDistanciaService {
    // Esta é a função na qual faz o cálculo da distância em metros, conforme minha pesquisas, este é o método mais famoso e eficaz para esta situação. É chamado de fórmula de Haversine
    // Observações: todos os parâmetros na chamada desta função devem ser passados em radiano...
    function calcularDistancia($latitudeOrigem, $longitudeOrigem, $latitudeDestino, $longitudeDestino) {
        $raioDaTerra = 6371000; // raio da Terra em metros
        $latitudeOrigem = deg2rad($latitudeOrigem);
        $longitudeOrigem = deg2rad($longitudeOrigem);
        $latitudeDestino = deg2rad($latitudeDestino);
        $longitudeDestino = deg2rad($longitudeDestino);

        $dlatitude = $latitudeDestino - $latitudeOrigem;
        $dlongitude = $longitudeDestino - $longitudeOrigem;

        $a = sin($dlatitude/2) * sin($dlatitude/2) + cos($latitudeOrigem) * cos($latitudeDestino) * sin($dlongitude/2) * sin($dlongitude/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        $distancia = $raioDaTerra * $c;

        return round($distancia, 2); // retorna a distancia em decimal arredondada em 2 casas após a vírgula
    }
}