<?php
require("onfocus-ini.inc");

$query = "SELECT post_id, DateCreated, title, body, comments_on, item_type_id FROM items WHERE hide = 0 AND post_id = ". mysql_real_escape_string($_GET['id']);
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
		//if (preg_match('/^Links for/is',$title)) {
		//	$body = preg_replace('/<li((.(?<!<li))*?<\/ul>)/s','<li style="margin-bottom:0px;"$1',$body);
		//}
		//$body = utf8_encode($body);
		$pagetitle = $title;
		if ($pagetitle == "") {
			$pagetitle = $body;
			$pagetitle = preg_replace('/<[a-zA-Z\/][^>]*>/is','',$pagetitle);
			$pagetitle = preg_replace('/(.{1,20}[ \.,\?\)!]).*/is','\1',$pagetitle);
			$pagetitle = trim($pagetitle)."...";
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
	}
}
$pageNum = 1;
$isDateArchive = 0;
$cntPost = 1;
$pagetitle = $pagetitle . " | onfocus";
require("header.php");
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
	print "<a name=\"comments\"></a><h2 class=\"archive-title\" style=\"margin-bottom:10px;\">Comments</h2>";
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
		$author = $comment['author'];
		$url = $comment['url'];
		$commentDateTime = $comment['date'];
		$thisYear = date('Y',strtotime($commentDateTime));
		$currentYear = date('Y');
		if (substr($url,0,7) == " //") {
			$author = "<a href=\"$url\" rel=\"nofollow\">$author</a>";
		}
		else {
			$author = "<span style=\"font-weight:bold;color:#444;\">$author</span>";
		}
		if ($thisYear == $currentYear) {
			$thisDate = date(DATE_HEADER_FORMAT,strtotime($commentDateTime));
		}
		else {
			$thisDate = date(DATE_HEADER_YEAR_FORMAT,strtotime($commentDateTime));
		}
		$thisTime = date(TIME_FORMAT,strtotime($commentDateTime));		
		print "<div class=\"post\" style=\"margin-bottom:2.5em\">";
		print "<div class=\"post-text\">$body</div>";
		print "<div class=\"post-byline comment\" style=\"margin-top:4px;\">by $author on $thisDate at $thisTime</div>";
		print "</div>";
	}
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
	print "<a name=\"add-comment\"></a><h3 style=\"margin-left:22px;\">Add Comments</h3>";
?>
<div class="post-text" style="border:solid #ddd 1px;color:#111;background-color:#eee;padding:10px;margin:10px 0px 10px 10px;" id="jsmsg">JavaScript is required to comment. Please make sure you're not blocking JavaScript in your browser settings or extensions.</div>
<script type="text/javascript">var msg=document.getElementById("jsmsg");msg.style.display='none';</script>
<form action="/post-comment.php" method="post" onsubmit="return submitForm(this);" style="display:none;" id="cform">
<table style="margin-left:42px;">
		<tr><td align="right" valign="top"><span class="post-byline">comment &nbsp;</span></td><td><textarea cols="40" rows="8" name="comment" style="width:400px;height:200px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="comment"></textarea></td></tr>
		<tr><td></td><td align="left"><div class="post-byline" style="border:solid #ddd 1px;color:#111;background-color:#eee;padding:10px;margin:10px 0px 10px 0px;"><b>Please Note:</b> HTML will be removed from comments.</div></td></tr>
		<tr><td align="right" valign="middle"><span class="post-byline">name &nbsp;</span></td><td align="left"><input name="name" type="text" size="50" maxlength="25" value="<?php print $thisName ?>" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="name"/></td></tr>
		<tr><td align="right" valign="middle"><span class="post-byline">url &nbsp;</span></td><td align="left"><input name="url" type="text" size="50" maxlength="100" value="<?php print $thisURL ?>" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" id="url" type="url"/></td></tr>
		<tr><td></td><td align="left"><input style="margin-top:10px;" type="submit" value="comment" id="submit"/></td></tr>
</table>
<input type="hidden" name="postid" value="<?php print $id ?>" id="postid"/>
<input type="hidden" name="token" value="<?php print md5(uniqid(rand(), TRUE)) ?>" id="token"/>
</form>
<script type="text/javascript">var f=document.getElementById("cform");f.style.display='block';</script>
<?php
}
else {
	$thisToken = '';
}
// END COMMENT FORM
?>
</div>
<?php
// OLDER POST LINK
$query = "SELECT post_id, DateCreated FROM items WHERE hide = 0 AND post_id < ". mysql_real_escape_string($_GET['id']) . " ORDER BY post_id DESC LIMIT 1";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	$olderPermalink = "";
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$olderPermalink = "/$thisYear/$thisMonth/$id";
	}
}

// NEWER POST LINK
$query = "SELECT post_id, DateCreated FROM items WHERE hide = 0 AND post_id > ". mysql_real_escape_string($_GET['id']) . " LIMIT 1";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	$newerPermalink = "";
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$newerPermalink = "/$thisYear/$thisMonth/$id";
	}
}
?>
<div id="footer">
	<div class="navigation">
		<?php if ($olderPermalink <> "") { ?><a href="<?php print $olderPermalink ?>">Previous</a> <span class="flourish">&otimes;</span><?php } ?>
		<a href="/" style="padding-left:10px;">Home</a>
		<?php if ($newerPermalink <> "") { ?> <span class="flourish">&otimes;</span> <a href="<?php print $newerPermalink ?>" style="padding-left:10px;">Next</a> <?php } ?>
	</div>
</div>
<?php require("footer.php"); ?>