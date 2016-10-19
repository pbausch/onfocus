<?php
require("onfocus-ini.inc");
include('lib/emoji.php');
include('lib/site-functions.php');
$query = "SELECT post_id, DateCreated, title, body, comments_on, item_type_id, url_slug, tags FROM items WHERE hide = 0 AND post_id = ". mysql_real_escape_string($_GET['id']);
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	send404();
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$title = $post['title'];
		//$title = utf8_encode($title);
		$body = $post['body'];
		$body = preg_replace('/<!-- comment -->/s','',$body);
		$body = emoji_name_to_unified($body);
		$body = emoji_unified_to_html($body);
		$summary = $body;
		$summary = preg_replace("/<style\\b[^>]*>(.*?)<\\/style>/s", "", $summary);
		$imageUrls = array();
		$images = preg_match_all('!//[a-z0-9\-\.\/]+\.(?:jpe?g|png|gif)!Ui' , $summary , $imageUrls);
		$summary = strip_tags($summary);
		$summary = preg_replace("/\s+/", " ", $summary);
		$summary = truncate_to_x_words($summary, 45);
		if ($summary == "") {
			$summary = $title;
		}
		$pageTitle = $title;
		if ($pageTitle == "") {
			$pageTitle = $body;
			$pageTitle = preg_replace('/<[a-zA-Z\/][^>]*>/is','',$pageTitle);
			$pageTitle = preg_replace('/(.{1,20}[ \.,\?\)!]).*/is','\1',$pageTitle);
			$pageTitle = trim($pageTitle)."...";
		}
		$tags = $post['tags'];
		if ($tags != "") {
			$pageKeywords = preg_replace('#\s+#',', ',trim($tags));
		}
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$permalink = "/$thisYear/$thisMonth/$id";
		$currentYear = date('Y');
		if ($thisYear == $currentYear) {
			$thisDate = date("M jS",strtotime($postDateTime));
		}
		else {
			$thisDate = date("M jS, Y",strtotime($postDateTime));
		}
		$thisTime = date(TIME_FORMAT,strtotime($postDateTime));
		$thisAmpDate = date("Y-m-d\\TH:i:sP",strtotime($postDateTime));
		$lastDate = $thisDate;
		$thisCommentsOn = $post['comments_on'];
		$type = $post['item_type_id'];
		$slug = $post['url_slug'];
		if ($slug !== '') {
			// If we don't have a matching slug, redirect to canonical
			//if ($slug !== $_GET['s']) {
			//	header("HTTP/1.1 301 Moved Permanently"); 
			//	header("Location: https://www.onfocus.com$permalink/$slug");
			//}
			$canonicalUrl = "https://www.onfocus.com$permalink/$slug";
		}
		else {
			$canonicalUrl = "https://www.onfocus.com$permalink";
		}
	}
}
$pageNum = 1;
$isDateArchive = 0;
$cntPost = 1;
$pageTitle = $pageTitle . " | onfocus";
$pageHeaderAddition = "<link rel=\"canonical\" href=\"$canonicalUrl\" />\n";
$firstImageUrl = "";
if ($images > 0) {
	$firstImageUrl = $imageUrls[0][0];
	if (substr($firstImageUrl,0,2) == "//") {
		$firstImageUrl = "https:" . $firstImageUrl;
	}
}
else {
	// no local image so look for youtube
	$dom = new DOMDocument;
	try {
		$dom->loadHTML($body);
		foreach ($dom->getElementsByTagName('iframe') as $node) {
			if ($node->hasAttribute('data-src')) {
		    	$url = $node->getAttribute('data-src');
				$urlHost = parse_url($url, PHP_URL_HOST);
				if (strpos($urlHost, 'youtu') !== false) {
					$urlPath = parse_url($url,PHP_URL_PATH);
					$ytid = str_replace("/embed/","",$urlPath);
					$firstImageUrl = "https://i.ytimg.com/vi/$ytid/hqdefault.jpg";
				}
			}
		}
	}
	catch (Exception $e) {
		// log eventually to catch bad HTML in posts
	}
	if ($firstImageUrl == "") {
		$firstImageUrl = "https://d1x6es5xzge33k.cloudfront.net/200808.twitter-card.png";
	}
}

