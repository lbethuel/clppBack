<?php

require_once 'dao.php';
require_once '../Model/CLPP.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$dao = new Dao();
$body = file_get_contents('php://input');



if ($metodo === 'GET') {
    $resposta = $dao->Select();

    echo json_encode($resposta);
    return;
}

if ($metodo === 'POST') {
    $jsonBody = json_decode($body, true);
    
    if (
        isset($jsonBody['ID_option']) && $jsonBody['ID_option'] != NULL &&
        isset($jsonBody['descr']) && $jsonBody['descr'] != NULL &&
        isset($jsonBody['TYPEE']) && $jsonBody['TYPEE'] != NULL &&
        isset($jsonBody['USERR']) && $jsonBody['USERR'] != NULL
        ) {
            // echo json_encode(array("error" => true, "message" => "(notification) is broken"));
            // http_response_code(400);
            // return;

        $resposta = new Checklist(
            $jsonBody['ID_option'],
            $jsonBody['descr'],
            NULL,
            $jsonBody['TYPEE'],
            $jsonBody['USERR']
        );

        echo json_encode($dao->Insert($resposta));
        return;
    }





    //$resposta = $dao->Insert($a["ID_option"], $a["descr"], $a["photo"],  $a["TYPEE"], $a["USERR"]);
    //var_dump($resposta);

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


/* if ($method === 'POST') {
    $jsonBody =  json_decode($body, true);

    if (
        isset($jsonBody['description']) && $jsonBody['description'] != NULL &&
        isset($jsonBody['date_init']) && $jsonBody['date_init'] != NULL &&
        isset($jsonBody['date_final']) && $jsonBody['date_final'] != NULL &&
        isset($jsonBody['notification']) && $jsonBody['notification'] != NULL &&
        isset($jsonBody['id_creator']) && $jsonBody['id_creator'] != NULL
    ) {
        // echo json_encode(array("error" => true, "message" => "(notification) is broken"));
        // http_response_code(400);
        // return;

        $checklist = new Checklist(
            NULL,
            $jsonBody['description'],
            $jsonBody['date_init'],
            $jsonBody['date_final'],
            $jsonBody['notification'],
            $jsonBody['id_creator']
        );

        echo json_encode($daoChecklist->Insert($checklist));
        return;
    }

    if (
        isset($jsonBody['description']) && $jsonBody['description'] != NULL &&
        isset($jsonBody['notification']) && $jsonBody['notification'] != NULL &&
        isset($jsonBody['id_creator']) && $jsonBody['id_creator'] != NULL
    ) {

        $checklist = new Checklist(
            NULL,
            $jsonBody['description'],
            NULL,
            NULL,
            $jsonBody['notification'],
            $jsonBody['id_creator']
        );

        // var_dump($jsonBody['id_creator']);
        echo json_encode($daoChecklist->Insert($checklist));
        return;
    }

    echo json_encode(array("error" => true, "message" => "(notification,description, id_creator) is broken"));
    http_response_code(400);
    return;
}
 */