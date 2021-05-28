<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/News.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$news = new News($db);

// Get ID
$news->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post
$news->read_single();

$content_array = explode(PHP_EOL, $news->content);
// print_r($content_array);

// Create array
$post_arr = array(
  'id' => $news->id,
  'title' => html_entity_decode($news->title),
  'content' => $content_array,
  'created_date' => html_entity_decode($news->created_date),
  'pic' => html_entity_decode($news->pic),
  'author' => html_entity_decode($news->author),
  'cat_id' => html_entity_decode($news->cat_id),
  'short_intro' => html_entity_decode($news->short_intro)

);

// Make JSON
print_r(json_encode($post_arr));

   