$dom = new DOMDocument;
try {
	$dom->loadHTML($body,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
	foreach ($dom->getElementsByTagName('iframe') as $node) {
		$ytid = "";
		if ($node->hasAttribute('data-src')) {
	    	$url = $node->getAttribute('data-src');
			$urlHost = parse_url($url, PHP_URL_HOST);
			if (strpos($urlHost, 'youtu') !== false) {
				$urlPath = parse_url($url,PHP_URL_PATH);
				$ytid = str_replace("/embed/","",$urlPath);
				$nodeYT = $dom->createElement("amp-youtube", "");
				$nodeYT->setAttribute("data-videoid", $ytid);
				$nodeYT->setAttribute("layout", "responsive");
				$nodeYT->setAttribute("width", "640");
				$nodeYT->setAttribute("height", "320");
				$node->parentNode->replaceChild($nodeYT, $node);
			}
		}
	}
	$body = $dom->saveHTML();
}
catch (Exception $e) {
	// log eventually to catch bad HTML in posts
}
// Change post HTML for amp
$body = str_replace("<img","<amp-img layout=\"responsive\" ",$body);
$body = str_replace("border=\"0\"","",$body);
$body = preg_replace("/style=\"[^\"]*\"/i","",$body);


// Change css for amp
$css = file_get_contents('./css/amp.css', true);
$css = str_replace("!important","",$css);
?>
<!doctype html>
<html amp lang="en">
  <head>
    <meta charset="utf-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <title><?php print $pageTitle ?></title>
    <link rel="canonical" href="<?php print $canonicalUrl ?>" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <script type="application/ld+json">
	  {
		  "@context": "http://schema.org",
		  "@type": "BlogPosting",
		  "headline": <?php print json_encode($title) ?>,
		  "image": {
		    "@type": "ImageObject",
		    "url": "<?php print $firstImageUrl ?>",
		    "height": 640,
		    "width": 320
		  },
		  "datePublished": "<?php print $thisAmpDate ?>",
		  "author": {
		    "@type": "Person",
		    "name": "Paul Bausch"
		  },
		   "publisher": {
		    "@type": "Organization",
		    "name": "onfocus",
		    "logo": {
		      "@type": "ImageObject",
		      "url": "https://d1x6es5xzge33k.cloudfront.net/onfocus-amp-logo.png",
		      "width": 244,
		      "height": 60
		    }
		  },
		  "description": <?php print json_encode($summary) ?>		
	  }
    </script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<style amp-custom>
	<?php print $css ?>
	</style>
  </head>
  <body>
	<div id="header">
		<h1 id="logo">onfocus</h1>
		<p class="tagline">a weblog by pb</p>
		<div id="infobox">
			<div class="post-text">
				<a href="/" id="tophome">Home</a>
				<a href="/about">About</a>  
				<a href="/archive">Archive</a> 
			</div>
		</div>
	</div>
	<div id="blog">
<?php
if ((strpos($title,"Links for") === false) && ($type != 7) && ($type != 5) && ($type != 6) && ($type != 8)) {
	print "<h2 class=\"archive-title\">$title</h2>\n";
}
?>
<?php 
print "<div class=\"post archive";
if (($type == 5) || ($type == 6) || ($type == 8)) {
	print " photo";
}
print "\">";
print "<div class=\"post-text\"";
print ">$body</div>";
if (($type == 5) || ($type == 6) || ($type == 8)) {
	print "<div class=\"photo-title\">";
	if (strpos($title,"instagram photo") === false) {
		print $title;
	}
	else {
		print "Untitled";
	}
	print "</div>";
}
print "<div class=\"post-byline archive\">$thisDate at $thisTime</div>";
?>
</div>
<?php
// BEGIN COMMENTS
$query = "SELECT author, url, date, comment, comment_id FROM comments WHERE hide = 0 AND trackback = 0 AND post_id = " . $id . " ORDER BY date ASC";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) > 0) {
	print "<a name=\"comments\"></a><h2 class=\"archive-title comments-title\">Comments</h2><div class=\"post archive\">";
	while ($comment = mysql_fetch_array($result)) {
		$comment_id = $comment['comment_id'];
		$body = $comment['comment'];
		$body = trim($body);
		$body = nl2br($body);
		$pattern = '{(
		  \\b
		  # Match the leading part (proto://hostname, or just hostname)
		  (
		    #  //, or https:// leading part
		    (https?)://[-\\w]+(\\.\\w[-\\w]*)+
		  |
		    # or, try to find a hostname with more specific sub-expression
		    (?i: [a-z0-9] (?:[-a-z0-9]*[a-z0-9])? \\. )+ # sub domains
		    # Now ending .com, etc. For these, require lowercase
		    (?-i: com\\b
		        | edu\\b
		        | biz\\b
		        | gov\\b
		        | in(?:t|fo)\\b # .int or .info
		        | mil\\b
		        | net\\b
		        | org\\b
		        | [a-z][a-z]\\.[a-z][a-z]\\b # two-letter country code
		    )
		  )

		  # Allow an optional port number
		  ( : \\d+ )?

		  # The rest of the URL is optional, and begins with /
		  (
		    /
		    # The rest are heuristics for what seems to work well
		    [^.!,?;"\\\'<>()\[\]\{\}\s\x7F-\\xFF]*
		    (
		      [.!,?]+ [^.!,?;"\\\'<>()\\[\\]\{\\}\s\\x7F-\\xFF]+
		    )*
		  )?
		)}ix';
		if ($comment_id > 2616) {$body = preg_replace($pattern, '<a href="$1">$1</a>', $body);}
		$body = emoji_name_to_unified($body);
		$body = emoji_unified_to_html($body);
		$author = $comment['author'];
		$url = $comment['url'];
		$commentDateTime = $comment['date'];
		$thisYear = date('Y',strtotime($commentDateTime));
		$currentYear = date('Y');
		if (((substr($url,0,7) == "http://") || (substr($url,0,8) == "https://"))) {
			$author = "<a href=\"$url\" rel=\"nofollow\">$author</a>";
		}
		else {
			$author = "<span class=\"comment-author\">$author</span>";
		}
		if ($thisYear == $currentYear) {
			$thisDate = date(DATE_HEADER_FORMAT,strtotime($commentDateTime));
		}
		else {
			$thisDate = date(DATE_HEADER_YEAR_FORMAT,strtotime($commentDateTime));
		}
		$thisTime = date(TIME_FORMAT,strtotime($commentDateTime));		
		print "<div class=\"comment\" id=\"c$comment_id\">";
		print "<div class=\"post-text\">$body</div>";
		print "<div class=\"post-byline comment-byline\">by $author on $thisDate at $thisTime</div>";
		print "</div>";
	}
	print "</div>";
}
// BEGIN COMMENT FORM 
// ------------ comments must be enabled, and then only for six months ------------
if (($thisCommentsOn == 1) && (strtotime($postDateTime) > strtotime("-6 months"))) {
	// Set session token
	$thisToken = md5(uniqid(rand(), TRUE));
	$_SESSION['token'] = $thisToken;
	$thisName = "";
	$thisURL = "";
	if (isset($_COOKIE["name"])) {
		$thisName = $_COOKIE["name"];
	}
	if (isset($_COOKIE["url"])) {
		$thisURL = $_COOKIE["url"];
	}
	print "<a name=\"add-comment\"></a><h2 class=\"archive-title\">Add a Comment</h2><div class=\"post archive\">";
?>
<div class="post-text" id="jsmsg">Please visit the <a href="<?php print $canonicalUrl ?>#comment">standard page</a> to add a comment.</div>
<?php
}
else {
	$thisToken = '';
}
// END COMMENT FORM
?>
</div>
</div>
<?php
// OLDER POST LINK
$query = "SELECT post_id, DateCreated, url_slug FROM items WHERE hide = 0 AND post_id < ". mysql_real_escape_string($_GET['id']) . " ORDER BY post_id DESC LIMIT 1";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	$olderPermalink = "";
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$slug = $post['url_slug'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$olderPermalink = "/$thisYear/$thisMonth/$id";
		if ($slug !== '') {
			$olderPermalink .= "/$slug";
		}
	}
}

// NEWER POST LINK
$query = "SELECT post_id, DateCreated, url_slug FROM items WHERE hide = 0 AND post_id > ". mysql_real_escape_string($_GET['id']) . " LIMIT 1";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	$newerPermalink = "";
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$slug = $post['url_slug'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$newerPermalink = "/$thisYear/$thisMonth/$id";
		if ($slug !== '') {
			$newerPermalink .= "/$slug";
		}
	}
}
?>
<div id="footer">
	<div class="navigation">
		<?php if ($olderPermalink <> "") { ?><a href="<?php print $olderPermalink ?>">Previous</a> <span class="flourish">&otimes;</span><?php } ?>
		<a href="/" class="footHome">Home</a>
		<?php if ($newerPermalink <> "") { ?> <span class="flourish">&otimes;</span> <a href="<?php print $newerPermalink ?>" class="footHome">Next</a> <?php } ?>
	</div>
</div>
<amp-analytics type="googleanalytics" id="analytics1">
<script type="application/json">
{
  "vars": {
    "account": "UA-76008-1"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>
</body>
</html>