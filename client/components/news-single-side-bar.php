<?php
$urlC = "http://localhost/IWS-Final/webservices/api/get_all_category.php";

$category = curl_init($urlC);
curl_setopt($category, CURLOPT_RETURNTRANSFER, true);
$responseC = curl_exec($category);

$resultC = json_decode($responseC, true);

$urlT = "http://localhost/IWS-Final/webservices/api/get_all_tags.php";

$tag = curl_init($urlT);
curl_setopt($tag, CURLOPT_RETURNTRANSFER, true);
$responseT = curl_exec($tag);

$resultT = json_decode($responseT, true);
?>

<div class="sidebar-box ftco-animate">
    <div class="categories">
        <h3>Categories</h3>
        <?php foreach ($resultC as $key => $value) : ?>
            <li><a href="category.php?id=<?php echo $value['id']; ?>"><?php echo $value['category'] ?><span class="ion-ios-arrow-forward"></span></a></li>
        <?php endforeach; ?>
    </div>
</div>

<div class="sidebar-box ftco-animate">
    <h3>Tag Cloud</h3>
    <div class="tagcloud">
        <?php 
        foreach ($resultT as $key => $value) : ?>
            <a href="tag.php?id=<?php echo $value['id']; ?>" class="tag-cloud-link"><?php echo $value['content'] ?></a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('components/related_news.php') ?>
