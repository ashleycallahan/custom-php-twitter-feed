/*************************************************
* Custom PHP Twitter Feed
*
* Version: 1.0
* Author: IU Communications
* Author URI: http://communications.iu.edu
*************************************************/

/****************************************
 * Instructions for use
 ****************************************/
 
1. Create a Twitter application (https://dev.twitter.com/apps) and make note of the application's consumer key, consumer secret, access token, and access token secret (available in application details).

2. Copy the entire /_php/ directory in this download to a public directory on your web account or server.

3. Open /_php/twitter/cache.txt

	2.1 Delete all content in this file and save.
	
4. Open /_php/twitter/feed.php
	
	4.1 Edit the value of the following variables:
		- $twitteruser
		- $notweets
		- $cachepath
		- $consumerkey
		- $consumersecret
		- $accesstoken
		- $accesstokensecret
	
	4.2 Set the value of the $cachetime variable to zero (0).
	
	4.3 Save.
	
5. Open the json.php file in a web browser (http://YOURURLHERE.indiana.edu/_php/twitter/json.php). This should return the initial JSON feed and set the cache.
	
6. Open /_php/twitter/feed.php
	
	5.1 Set the value of the $cachetime variable to 7200 (or another value of your choosing).
	
	5.2 Save.
	
7. Open index.php. Copy and paste the PHP include from this file into the file where you want the feed to appear. Be sure to update the include path so it points to the file relative to the file you are adding it to. 