<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set ID to update
  $done->id = $data->id;

  // Delete done
  if($done->delete()) {
    echo json_encode(
      array('message' => 'Done Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Done Not Deleted')
    );
  }

