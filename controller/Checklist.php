<?php

use Model\CLPP\Checklist;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");

require('_autoloader.php');
require('../../DAO/CLPP/Checklist.php');
require('../../Services/Authentication.php');
require('../../Utils/UTF8.php');

if (!Authorization()) {
  return;
}



$daoChecklist = new DaoChecklist();
$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');

if ($method === 'OPTIONS') {
  return NULL;
}

if ($method === 'GET') {


  if (isset($_GET['userId']) && $_GET['userId'] != NULL && isset($_GET['web']) ) {

    $response = $daoChecklist->Select($_GET['userId']);
  
    if ($response['error']) {
      echo json_encode(array("error" => true, "message" => $response['message']));
      http_response_code(403);
      return;
    }
    $data = array("error" => $response['error'], "data" => array());
    
  
    for ($i = 0; $i < count($response["data"]); $i++) {
      
        $checklist = new Checklist(
            $response["data"][$i]->id,
            $response["data"][$i]->description,
            $response["data"][$i]->date_init,
            $response["data"][$i]->date_final,
            $response["data"][$i]->notification,
            $response["data"][$i]->id_user_create
          );
        
          array_push($data["data"], $checklist);
        }
        echo json_encode($data);
        return;
        
    }


  if (isset($_GET['userId']) && $_GET['userId'] != NULL) {

    if (isset($_GET['all'])) {
      $response = $daoChecklist->SelectChecklistAll($_GET['userId']);

      if ($response['error']) {
        echo json_encode(array("error" => true, "message" => $response['message']));
        http_response_code(403);
        return;
      }


      $data = array("error" => $response['error'], "data" => array());

      for ($i = 0; $i < count($response["data"]); $i++) {
        $question = $daoChecklist->SelectQuestion($response["data"][$i]->id);
        
        $checklist = array(
          'id' => $response["data"][$i]->id,
          'description' => utf8ize($response["data"][$i]->description),
          'date_init' => $response["data"][$i]->date_init,
          'date_final' => $response["data"][$i]->date_final,
          'creator_name' => utf8ize($response["data"][$i]->user),
          'count_question' => (int)$question["data"][0]->question
        );
        
        array_push($data["data"], $checklist);
      }
      
       
       echo json_encode($data);
      return;
    }

    $response = $daoChecklist->SelectChecklist($_GET['userId']);

    if ($response['error']) {
      echo json_encode(array("error" => true, "message" => $response['message']));
      http_response_code(403);
      return;
    }

    $data = array("error" => $response['error'], "data" => array());
    
    for ($i = 0; $i < count($response["data"]); $i++) {
      $question = $daoChecklist->SelectQuestion($response["data"][$i]->id);
     
      $checklist = array(
        'id' => $response["data"][$i]->id,
        'description' => utf8ize($response["data"][$i]->description),
        'date_init' => $response["data"][$i]->date_init,
        'date_final' => $response["data"][$i]->date_final,
        'creator_name' => utf8ize($response["data"][$i]->name),
        'count_question' => (int)$question["data"][0]->question
      );

      array_push($data["data"], $checklist);
    }

    echo json_encode($data);
    return;
  }


}

if ($method === 'POST') {
  $jsonBody =  json_decode($body, true);

  if (
    isset($jsonBody['description']) &&
    $jsonBody['description'] != NULL &&
    isset($jsonBody['date_init']) &&
    $jsonBody['date_init'] != NULL &&
    isset($jsonBody['date_final']) &&
    $jsonBody['date_final'] != NULL &&
    isset($jsonBody['notification']) &&
    $jsonBody['notification'] != NULL &&
    isset($jsonBody['id_creator']) &&
    $jsonBody['id_creator'] != NULL
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
    isset($jsonBody['description']) &&
    $jsonBody['description'] != NULL &&
    isset($jsonBody['notification']) &&
    $jsonBody['notification'] != NULL &&
    isset($jsonBody['id_creator']) &&
    $jsonBody['id_creator'] != NULL
  ) {

    $checklist = new Checklist(
      NULL,
      $jsonBody['description'],
      NULL,
      NULL,
      $jsonBody['notification'],
      $jsonBody['id_creator']
    );

    echo json_encode($daoChecklist->Insert($checklist));
    return;
  }

  echo json_encode(array("error" => true, "message" => "(notification,description, id_creator) is broken"));
  http_response_code(400);
  return;
}

if ($method === 'PUT') {
  $jsonBody =  json_decode($body, true);

  // var_dump($jsonBody);
  if (
    !isset($jsonBody['id']) || $jsonBody['id'] === NULL ||
    !isset($jsonBody['description']) || $jsonBody['description'] === NULL ||
    !isset($jsonBody['notification']) || $jsonBody['notification'] === NULL
  ) {
    echo json_encode(array("error" => true, "message" => "(id, description, notification) is broken"));
    http_response_code(400);
    return;
  }
  $checklist = new Checklist(
    $jsonBody['id'],
    $jsonBody['description'],
    $jsonBody['date_init'],
    $jsonBody['date_final'],
    $jsonBody['notification'],
    $jsonBody['id_creator']
  );

  echo json_encode($daoChecklist->Update($checklist));
  return;
}


if ($method === 'DELETE') {
  $jsonBody = json_decode($body, true);

  if ((!isset($jsonBody['id']))) {
    echo json_encode(array("error" => true, "message" => "(id) is broken"));
    http_response_code(400);
    return;
  }
  
  echo json_encode($daoChecklist->Delete($jsonBody['id']));
  return;
}

echo json_encode(array("error" => true, "message" => "This method is not allowed"));
http_response_code(405);
