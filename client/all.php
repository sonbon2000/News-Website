<?php

	$url = "http://localhost/a2/comment";
	
	$comment = curl_init($url);
	curl_setopt($comment,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($comment);
	
	$result = json_decode($response);
	
	echo "<table>";
    print_r ($result);
    echo $result[0]['id'];
    echo "</table>";
?>
