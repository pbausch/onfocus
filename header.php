<?php require_once('lib/set-includes.php'); ?>
<?php
        require_once(OWA_LOCAL.'owa_env.php');
        require_once(OWA_DIR.'owa_php.php');
        $owa = new owa_php();
        $owa->setSiteId(OWA_ID);
		if (isset($pageTitle)) { $owa->setPageTitle($pageTitle); } else { $owa->setPageTitle('onfocus'); }
        $owa->setPageType(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
		$tag_code = $owa->placeHelperPageTags(false);
        $owa->trackPageView();
?>
<?php $page = $_SERVER["PHP_SELF"]; ?>
<?php
	$logocolor = "fefefd"; //fefefd
	$gradcolor = "222222"; //222222
	$bannercolor = "323131"; //2F3141, 020202
	$basebg = "bbd2c5"; //929EAD, 989898
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
<?php if (($pageNum > 1) || ($isDateArchive) || ($isTagArchive)) { print "\t"; ?><meta name="ROBOTS" content="NOINDEX,FOLLOW"><?php }?>
	<link rel="dns-prefetch" href="https://code.jquery.com/" />
	<link rel="dns-prefetch" href="https://d1x6es5xzge33k.cloudfront.net/" />
	<link rel="dns-prefetch" href="https://umami.onfocus.com/" />
	<link rel="icon" type="image/ico" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.ico?v=<?php print $logocolor ?>" />
	<link rel="apple-touch-icon" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.apple-touch-icon.png">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://xml.onfocus.com/posts" />
	<style>
		#logo, .tagline, .selected, #bottom, #infobox .post-text a, .navigation a {color: #<?php print $logocolor ?> !important;}
		html {
			min-height: 100%;
		}
		/* .btn {
		    background-color: #<?php print $gradcolor ?>;
		    border: 1px solid #<?php print $logocolor ?>;
		    color: #<?php print $logocolor ?>;
		} */
		.flickr-embed-header {
			visibility:hidden;
		}
		iframe[src*=spotify] {
    			max-width: 100%;
		}
		/* #header, #footer { background-color: #<?php print $bannercolor ?> !important; }
		.triangle-up-right:after { border-top-color: #<?php print $bannercolor ?> !important;}
		.triangle-up-left:after { border-left-color: #<?php print $bannercolor ?> !important;} */
        #footer {
            min-height: 46px;
        }
		@media screen and (max-width: 750px) {
			iframe.flickr-embed-frame {
				width: 100vw;
				margin-left: 50%;
				-webkit-transform: translateX(-50%);
				transform: translateX(-50%);
			}
		}
		a[data-fancybox] { cursor: zoom-in; }
	</style>
	<link rel="stylesheet" href="<?php print LIVE_STYLESHEET ?>" />
	<link rel="stylesheet" href="<?php print CDN_URL ?>/css/jquery.fancybox.min.css" />
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
			<a href="/" title="go to the homepage" <?php if (($page == "/index.php") && ($pageNum == 1) && ($isDateArchive == 0)) { ?>class="selected"<?php } ?> id="tophome">Home</a>
			<span id="topflourish" class="flourish">&nbsp;◆&nbsp;</span>
			<a href="/about" title="what is this place?" <?php if ($page == "/about.php") { ?>class="selected"<?php } ?>>About</a>  
		</div>
	</div>
</div>
<div class="fill"><div class="triangle-up-right"></div><div class="triangle-up-left"></div></div>
<div id="blog" class="hfeed<?php if ($page == "/post.php") { echo ' single';} ?>">
