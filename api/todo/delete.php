<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set ID to update
  $todo->id = $data->id;

  // Delete todo
  if($todo->delete()) {
    echo json_encode(
      array('message' => 'Todo Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Todo Not Deleted')
    );
  }

