<?php

use Model\CLPP\UserCheckList;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

require('_autoloader.php');
require('../../DAO/CLPP/UserCheckList.php');
require('../../Services/Authentication.php');

if (!Authorization()) {
    return;
}

$method = $_SERVER['REQUEST_METHOD'];
$dao = new DaoUserChecklist();
$body = file_get_contents('php://input');


if ($method === 'OPTIONS') {
    return NULL;
}
  

if ($method === 'GET') {
    if (isset($_GET['id_checklist']) && ($_GET !== NULL)) {
        $resposta = $dao->SelectCheckList($_GET['id_checklist']);
    }
    if (isset($_GET['id_users']) && ($_GET !== NULL)) {
        $resposta = $dao->SelectUser($_GET['id_users']);
    }
    echo json_encode($resposta);
    return;


}



if ($method === 'POST') {
    $jsonBody = json_decode($body, true);

    if (
        !isset($jsonBody['id_user']) && $jsonBody['id_user'] == NULL &&
        !isset($jsonBody['id_checklist']) && $jsonBody['id_checklist'] == NULL

    ) {
    };

    $verifyExist = $dao->SelectAll($jsonBody['id_user'],$jsonBody['id_checklist']);

    if(!$verifyExist["error"]){
        echo json_encode(array("error"=>"true", "message"=>"The user is already linked with the checklist"));
        http_response_code(403);
        return;
    }

    $resposta = new UserCheckList(
        $jsonBody['id_user'],
        $jsonBody['id_checklist']
    );

    echo json_encode($dao->Insert($resposta));
    return;

}


if ($method === 'DELETE') {
    $jsonBody = json_decode($body, true);


    if ((isset($jsonBody["id_user"]) && $jsonBody["id_user"] != NULL) && (isset($jsonBody["id_checklist"]) && $jsonBody["id_checklist"] != NULL)) {
        $resposta = $dao->DeleteUser($jsonBody["id_user"],$jsonBody["id_checklist"]);
        echo json_encode($resposta);
        return;
    }

    if ((isset($jsonBody["id_checklist"]) && $jsonBody["id_checklist"] != NULL)) {
        $resposta = $dao->DeleteCheckList($jsonBody["id_checklist"]);
        echo json_encode($resposta);
        return;
    }
    echo json_encode(array("error" => true, "message" => "(id_user or id_checklist) is broke"));
    http_response_code(400);
    return;
}
