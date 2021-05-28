<?php
class Category
{
  // DB stuff
  private $conn;
  private $table = 'category';

  // Post Properties
  public $id;
  public $category;
  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get Posts
  public function read_all()
  {
    // Create query
    $query = "SELECT * FROM " . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }

}
