<?php
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$url = "http://localhost/IWS-Final/webservices/api/get_all_news.php?page=$page";

$news = curl_init($url);
curl_setopt($news, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($news);

$result = json_decode($response, true);
$total_page = $result[0]['total_page'];

?>

<?php foreach ($result as $key => $value) : ?>
    <div class="case">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6 d-flex">
                <a href='news_single.php?id=<?php echo $value['id']; ?>' class="img w-100 mb-3 mb-md-0" style="background-image: url('images/news-pics/<?php echo $value['pic']; ?>.jpg');">
                </a>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 d-flex">
                <div class="text w-100 pl-md-3">
                    <span class="subheading"><?php echo $value['author']; ?> </span>
                    <div class="meta">
                        <?php $date = explode('-', $value['created_date']); ?>
                        <?php
                        $day = $date[2];
                        $mos = date("F", mktime(0, 0, 0, $date[1], 10));
                        $yr = $date[0];
                        ?>

                        <p class="mb-1"><?php echo $mos . ' ' . $day . ', ' . $yr ?></p>
                    </div>
                    <h3 class="heading mb-3"><a href='news_single.php?id=<?php echo $value['id']; ?>'><?php echo $value['title']; ?></a></h3>
                    <p><?php echo $value['short_intro']; ?></p>
                    <p> <a href='news_single.php?id=<?php echo $value['id']; ?>' class="btn-custom"><span class="ion-ios-arrow-round-forward mr-3"></span>Read more</a></p>



                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            <?php
            $range = 5;
            $pagelimit = ($range - 1) / 2;
            $pagemax = $range;
            if ($total_page <= $range) {
                $pagemax = $total_page;
                $pagemin = 1;
            } else {
                if ($page - $pagelimit <= 1) {
                    $pagemin = 1;
                } else {
                    if ($page + $pagelimit <= $total_page) {
                        $pagemin = $page - $pagelimit;
                        $pagemax = $page + $pagelimit;
                    } else {
                        $pagemin = $total_page - $range + 1;
                        $pagemax = $total_page;
                    }
                }
            }
            ?>
            <ul>
                <li class="first-btn"><a href="index.php?page=1" style="border: none; <?php if (($page <= 1) || ($total_page <= $range)) echo 'display: none;' ?>">&lt; &lt;</a></li>
                <li class="prev-btn" <?php if ($page == $pagemin) echo 'style = "display: none;"' ?>><a href="index.php?page=<?php echo ($page - 1); ?>">&lt;</a></li>
                <?php if ($pagemin != 1) {
                    echo '<li><a href=# style="border: none;">. . .</a></li>';
                } ?>
                <?php for ($i = $pagemin; $i <= $pagemax; $i++) { ?>
                    <li <?php if ($page == $i) echo "class='active'"; ?>>
                        <a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <?php if ($pagemax != $total_page) {
                    echo '<li><a href=# style="border: none;">. . .</a></li>';
                } ?>
                <li class="next-btn" <?php if ($page >= $pagemax) echo 'style = "display: none;"' ?>><a href="index.php?page=<?php echo ($page + 1); ?>">&gt;</a></li>
                <li class="last-btn"><a href="index.php?page=<?php echo $total_page; ?>" style="border: none; <?php if (($page >= $total_page) || ($total_page <= $range)) echo 'display: none;' ?>">&gt; &gt;</a></li>
            </ul>
        </div>
    </div>
</div>
