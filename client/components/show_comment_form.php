<?php
$id = $_GET['id'];
$url = "http://localhost/IWS-Final/webservices/api/get_a_news.php?id=$id";

$news = curl_init($url);
curl_setopt($news, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($news);

$result = json_decode($response, true);

?>
 <div class="comment-form-wrap pt-5">
              <h3 class="mb-5">Leave a comment</h3>
              <form action="components/create_comment.php" class="p-5 bg-light" method="POST">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="comment" id="message" cols="30" rows="10" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                <input type="hidden" name="news_id" value="<?php echo $id ?>" />
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                </div>
              </form>
            </div>
          </div>