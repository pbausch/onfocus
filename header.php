<?php require_once('lib/set-includes.php'); ?>
<?php $page = $_SERVER["PHP_SELF"]; ?>
<?php
	$logocolor = "fefefd";
	$gradcolor = "222";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="ICBM" content="44.564400,-123.260910" />
	<meta name="DC.title" content="<?php if (isset($pageTitle)) { print htmlspecialchars($pageTitle); } else { print "onfocus"; } ?>" />
	<meta name="keywords" content="<?php if (isset($pageKeywords)) { print htmlspecialchars($pageKeywords); } else { print "pb, Oregon, Corvallis, developer, photography"; } ?>" />
	<meta name="geo.country" content="US" />
	<meta name="dc.language" content="en" />
<?php if (isset($pageDescription)) { print "\t<meta name=\"description\" content=\"" . htmlspecialchars($pageDescription) . "\" />\n"; } ?>
	<meta name="verify-v1" content="l6Cjq8kY0ofKv+8EY2FMrKOUTC8ztnB/GzIhrMJW/Cs=" />
	<meta name="viewport" content="initial-scale=1" />
<?php if (($pageNum > 1) || ($isDateArchive)) { print "\t"; ?><meta name="ROBOTS" content="NOINDEX,FOLLOW"><?php }?>
	<link rel="icon" type="image/ico" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.ico?v=<?php print $logocolor ?>" />
	<link rel="apple-touch-icon" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.apple-touch-icon.png">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://xml.onfocus.com/posts" />
	<style>
		#logo, .tagline, .selected, #bottom, #infobox .post-text a, .navigation a {color: #<?php print $logocolor ?> !important;}
		html {
			background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898; 
			min-height: 100%;
		}
		.btn {
		    background-color: #<?php print $gradcolor ?>;
		    border: 1px solid #<?php print $logocolor ?>;
		    color: #<?php print $logocolor ?>;
		}
		.flickr-embed-header {
			visibility:hidden;
		}
        #footer {
            min-height: 46px;
        }
        h2 {
            text-align: center;
        }
		@media screen and (max-width: 750px) {
			iframe.flickr-embed-frame {
				width: 100vw;
				margin-left: 50%;
				-webkit-transform: translateX(-50%);
				transform: translateX(-50%);
			}
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Catamaran:600|Merriweather+Sans:300" rel="stylesheet">
	<link rel="stylesheet" href="<?php print LIVE_STYLESHEET ?>" />
	<?php if (isset($pageHeaderAddition)) { 
		$pageHeaderAddition = str_replace("200808.twitter-card.png",$logocolor . ".twitter-card.png",$pageHeaderAddition);
		print $pageHeaderAddition; 
	} ?>
<title><?php if (isset($pageTitle)) { print $pageTitle; } else { print "onfocus"; } ?></title>
</head>
<body>
<div id="header" onclick="document.location='/';">
	<h1 id="logo">onfocus</h1>
	<div id="infobox">
		<div class="post-text">
			<a href="/" <?php if (($page == "/index.php") && ($pageNum == 1) && ($isDateArchive == 0)) { ?>class="selected"<?php } ?> id="tophome">Home</a>
			<a href="/about" <?php if ($page == "/about.php") { ?>class="selected"<?php } ?>>About</a>  
		</div>
	</div>
</div>
<div class="fill"><div class="triangle-up-right"></div><div class="triangle-up-left"></div></div>
<div id="blog">