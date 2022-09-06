<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Done.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate done object
  $done = new Done($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $done->title = $data->title;
  $done->description = $data->description;

  // Create done
  if($done->create()) {
    echo json_encode(
      array('message' => 'Done Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Done Not Created')
    );
  }

