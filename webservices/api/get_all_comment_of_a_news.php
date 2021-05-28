<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Comment.php';

  $id= $_GET['id'];
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect(); 

  // Instantiate blog post object
  $comments = new Comment($db);

  // Blog post query
  $result = $comments->read_all_comments_new($id);
  // Get row count
  $num = $result->rowCount();
  // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $comment_arr = explode(PHP_EOL, $comment);
      
      $post_item = array(
        'id' => $id,
        'name' => $name,
        'comment' => $comment_arr,
        'news_id' => html_entity_decode($news_id)
      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Comments Found')
    
    );
  }