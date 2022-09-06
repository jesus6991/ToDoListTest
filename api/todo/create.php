<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Todo.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate todo object
  $todo = new Todo($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $todo->title = $data->title;
  $todo->description = $data->description;

  // Create todo
  if($todo->create()) {
    echo json_encode(
      array('message' => 'Todo Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Todo Not Created')
    );
  }

