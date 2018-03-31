<?php
require_once('TwitterAPIExchange.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Searching Tweet</title>
<style>
div.container {
    width: 75%;
	margin: 0 auto;
	font-family: Consolas, monospace;
}
</style>
</head>
<body bgcolor="#E6E6FA">
	
	<!-- enter your twitter screen_name here -->
	<form name="MyForm" action="" method="GET">Enter Twitter Screen Name : 
		<input type="text" name="myName"/>
		<input type="submit" />
	</form>

	<?php
	//insert the screen_name into variable $val
	$val = $_GET['myName'];
	?>
	
	<!-- display API respond from Twitter here -->
	<h3>API respond : </h3>
	<?php
	//check if $val containing twitter screen_name
	if (!empty($val))
	{
		//fill with your API Twitter credential 
		$settings = array(
		'oauth_access_token' => "[INPUT_WITH_YOUR_TWITTER_ACCESS_TOKEN]",
		'oauth_access_token_secret' => "[INPUT_WITH_YOUR_TWITTER_ACCESS_TOKEN_SECRET]",
		'consumer_key' => "[INPUT_WITH_YOUR_CONSUMER_KEY]",
		'consumer_secret' => "[INPUT_WITH_YOUR_CONSUMER_SECRET"
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?result_type=recent&count=1&screen_name='.$val;
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
  
	$string = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);
 
		echo "<pre>";
		print_r($string);
		echo "</pre>";
	} else {
		echo "<h3>Please insert the twitter screen_name</h3>";
	}
	?>
</body>
</html>