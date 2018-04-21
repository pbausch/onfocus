<?php require_once('lib/set-includes.php'); ?>
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
<?php if (($pageNum > 1) || ($isDateArchive)) { print "\t"; ?><meta name="ROBOTS" content="NOINDEX,FOLLOW"><?php }?>
	<?php if ($_SERVER['REMOTE_ADDR'] <> HOME_IP) { ?><!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-M6395HJ');</script><!-- End Google Tag Manager --><?php } ?>
	<link rel="icon" type="image/ico" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.ico?v=<?php print $logocolor ?>" />
	<link rel="apple-touch-icon" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.apple-touch-icon.png">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://xml.onfocus.com/posts" />
	<style>
		#logo, .tagline, .selected, #bottom, #infobox .post-text a, .navigation a {color: #<?php print $logocolor ?> !important;}
		html {
			background: #<?php print $basebg ?>;
		    background: radial-gradient(#bbd2c5 0%, #536976 140%);
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
		#header, #footer { background-color: #<?php print $bannercolor ?> !important; }
		.triangle-up-right:after { border-top-color: #<?php print $bannercolor ?> !important;}
		.triangle-up-left:after { border-left-color: #<?php print $bannercolor ?> !important;}
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
	</style>
	<link rel="stylesheet" href="<?php print LIVE_STYLESHEET ?>" />
	<?php if (isset($pageHeaderAddition)) { 
		$pageHeaderAddition = str_replace("200808.twitter-card.png",$logocolor . ".twitter-card.png",$pageHeaderAddition);
		print $pageHeaderAddition; 
	} ?>
<title><?php if (isset($pageTitle)) { print $pageTitle; } else { print "onfocus"; } ?></title>
</head>
<body>
<?php if ($_SERVER['REMOTE_ADDR'] <> HOME_IP) { ?>
<!-- Google Tag Manager (noscript) --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M6395HJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><!-- End Google Tag Manager (noscript) --><?php } ?>
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
<div id="blog" class="hfeed">
