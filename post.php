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
		if (strpos($body,"<img")) {
			$images = preg_match_all('!//[a-z0-9\-\.\/]+\.(?:jpe?g|png|gif)!Ui' , $summary , $imageUrls);
		}
		else {
			$images = 0;
		}
		$summary = strip_tags($summary);
		$summary = preg_replace("/\s+/", " ", $summary);
		$summary = trim(truncate_to_x_words($summary, 45));
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
		$lastDate = $thisDate;
		$thisCommentsOn = $post['comments_on'];
		$type = $post['item_type_id'];
		$slug = $post['url_slug'];
		if ($slug !== '') {
			// If we don't have a matching slug, redirect to canonical
			if ($slug !== $_GET['s']) {
				header("HTTP/1.1 301 Moved Permanently"); 
				header("Location: https://www.onfocus.com$permalink/$slug");
			}
			$canonicalUrl = "https://www.onfocus.com$permalink/$slug";
		}
		else {
			$canonicalUrl = "https://www.onfocus.com$permalink";
		}
	}
}

// Set a token for comments and hearts
$thisToken = md5(uniqid(rand(), TRUE));
$_SESSION['token'] = $thisToken;

$pageNum = 1;
$isDateArchive = 0;
$cntPost = 1;
$pageTitle = $pageTitle . " | onfocus";
$pageHeaderAddition = "<link rel=\"canonical\" href=\"$canonicalUrl\" />\n";
$pageHeaderAddition .= "\t<link rel=\"amphtml\" href=\"${canonicalUrl}/amp\" />\n";
$firstImageUrl = "";
$twitterType = "summary_large_image";
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
}

if (($firstImageUrl == "https://www.gif") || ($firstImageUrl == "")) {
	$twitterType = "summary";
	$firstImageUrl = "https://d1x6es5xzge33k.cloudfront.net/200808.twitter-card.png";
}


// use smaller youtube images for facebook (8Mb max)
$firstImageUrlFb = str_replace("hqdefault","mqdefault",$firstImageUrl);

$pageHeaderAddition .= <<<END
	<meta property="og:title" content="onfocus: $title" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="$canonicalUrl" />
	<meta property="og:site_name" content="onfocus"/>
	<meta property="og:description" content="$summary" />
	<meta property="og:image" content="$firstImageUrlFb" />
	<meta name="twitter:card" content="$twitterType" />
	<meta name="twitter:site" content="@pbausch" />
	<meta name="twitter:title" content="$title" />
	<meta name="twitter:description" content="$summary" />
	<meta name="twitter:image" content="$firstImageUrl" />\n\t
END;
if (strpos($body, 'new SWFObject') !== false) {
    $pageHeaderAddition .= "<script type=\"text/javascript\" src=\"https://d1x6es5xzge33k.cloudfront.net/js/swfobject.js\"></script>\n";
}
$pageHeaderAddition .= "<script>var pid = ${id};</script>\n";
$pageFooterAddition = <<<END
<div class="wdt-emoji-popup">
    <a href="#" class="wdt-emoji-popup-mobile-closer"> &times; </a>
	<div class="wdt-emoji-menu-content">
		<div id="wdt-emoji-menu-header">
            <a class="wdt-emoji-tab active" data-group-name="Recent"></a>
            <a class="wdt-emoji-tab" data-group-name="People"></a>
            <a class="wdt-emoji-tab" data-group-name="Nature"></a>
            <a class="wdt-emoji-tab" data-group-name="Foods"></a>
            <a class="wdt-emoji-tab" data-group-name="Activity"></a>
            <a class="wdt-emoji-tab" data-group-name="Places"></a>
            <a class="wdt-emoji-tab" data-group-name="Objects"></a>
            <a class="wdt-emoji-tab" data-group-name="Symbols"></a>
            <a class="wdt-emoji-tab" data-group-name="Flags"></a>
            <a class="wdt-emoji-tab" data-group-name="Custom"></a>
        </div>
		<div class="wdt-emoji-scroll-wrapper">
            <div id="wdt-emoji-menu-items">
                <input id="wdt-emoji-search" type="text" placeholder="Search">
                <h3 id="wdt-emoji-search-result-title">Search Results</h3>
                <div class="wdt-emoji-sections"></div>
                <div id="wdt-emoji-no-result">No emoji found</div>
            </div>
        </div>
		<div id="wdt-emoji-footer">
            <div id="wdt-emoji-preview">
                <span id="wdt-emoji-preview-img"></span>
                <div id="wdt-emoji-preview-text">
                    <span id="wdt-emoji-preview-name"></span><br>
                    <span id="wdt-emoji-preview-aliases"></span>
                </div>
            </div>

            <div id="wdt-emoji-preview-bundle">
                <span>Emoji Picker</span>
            </div>
		</div>
	</div>
