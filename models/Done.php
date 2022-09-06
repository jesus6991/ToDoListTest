<?php 
  class Done {
    // DB stuff
    private $conn;
    private $table = 'dones';

    // Done Properties
    public $id;
    public $title;
    public $description;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Dones
    public function read() {
      // Create query
      $query = 'SELECT t.id, t.title, t.description, t.created_at
                                FROM ' . $this->table . ' t
                                ORDER BY
                                  t.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Done
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, description = :description';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->description = htmlspecialchars(strip_tags($this->description));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':description', $this->description);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete Done
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }