<form>
<input type="text" class="comment">Comment</input>
<input type="text" class="post_id">Post_id</input>
<button>Send</button>
</form>
<?php
if (isset($_POST['comment']) && $_POST['post_id']!="") {
    $comment = $_POST['comment'];
    $post_id= $_POST['post_id'];
	$url = "http://localhost/comment/".$comment.$post_id;
	
	$comment = curl_init($url);
	curl_setopt($comment,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($comment);
	
	$result = json_decode($response);
	
	echo "<table>";
    echo $result;
    echo "</table>";
}
    ?>





?>
