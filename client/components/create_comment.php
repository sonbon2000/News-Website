<?php
  $data = array('name' => $_POST['name'], 'comment' => $_POST['comment'], 'news_id' => $_POST['news_id']);
  $data_string = json_encode($data);
  $news_id= $_POST['news_id'];
    $curl = curl_init('http://localhost/IWS-Final/webservices/api/create_a_new_comment.php');
    
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );
    
    $response = curl_exec($curl);
    echo $data_string, $response;
    curl_close($curl);
    header("Location: http://localhost/IWS-Final/client/news_single.php?id={$news_id}");
    ?>