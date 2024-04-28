<?php

// se nenhuma action é definida, ou seja, algo depois de percursos/, é retornado um json de erro
if($action == '') { echo json_encode(['ERRO' => 'Caminho não encontrado']); }

// este método faz uma listagem simples de todos os percursos registrados na tabela 'percursos'
if($action == 'listar') {
    $db = DB::connect(); // inicia a conexão com o banco de dados
    $rs = $db->prepare("SELECT * FROM percursos ORDER BY id"); // faz uma query simples ordenada pelo id
    $rs->execute();
    $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

    if($obj) {
        echo json_encode(["result" => $obj]); // retorna as colunas, se houver registros
    } else {
        echo json_encode(["result" => null]);
    }
}   

// este método faz uma consulta de um único percurso, mas não foi utilizado neste projeto
if($action == 'listar' && $param !== '') {
    $db = DB::connect();
    $rs = $db->prepare("SELECT * FROM percursos WHERE id = {$param}");
    $rs->execute();
    $obj = $rs->fetchAll();

    if($obj) {
        echo json_encode(["result" => $obj]);
    } else {
        echo json_encode(["result" => null]);
    }
}   


// este método faz a validação se o cep de fato existe
if($action == 'validar' && $param !== '') {
    $cep = isset($param) ? $param : null;
    $cep = preg_replace("/[^0-9]/", "", $param); // retira qualquer tipo de caracter que não seja número

    $service = new CepAbertoService();

    $data = $service->verificaCepExistente($cep); // faz a requisição para a API CEP Aberto
    
    if ($data != null) {
        echo json_encode($data); // retorna os dados da API CEP Aberto, a latitude e longitude ficará em campos hidden no front end para serem enviados no método adicionar
    } else {
        echo "CEP não encontrado";
    }
}