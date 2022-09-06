<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Todo.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate todo object
  $todo = new Todo($db);

  // Blog todo query
  $result = $todo->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any todos
  if($num > 0) {
    // Todo array
    $todos_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $todo_item = array(
        'id' => $id,
        'title' => $title,
        'description' => $description
      );

      // Push to "data"
      array_push($todos_arr, $todo_item);
    }

    // Turn to JSON & output
    echo json_encode($todos_arr);

  } else {
    // No Todos
    echo json_encode(
      array('message' => 'No Todos Found')
    );
  }
