<?php

if($action == '') { echo json_encode(['ERRO' => 'Caminho não encontrado']); }


if($action == 'adicionar' && $param == '') {
    $cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : null;
    $latitudeOrigem = isset($_GET['latitude_origem']) ? $_GET['latitude_origem'] : null;
    $longitudeOrigem = isset($_GET['longitude_origem']) ? $_GET['longitude_origem'] : null;
    $cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : null;
    $latitudeDestino = isset($_GET['latitude_destino']) ? $_GET['latitude_destino'] : null;
    $longitudeDestino = isset($_GET['longitude_destino']) ? $_GET['longitude_destino'] : null;

    $service = new CalcularDistanciaService();

    $m = $service->calcularDistancia($latitudeOrigem, $longitudeOrigem, $latitudeDestino, $longitudeDestino);
    var_dump($m);
    if($m != null) {
        $db = DB::connect();
        $rs = $db->prepare("INSERT INTO percursos (cep_origem, cep_destino, distancia_total, 
        criado_em, editado_em) VALUES (?, ?, ?, NOW(), NOW())");
        $exec = $rs->execute([$cepOrigem, $cepDestino, $m]);

        if($exec) {
            echo json_encode(["result" => "Dados inseridos"]);
        } else {
            echo json_encode(["result" => "Falha na inserção"]);
        }
    }
}


if($action == 'validar' && $param == '') {
    $cep = isset($_GET['cep']) ? $_GET['cep'] : null;

    $service = new CepAbertoService();

    $data = $service->verificaCepExistente($cep);
    
    if ($data != null) {
        echo json_encode($data); 
    } else {
        echo "CEP não encontrado";
    }
}