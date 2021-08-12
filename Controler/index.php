<?php

require_once 'dao.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$dao = new Dao();
$body = file_get_contents('php://input');

if ($metodo === 'GET') {
    $resposta = $dao->Select();

    echo json_encode($resposta);
    return;
}

if ($metodo === 'POST') {
    $a = json_decode($body, true);

    $resposta = $dao->Insert($a["ID_option"], $a["descr"], $a["photo"],  $a["TYPEE"], $a["USERR"]);
    var_dump($resposta);

    return;
}

if ($metodo === 'PUT') {
    $a = json_decode($body, true);

    $resposta = $dao->Update($a["ID_option"], $a["descr"], $a["photo"], $a["dataa"], $a["TYPEE"], $a["USERR"]);
    var_dump($resposta);

    return;
}
if ($metodo === 'DELETE') {
    $id = json_decode($body, true);

    $resposta = $dao->Delete($id['ID']);
    var_dump($resposta);

    return;
}
