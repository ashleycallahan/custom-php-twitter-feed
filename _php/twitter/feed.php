<?php

	// ================= EDIT THE VARIABLES BELOW ===================== //
	
	// Twitter username
	$twitteruser = "indianauniv";
		
	// Number of Tweets to display
	$notweets = 15;

	// Length of time between renewing the cache file in seconds (2 hours in this case)
	$cachetime = 0;
	
	// Server path to parent folder
	$cachepath = "/ip/iuwebdev/www/arc2/social-media/twitter/_php/twitter/cache.txt";
	
	// CREATE A TWITTER APPLICATION TO GET THE FOLLOWING VARIABLES (https://dev.twitter.com/apps)
	
	  // OAtuh settings - Consumer Key
	  $consumerkey = "R7JSdJ9B9FikfCjXpNVGQ";
	
	  // OAtuh settings - Consumer Secret
	  $consumersecret = "JdEyvHjGkUucCfulRg2GjIiC48YN7DV8f9ctJUHKowA";
	
	  // OAtuh settings - Access Token
	  $accesstoken = "14810987-YHv3H56FCgYqUuSlOBInMWaQfxrRmRGgE4B63YWES";
	
	  // OAtuh settings - Access Token Secret
	  $accesstokensecret = "6WSkGC2G24MFrRD7KaQzTexJ7pJ4vWQLMejlsB4bhM";
	
	// Default timezone (Reference: http://www.php.net/manual/en/timezones.php)
	$timezone = "America/Indiana/Indianapolis";
	
	// Date format (Reference: http://php.net/manual/en/function.date.php) 
	$dateformat = "l, F, j, g:ia";
	

	// ================= STOP EDITING! ===================== //
	
    if(file_exists($cachepath) && time() < filemtime($cachepath) + $cachetime){
		$json = file_get_contents($cachepath,0,null,null);
		$json_output = json_decode($json, true);
	}
	else {
		require_once("twitteroauth/twitteroauth.php"); // Path to twitteroauth library relative to this file
		session_start();
		function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret){
			$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
			return $connection;
		}
		$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
		$json = json_encode($tweets);
		$json_output = json_decode($json, true);
		$fp = fopen($cachepath, 'w');
		fwrite($fp, $json);
		fclose($fp);
	}
	$tweets = $json_output;
	echo "<ul class='twitter-custom-feed'>";
	foreach($tweets as $tweet){
		if(strstr($tweet[text],"RT")){
			$tweet_text = "RT <a href='https://twitter.com/".$tweet[retweeted_status][user][screen_name]."' target='_blank'>".$tweet[retweeted_status][user][screen_name]."</a>: ".$tweet[retweeted_status][text];
		}
		else {
			$tweet_text = $tweet[text];
		}
		$tweet_words = explode(" ",$tweet_text);
		$tweet_text_clean = "";
		foreach($tweet_words as $tweet_word){
			if(strstr($tweet_word,"@")){
				$tweet_word_clean = str_replace("@","",$tweet_word);
				if(strstr($tweet_word_clean,".")){
					$tweet_word_clean = str_replace(".","",$tweet_word_clean);
				}
				if(strstr($tweet_word_clean,";")){
					$tweet_word_clean = str_replace(";","",$tweet_word_clean);
				}
				if(strstr($tweet_word_clean,",")){
					$tweet_word_clean = str_replace(",","",$tweet_word_clean);
				}
				$tweet_word = "<a href='https://www.twitter.com/".$tweet_word_clean."' target='_blank'>".$tweet_word."</a>";
				if(strstr($tweet_word_clean,".")){
					echo ".";
				}
				if(strstr($tweet_word_clean,";")){
					echo ";";
				}
				if(strstr($tweet_word_clean,",")){
					echo ",";
				}
			}
			if(strstr($tweet_word,"#")){
				$tweet_word_clean = str_replace("#","",$tweet_word);
				$tweet_word = "<a href='https://twitter.com/search?q=%23".$tweet_word_clean."' target='_blank'>".$tweet_word."</a>";	
			}
			if(strstr($tweet_word,"http:")){
				$tweet_word = "<a href='".$tweet_word."' target='_blank'>".$tweet_word."</a>";
			}
			$tweet_text_clean .= $tweet_word." ";
		}
		echo "<li>";
		echo "<span class='twitter-custom-feed-tweet'>".$tweet_text_clean."</span><br />";
		date_default_timezone_set($timezone);
		echo "<span class='twitter-custom-feed-date'>".date($dateformat,strtotime($tweet[created_at]))."</span><br />";
		echo "<span class='twitter-custom-feed-interact'>";
		echo "<a href='https://twitter.com/intent/tweet?in_reply_to=".$tweet[id_str]."' target='_blank' class='twitter-custom-feed-reply'>Reply</a> &#149; ";
		echo "<a href='http://twitter.com/intent/retweet?tweet_id=".$tweet[id_str]."' target='_blank' class='twitter-custom-feed-retweet'>Retweet</a> &#149; ";
		echo "<a href='http://twitter.com/intent/favorite?tweet_id=".$tweet[id_str]."' target='_blank' class='twitter-custom-feed-favorite'>Favorite</a>";
		echo "</span>";
		echo "</li>";
	}
	echo "</ul>";
	
?>