</div>
<script src="https://d1x6es5xzge33k.cloudfront.net/js/emoji2.min.js"></script>
<script src="https://d1x6es5xzge33k.cloudfront.net/js/wdt-emoji-bundle.min.js"></script>
<script>
(function() {

  wdtEmojiBundle.defaults.emojiSheets = {
    'apple': 'https://d1x6es5xzge33k.cloudfront.net/css/emoji.png',
  };
  wdtEmojiBundle.defaults.allow_native = false;
  wdtEmojiBundle.init('.wdt-emoji-bundle-enabled');
})();
</script>
END;
require("header.php");
if ((strpos($title,"Links for") === false) && ($type != 7) && ($type != 5) && ($type != 6) && ($type != 8)) {
	print "<h2 class=\"archive-title\">$title</h2>\n";
}
?>
<?php 
print "<div class=\"post archive single";
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
require("lib/heart.php");
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
	$thisName = "";
	$thisURL = "";
	if (isset($_COOKIE["name"])) {
		$thisName = $_COOKIE["name"];
	}
	if (isset($_COOKIE["url"])) {
		$thisURL = $_COOKIE["url"];
	}
	$commentFieldName = crypt('comment'.$thisToken,MD5_SALT);
	$nameFieldName = crypt('name'.$thisToken,MD5_SALT);
	$urlFieldName = crypt('url'.$thisToken,MD5_SALT);
	$postFieldName = crypt('postid'.$thisToken,MD5_SALT);
	$randomFieldName = crypt('random'.$thisToken,MD5_SALT);
	$randomValue = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
	print "<a name=\"add-comment\"></a><h2 class=\"archive-title\" style=\"margin-bottom:20px;\">Add a Comment</h2><div class=\"post archive\">";
?>
<div class="post-text" id="jsmsg">If you want to comment you'll need JavaScript on. According to our records you have disabled JavaScript in your browser settings or with an extension.</div>
<script type="text/javascript">var msg=document.getElementById("jsmsg");msg.style.display='none';</script>
<form action="https://www.onfocus.com/add-comment.php" method="post" onsubmit="return submitForm(this);" style="display:none;" id="cform">
<div class="formRow commentHere">
	<label class="post-byline" for="<?php print $commentFieldName ?>">comment</label>
	<div class="formElement">
		<textarea cols="40" rows="8" name="<?php print $commentFieldName ?>" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="<?php print $commentFieldName ?>" aria-required="true" class="wdt-emoji-bundle-enabled"></textarea>
	</div>
</div>

<div class="please-note post-byline"><b>FYI:</b> HTML won't work. Markdown won't work. Emoji? <span class="emoji-outer emoji-sizer"><span class="emoji-inner emoji1f44c"></span></span></div>

<div class="formRow">	
	<label class="form-label post-byline" for="<?php print $nameFieldName ?>">name</label>
	<div class="formElement">
		<input name="<?php print $nameFieldName ?>" type="text" size="50" maxlength="25" value="<?php print $thisName ?>" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="<?php print $nameFieldName ?>" aria-required="true">
	</div>
</div>
<div class="formRow">
	<label class="post-byline" for="<?php print $urlFieldName ?>">url</label>
	<div class="formElement">
		<input name="<?php print $urlFieldName ?>" type="text" size="50" maxlength="100" value="<?php print $thisURL ?>" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="<?php print $urlFieldName ?>" type="url" placeholder="https://"></td></tr>
	</div>
</div>
<div class="formRow">
	<label class="post-byline" for="<?php print $randomFieldName ?>">email</label>
	<div class="formElement">
		<input name="<?php print $randomFieldName ?>" type="text" size="50" maxlength="100" value="<?php print $randomValue ?>" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="<?php print $randomFieldName ?>" type="email" placeholder="email"></td></tr>
	</div>
</div>
<div class="formRow">
	<div class="formElement">
		<input class="btn" type="submit" value="add comment" id="submit"/>
	</div>
</div>
<input type="hidden" name="<?php print $postFieldName ?>" value="<?php print $id ?>" id="postid"/>
<input type="hidden" name="token" value="<?php print $thisToken ?>" id="token"/>
</form>
<script type="text/javascript">var v = document.getElementById("<?php print $randomFieldName ?>");v.value = 'reset';var r = document.getElementsByClassName('formRow')[3];r.style.display = 'none';var f = document.getElementById("cform");f.style.display='block';</script>
<?php
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
<div class="fill" style="margin-bottom:12px;"><div class="triangle-up-right rot90"></div><div class="triangle-up-left rotn90"></div></div>
<div id="footer">
	<div class="navigation">
		<?php if ($olderPermalink <> "") { ?><a href="<?php print $olderPermalink ?>">Previous</a> <span class="flourish">&#9670;</span><?php } ?>
		<a href="/" style="padding-left:10px;">Home</a>
		<?php if ($newerPermalink <> "") { ?> <span class="flourish">&#9670;</span> <a href="<?php print $newerPermalink ?>" style="padding-left:10px;">Next</a> <?php } ?>
	</div>
</div>
<?php require("footer.php"); ?>