<?php
$id = $_GET['id'];
$url = "http://localhost/IWS-Final/webservices/api/get_all_tags_of_a_news.php?id=$id";

$tag = curl_init($url);
curl_setopt($tag, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($tag);

$result = json_decode($response, true);

$news_arr = array();
foreach ($result as $key => $value) :
    $tag_id = $value['id'];
    $urlR = "http://localhost/IWS-Final/webservices/api/read_news_related.php?id=$tag_id";
    $news = curl_init($urlR);
    curl_setopt($news, CURLOPT_RETURNTRANSFER, true);
    $responseR = curl_exec($news);
    $resultR = json_decode($responseR, true);
    $news_arr = array_merge($news_arr, $resultR);
endforeach;
$i = 0;
?>

<div class="sidebar-box ftco-animate">
    <h3>Related News</h3>
    <?php if ($news_arr[1]['id'] == null) {
        echo '<p style="font-size: 90%;"> OOps! No related news found!</p>';
    } else {
        foreach ($news_arr as $key => $value) :
            if ($value['id'] != $id) { ?>
                <div class="block-21 mb-4 d-flex">
                    <a class="blog-img mr-4" style="background-image: url('images/news-pics/<?php echo $value['pic']; ?>.jpg');"></a>
                    <div class="text">
                        <h3 class="heading"><a href='news_single.php?id=<?php echo $value['id']; ?>'><?php echo $value['title']; ?></a></h3>
                        <div class="meta">
                            <?php $date = explode('-', $value['created_date']); ?>
                            <?php
                            $day = $date[2];
                            $mos = date("F", mktime(0, 0, 0, $date[1], 10));
                            $yr = $date[0];
                            ?>
                            <div><a href="#"><span class="icon-calendar"></span><?php echo $mos . '. ' . $day . ', ' . $yr ?></a></div>
                            <div><a href="#"><span class="icon-person"></span><?php echo $value['author'] ?></a></div>
                        </div>
                    </div>
                </div>
    <?php if (++$i == 3) break;
            }
        endforeach;
    } ?>
</div>
