<?php

// se nenhuma action é definida, ou seja, algo depois de percursos/, é retornado um json de erro
if($action == '') { echo json_encode(['ERRO' => 'Caminho não encontrado']); }

// este método faz a inclusão de um percuso em banco de dados
if($action == 'adicionar' && $param == '') {
    // primeiramente, obtém os valores de cada "query param" da requisição
    $cepOrigem = isset($_GET['cep_origem']) ? $_GET['cep_origem'] : null;
    $latitudeOrigem = isset($_GET['latitude_origem']) ? $_GET['latitude_origem'] : null;
    $longitudeOrigem = isset($_GET['longitude_origem']) ? $_GET['longitude_origem'] : null;
    $cepDestino = isset($_GET['cep_destino']) ? $_GET['cep_destino'] : null;
    $latitudeDestino = isset($_GET['latitude_destino']) ? $_GET['latitude_destino'] : null;
    $longitudeDestino = isset($_GET['longitude_destino']) ? $_GET['longitude_destino'] : null;
    $cepOrigem = preg_replace("/[^0-9]/", "", $cepOrigem); // retira qualquer tipo de caracter que não seja número
    $cepDestino = preg_replace("/[^0-9]/", "", $cepDestino); // retira qualquer tipo de caracter que não seja número

    $service = new CalcularDistanciaService();
    // calcula a distancia (em metros) entre os dois ceps
    $m = $service->calcularDistancia(deg2rad($latitudeOrigem), deg2rad($longitudeOrigem), 
    deg2rad($latitudeDestino), deg2rad($longitudeDestino));

    if($m != null) {
        $db = DB::connect(); // inicia a conexão com o banco de dados
        $rs = $db->prepare("INSERT INTO percursos (cep_origem, cep_destino, distancia_total, 
        criado_em, editado_em) VALUES (?, ?, ?, NOW(), NOW())"); // faz um insert na tabela de percursos com os dados obtidos, note que os valores de 'criado_em' e 'alterado_em' estão com valor 'NOW()'
        // no MariaDB, este comando pega o horário do servidor, ou seja, o horário local de onde o servidor está localizado
        $exec = $rs->execute([$cepOrigem, $cepDestino, $m]);

        if($exec) {
            echo json_encode("Dados inseridos"); // retorna um json
        } else {
            echo json_encode("Falha na inserção");
        }
    }
}