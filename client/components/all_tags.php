<?php
$url = "http://localhost/IWS-Final/webservices/api/get_all_tags.php";

$tag = curl_init($url);
curl_setopt($tag, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($tag);

$result = json_decode($response, true);

?>


<div class="sidebar-box ftco-animate">
    <h3>Tag Cloud</h3>
    <div class="tagcloud">
        <?php 
        foreach ($result as $key => $value) : ?>
            <a href="tag.php?id=<?php echo $value['id']; ?>" class="tag-cloud-link" <?php if ($value['id'] == $id) {echo 'style="border: 1px solid #000;"';} ?>><?php echo $value['content'] ?></a>
        <?php endforeach; ?>
    </div>
</div>