/*************************************************
* Custom PHP Twitter Feed
*
* Version: 1.0
* Author: Ashley Callahan
* Author URI: http://www.ashleycallahan.net/
*************************************************/

/****************************************
 * Instructions for use
 ****************************************/
 
1. Create a Twitter application (https://dev.twitter.com/apps) and make note of the application's consumer key, consumer secret, access token, and access token secret (available in application details).

2. Copy the entire /_php/ directory in this download to a public directory on your web account or server.
	
3. Edit /_php/twitter/feed.php
	
	3.1 Edit the value of the following variables:
		- $twitteruser
		- $notweets
		- $cachepath
		- $consumerkey
		- $consumersecret
		- $accesstoken
		- $accesstokensecret
		- $timezone
		- $dateformat
	
	3.2 Set the value of the $cachetime variable to zero (0).
	
	3.3 Save.
	
4. Open the feed.php file in a web browser (Example: http://YOURURLHERE.com/_php/twitter/feed.php). This should return the initial JSON feed and set the cache.
	
5. Edit /_php/twitter/feed.php
	
	5.1 Set the value of the $cachetime variable to 7200 (or another value of your choosing).
	
	5.2 Save.
	
6. Open index.php. Copy and paste the PHP include from this file into the file where you want the feed to appear. Be sure to update the include path so it points to the file relative to the file you are adding it to or use an absolute path.