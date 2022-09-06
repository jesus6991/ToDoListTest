<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Done.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate done object
  $done = new Done($db);

  // Blog done query
  $result = $done->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any dones
  if($num > 0) {
    // Done array
    $dones_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $done_item = array(
        'id' => $id,
        'title' => $title,
        'description' => $description
      );

      // Push to "data"
      array_push($dones_arr, $done_item);
    }

    // Turn to JSON & output
    echo json_encode($dones_arr);

  } else {
    // No Dones
    echo json_encode(
      array('message' => 'No Dones Found')
    );
  }
