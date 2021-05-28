<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/News.php';

  $page= 1;
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $news = new News($db);

  // Blog post query
  $resultA = $news->read_all();
  // Get row count
  $num = $resultA->rowCount();
  $limit=5;
  $total_page=ceil($num/$limit);
  		//xem trang có vượt giới hạn không:
  if(isset($_GET["page"])) $page=$_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
		if($page<1) $page=1; //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
		if($page>$total_page) $page=$total_page;//nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng
 
		//tính start (vị trí bản ghi sẽ bắt đầu lấy):
		$start=($page-1)*$limit;
		

     // Blog post query
  $result = $news->read_page($start,$limit);
  // Get row count
  $num = $result->rowCount();


  // Check if any posts
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      
      $post_item = array(
        'id' => $id,
        'title' => $title,
        'content' => html_entity_decode($content),
        'created_date' => html_entity_decode($created_date),
        'pic' => html_entity_decode($pic),
        'author' => html_entity_decode($author),
        'cat_id' => html_entity_decode($cat_id),       
        'short_intro' => html_entity_decode($short_intro),
        'total_page'=>$total_page
       
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
      array('message' => 'No News Found')
    
    );
  }
