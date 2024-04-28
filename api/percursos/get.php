<?php

if($action == '') { echo json_encode(['ERRO' => 'Caminho não encontrado']); }

if($api == 'listar') {
    if($method == "GET") {
        if($action == 'listar') {
            $db = DB::connect();
            $rs = $db->prepare("SELECT * FROM percursos ORDER BY id");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

            if($obj) {
                echo json_encode(["result" => $obj]);
            } else {
                echo json_encode(["result" => null]);
            }
        }   
    }
}

if($api == 'listar') {
    if($method == "GET") {
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
    }
}