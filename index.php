<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Custom Twitter Feed</title>
<style>
	.twitter-custom-feed {
		list-style: none;
		margin: 0;
		padding: 0;
		width: 50%;	
	}
	.twitter-custom-feed li {
		border-bottom: 1px solid #ccc;
		margin: 0 0 10px 0;
		padding: 0 0 10px 0;	
	}
	.twitter-custom-feed li:last-child {
		border-bottom: none;
		margin-bottom: 0;
		padding-bottom: 0;
	}	
	.twitter-custom-feed li p {
		margin: 0;
		padding: 0;	
	}
	.twitter-custom-feed li a {
		color: #990000;
		text-decoration: none;
	}	
	.twitter-custom-feed li span {
		display: block;	
	}
</style>
</head>
<body>
	<h1>Custom PHP Twitter Feed</h1>
	<?php include("_php/twitter/feed.php"); ?>
</body>
</html>