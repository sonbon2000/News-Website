<?php
$urlC = "http://localhost/IWS-Final/webservices/api/get_all_category.php";

$category = curl_init($urlC);
curl_setopt($category, CURLOPT_RETURNTRANSFER, true);
$responseC = curl_exec($category);

$resultC = json_decode($responseC, true);

?>

<div class="sidebar-box ftco-animate">
    <div class="categories">
        <h3>Categories</h3>
        <?php foreach ($resultC as $key => $value) : ?>
            <li <?php if ($value['id'] == $id) {echo 'class="active"';} ?>><a href="category.php?id=<?php echo $value['id']; ?>"><?php echo $value['category'] ?><span class="ion-ios-arrow-forward"></span></a></li>
        <?php endforeach; ?>
    </div>
</div>