<?php
require("onfocus-ini.inc");
require("lib/emoji.php");
ob_start();

$cntPost = 0;
$lastDate = 0;

// Paging
$query = "SELECT Count(post_id), Min(DateCreated), Max(DateCreated) FROM items WHERE hide = 0";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
while ($tp = mysql_fetch_row($result)) {
	$totalposts = $tp[0];
	$mindate = $tp[1];
	$maxdate = $tp[2];
}
$pageNum = 1;
$rowsPerPage = 25;
$totalpages = ceil($totalposts / $rowsPerPage);
if (isset($_GET['page'])) {
	$pageNum = $_GET['page'];
	if (!ctype_digit($pageNum) || $pageNum > $totalpages) {
		send404();
	}
}
$offset = ($pageNum - 1) * $rowsPerPage;
$olderPageNum = ($pageNum + 1);
if ($pageNum > 1) {
	$newerPageNum = ($pageNum - 1);
}
else {
	$newerPageNum = 0;
}

$pageTitle = APP_TITLE . " by Paul Bausch";
$pageDescription = "Thoughts and photos from a Web developer in Corvallis, Oregon.";

$isDateArchive = 0;
$thisArchiveYear = "";
$thisArchiveMonth = "";
if (isset($_GET['year']) && isset($_GET['month'])) {
	$thisArchiveYear = $_GET['year'];
	$thisArchiveMonth = $_GET['month'];
}
if (isset($_GET['xml'])) {
	if (preg_match('@^(\d{4})_(\d{2})_\d{2}_past\.xml@i',$_GET['xml'],$matches)) {
		$thisArchiveYear = $matches[1];
		$thisArchiveMonth = $matches[2];
	}
	else {
		header('Location: http://www.onfocus.com/');
	}
}
if ($thisArchiveYear != "" && $thisArchiveMonth != "") {
	if (checkdate($thisArchiveMonth,1,$thisArchiveYear)) {
		$thisArchiveDate = strtotime("$thisArchiveMonth/1/$thisArchiveYear");
		$thisArchiveDate = strtotime("$thisArchiveMonth/1/$thisArchiveYear");
		$minYear = date("Y",strtotime($mindate));
		$maxYear = date("Y",strtotime($maxdate));
		$minMonth = date("m",strtotime($mindate));
		$maxMonth = date("m",strtotime($maxdate));
		if (($thisArchiveYear >= $minYear) && ($thisArchiveYear <= $maxYear)) {
			if ($thisArchiveYear == $minYear && $thisArchiveMonth < $maxMonth) {
				send404();
			}
			if ($thisArchiveYear == $maxYear && $thisArchiveMonth > $maxMonth) {
				send404();
			}
			$isDateArchive = 1;
			$pagetitle = "Archive: " . date("F Y",$thisArchiveDate) . " | " . APP_TITLE;
		}
		else {
			send404();
		}
	}
	else {
		send404();
	}
}
require("header.php");
if ($isDateArchive) {
	print "<h2 style=\"margin-bottom:18px;\">Archive of Posts from ".date("F Y",$thisArchiveDate)."</h2>";
	$thisArchiveYear = mysql_real_escape_string($thisArchiveYear);
	$thisArchiveMonth = mysql_real_escape_string($thisArchiveMonth);
	$query = "SELECT post_id, DateCreated, title, body, (SELECT count(comment_id) FROM comments WHERE post_id = items.post_id AND hide = 0 AND trackback = 0) AS comment_count, comments_on, item_type_id, url_slug FROM items WHERE Year(DateCreated) = $thisArchiveYear AND Month(DateCreated) = $thisArchiveMonth AND hide = 0 ORDER BY DateCreated DESC";
}
else {
	print "<h2 style=\"margin-bottom:30px;\">&#9670;&nbsp;&nbsp;a weblog by pb&nbsp;&nbsp;&#9670;</h2>";
	$query = "SELECT post_id, DateCreated, title, body, (SELECT count(comment_id) FROM comments WHERE post_id = items.post_id AND hide = 0 AND trackback = 0) AS comment_count, comments_on, item_type_id, url_slug FROM items WHERE hide = 0 ORDER BY DateCreated DESC LIMIT $offset, $rowsPerPage";
}
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	die("<div class=\"post-text\">Couldn't find any posts! WTF?!</div>");
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$cntPost++;
		$slug = $post['url_slug'];
		$title = $post['title'];
		//$title = utf8_encode($title);
		$body = $post['body'];
		$body = preg_replace('/<!-- comment -->/s','',$body);
		$body = emoji_name_to_unified($body);
		$body = emoji_unified_to_html($body);
		//$body = preg_replace('/<embed/s','&lt;embed',$body);
		if (strpos($title,"Links for") !== false) {
			//$body = preg_replace('/<li((.(?<!<li))*?<\/ul>)/s','<li style="margin-bottom:0px;"$1',$body);
		}
		//$body = utf8_encode($body);
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$permalink = "/$thisYear/$thisMonth/$id";
		if ($slug !== '') {
			$permalink .= "/$slug";
		}
		$currentYear = date('Y');
		$commentCount = $post['comment_count'];
		$thisCommentsOn = $post['comments_on'];
		$type = $post['item_type_id'];
		if ($thisYear == $currentYear) {
			$thisDate = date(DATE_HEADER_FORMAT,strtotime($postDateTime));
		}
		else {
			$thisDate = date(DATE_HEADER_YEAR_FORMAT,strtotime($postDateTime));
		}
		$thisTime = date(TIME_FORMAT,strtotime($postDateTime));
		if ($thisDate !== $lastDate) {
			//print "<h2>$thisDate</h2>\n";
		}
		else {
			print "<div class=\"daysep\"></div>";
		}
		print "<div class=\"post";
		if (($type == 5) || ($type == 6) || ($type == 8)) {
			print " photo";
		}
		print "\">\n";
		if ((strpos($title,"Links for") === false) && ($type != 7) && ($type != 5) && ($type != 6) && ($type != 8)) {
			print "<h3>$title</h3>\n";
		}
		print "<div class=\"post-text\"";
		print ">$body</div>\n";
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
		
		print "<div class=\"post-byline\">$thisDate at <a href=\"$permalink\">$thisTime</a>";
		
		if ($commentCount > 0) {
			print " &middot; <a href=\"$permalink#comments\">$commentCount comment";
			if ($commentCount <> 1) {
				print "s";
			}
			print "</a>";
		}
		else if (($thisCommentsOn == 1) && (strtotime($postDateTime) > strtotime("-6 months"))) {
			print " &middot; <a href=\"$permalink#comment\" style=\"text-decoration:underline\">comment</a>";
		}
		print "</div>\n";
		print "</div>\n";
		$lastDate = $thisDate;
	}
}
ob_end_flush();
?>
</div>
<div class="fill" style="margin-bottom:12px;"><div class="triangle-up-right rot90"></div><div class="triangle-up-left rotn90"></div></div>
<?php if (!$isDateArchive) { ?>
<div id="footer">
	<div class="navigation">
		<a href="/page/<?php print $olderPageNum ?>">Older Posts</a>
		<?php if ($pageNum == 2) { ?> 
		    <span class="flourish">&#9670;</span> <a href="/" style="padding-left:10px;">Newer Posts</a>
		<?php } elseif ($pageNum > 1) { ?> 
		    <span class="flourish">&#9670;</span> <a href="/page/<?php print $newerPageNum ?>" style="padding-left:10px;">Newer Posts</a>
		<?php } elseif ($pageNum == 1) { ?> <span class="flourish">&#9670;</span> <a href="/archive/" style="padding-left:10px;">Archive</a><?php } ?>
	</div>
</div>
<?php } else { ?>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a> <span class="flourish">&#9670;</span> <a href="/archive/" style="padding-left:10px;">Archive</a>
	</div>
</div>
<?php } ?>
<?php require("footer.php"); ?>
