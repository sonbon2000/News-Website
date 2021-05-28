<?php
class Comment
{
  // DB stuff
  private $conn;
  private $table = 'comment';

  // Post Properties
  public $id;
  public $comment;
  public $news_id;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }
  public function read_all_comments_new($id)
  {
    // Create query
    $query = "SELECT *
  FROM comment
  LEFT JOIN news
  ON comment.news_id = news.id
  WHERE news_id= " . $id . ";";

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }
  public function create()
  {
    // query to insert record
    $query = "INSERT INTO
              " . $this->table . "
          SET
             name=:name, comment=:comment, news_id=:news_id";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->news_id = htmlspecialchars(strip_tags($this->news_id));
    $this->comment = htmlspecialchars(strip_tags($this->comment));
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":news_id", $this->news_id);
    $stmt->bindParam(":comment", $this->comment);
    // execute query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
?>