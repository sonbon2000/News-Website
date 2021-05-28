<?php
class News
{
  // DB stuff
  private $conn;
  private $table = 'news';

  // Post Properties
  public $id;
  public $title;
  public $short_intro;
  public $created_date;
  public $pic;
  public $author;
  public $content;
  public $cat_id;
  public $tag_id;

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

  public function read_page($start, $limit)
  {
    // Create query
    $query = "SELECT * FROM " . $this->table . " ORDER BY
    created_date DESC LIMIT " . $start .
      ', ' . $limit;

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }
  //Get all news of a category
  // Get Posts
  public function read_all_news_cat($id)
  {
    // Create query
    $query = "SELECT `news`.`id`,`news`.`title`, `news`.`short_intro`, `news`.`author`,`news`.`created_date`,`news`.`pic`
              FROM news
              LEFT JOIN category
              ON news.cat_id = category.id
              WHERE cat_id= " . $id . ";";

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }

  public function read_all_news_cat_page($id, $start, $limit)
  {
    // Create query
    $query = "SELECT `news`.`id`,`news`.`title`, `news`.`short_intro`, `news`.`author`,`news`.`created_date`,`news`.`pic` 
              FROM news 
              LEFT JOIN category 
              ON news.cat_id = category.id 
              WHERE cat_id = $id 
              ORDER BY created_date 
              DESC LIMIT " . $start . ', ' . $limit;

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }



  public function read_all_news_by_tag($id)
  {
    $query = "SELECT *
              FROM news
              LEFT JOIN tagnews
              ON news.id = tagnews.news_id
              WHERE tag_id= " . $id . ";";

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }

  public function read_all_news_tag_page($id, $start, $limit)
  {
    // Create query
    $query = "SELECT * FROM news 
              LEFT JOIN tagnews
              ON news.id = tagnews.news_id 
              WHERE tag_id = $id 
              ORDER BY created_date 
              DESC LIMIT " . $start . ', ' . $limit;

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }


  // Get Single Post
  public function read_single()
  {
    // Create query
    $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';  // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->id = $row['id'];
    $this->title = $row['title'];
    $this->content = $row['content'];
    $this->short_intro = $row['short_intro'];
    $this->created_date = $row['created_date'];
    $this->pic = $row['pic'];
    $this->author = $row['author'];
    $this->cat_id = $row['cat_id'];
  }
  public function read_news_related($id)
  {
    // Create query
    $query = "SELECT `news`.`id`,`news`.`title`,`news`.`author`,`news`.`created_date`,`news`.`pic` FROM `news` 
              LEFT JOIN `tagnews` ON `news`.`id` = `tagnews`.`news_id` 
              RIGHT JOIN `tag` ON `tag`.`id` = `tagnews`.`tag_id`
              WHERE `tag`.`id`=".$id;

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();

    return $stmt;
  }
}
