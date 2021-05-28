<?php
$id = $_GET['id'];
$url = "http://localhost/IWS-Final/webservices/api/get_all_comment_of_a_news.php?id=$id";

$tag = curl_init($url);
curl_setopt($tag, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($tag);

$result = json_decode($response, true);


?>

<?php
if ($result['message'] != NULL) {
    echo $result['message'];
} else {
    foreach ($result as $key => $value) :
?>
        <li class="comment">
            <div class="vcard bio">
                <img src="images/comment/comment (<?php echo (rand(1, 8)); ?>).jpg" alt="Image placeholder">
            </div>
            <div class="comment-body">
                <h3><?php echo $value['name'] ?></h3>
                <?php foreach ($value['comment'] as $key => $value) : ?>
                    <p class="comment-content" style="word-wrap: break-word;"><?php echo $value?></p>
                <?php endforeach; ?>
            </div>
        </li>
<?php
    endforeach;
} ?>