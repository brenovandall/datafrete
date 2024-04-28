<?php
// Configuração do CORS para aceitar requisições de qualquer origem e qualquer header
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

date_default_timezone_set("America/Sao_Paulo"); // define timezone para horário de Sao Paulo (timezone de Blumenau)

// Configuração do Laragon -- >
if (isset($_GET['path'])) {
    $path = explode("/", $_GET['path']);
} else { 
    echo "Caminho não existe"; exit;
}

if (isset($path[0])) { $api = $path[0]; } else { echo "Caminho não existe"; exit; }
if (isset($path[1])) { $action = $path[1]; } else { $action = ''; }
if (isset($path[2])) { $param = $path[2]; } else { $param = ''; }

$method = $_SERVER['REQUEST_METHOD'];

include_once "classes/db.class.php";
include_once "services/cepAbertoService.php";
include_once "services/calcularDistanciaService.php";
include_once "api/percursos/percursos.php";