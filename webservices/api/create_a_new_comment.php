<?php
include_once '../config/Database.php';
include_once '../models/Comment.php';
  
$database = new Database();
$db = $database->connect();
  
$comment = new Comment($db);
$news_id= $_POST['id'];
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->name) &&
    !empty($data->comment)
){
  
    // set comment property values
    $comment->name = $data->name;
    $comment->comment = $data->comment;
    $comment->news_id = $data->news_id;
  
    // create the comment
    if($comment->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Comment was created."));
    }
  
    // if unable to create the comment, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create comment."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create comment. Data is incomplete."));
}
?>