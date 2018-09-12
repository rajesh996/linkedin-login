<?php

if(isset($_GET['code'])){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://www.linkedin.com/oauth/v2/accessToken");
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=authorization_code&code=".$_GET['code']."&redirect_uri=http://localhost/linlogin/callback.php&client_id=81u7mrr57owu0s&client_secret=tmugSDGAcfnGWdKk");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);
}

if(isset($_GET['code']) && json_decode($server_output)->access_token != ''){

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL,"https://api.linkedin.com/v1/people/~:(id,first-name,last-name,email-address)?oauth2_access_token=".json_decode($server_output)->access_token."&format=json");
     curl_setopt($ch, CURLOPT_POST, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $server_output2 = curl_exec ($ch);
    //  $server_output3 = "https://api.linkedin.com/v1/people/~:(id,first-name,last-name,picture-url,public-profile-url,email-address)?oauth2_access_token=".json_decode($server_output)->access_token."&format=json";
     curl_close ($ch);

     $user_data = json_decode($server_output2);
    //  $user_data = json_decode($server_output3);

     print_r($user_data);

}