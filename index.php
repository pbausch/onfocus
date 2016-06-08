<?php
require("onfocus-ini.inc");
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

$pagetitle = APP_TITLE . " by Paul Bausch";

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
	$query = "SELECT post_id, DateCreated, title, body, (SELECT count(comment_id) FROM comments WHERE post_id = items.post_id AND hide = 0 AND trackback = 0) AS comment_count, comments_on, item_type_id FROM items WHERE Year(DateCreated) = $thisArchiveYear AND Month(DateCreated) = $thisArchiveMonth AND hide = 0 ORDER BY DateCreated DESC";
}
else {
	$query = "SELECT post_id, DateCreated, title, body, (SELECT count(comment_id) FROM comments WHERE post_id = items.post_id AND hide = 0 AND trackback = 0) AS comment_count, comments_on, item_type_id FROM items WHERE hide = 0 ORDER BY DateCreated DESC LIMIT $offset, $rowsPerPage";
}
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	die("<div class=\"post-text\">Couldn't find any posts! WTF?!</div>");
} 
else {
	while ($post = mysql_fetch_array($result)) {
		$cntPost++;
		$title = $post['title'];
		//$title = utf8_encode($title);
		$body = $post['body'];
		$body = preg_replace('/<!-- comment -->/s','',$body);
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
			print "<h2>$thisDate</h2>\n";
		}
		else {
			print "<div class=\"daysep\"></div>";
		}
		print "<div class=\"post\">\n";
		if ((strpos($title,"Links for") === false) && ($type != 7)) {
			print "<h3>$title</h3>\n";
		}
		print "<div class=\"post-text\"";
		if ($type == 7) {
			print " style=\"margin-top:15px\"";
		}
		print ">$body</div>\n";
		if (($id < 4653) && (strpos($title,"Links for") !== false)) {
			print "<div class=\"post-byline delicio\">gathered from delicious at <a href=\"$permalink\">$thisTime</a>";
		} 
		else if (strpos($title,"Links for") !== false) {
			print "<div class=\"post-byline pinboard\">gathered from pinboard at <a href=\"$permalink\">$thisTime</a>";
		}
		else if ($type == 5) {
			$changeDate = strtotime('2016-05-10 00:00');
			if (strtotime($postDateTime) < $changeDate) {
				print "<div class=\"post-byline instagram\">posted to instagram at <a href=\"$permalink\">$thisTime</a>";
			}
			else {
				print "<div class=\"post-byline instagram2\">posted to instagram at <a href=\"$permalink\">$thisTime</a>";
			}
		}
		else if ($type == 6) {
			print "<div class=\"post-byline flickr\">posted to flickr at <a href=\"$permalink\">$thisTime</a>";
		}
		else if ($type == 7) {
			//print "<div class=\"post-byline twitter\">posted to twitter at <a href=\"$permalink\">$thisTime</a>";
			print "<div class\"post-byline\">";
		}
		else {
			print "<div class=\"post-byline\">posted at <a href=\"$permalink\">$thisTime</a>";
		}
		if ($commentCount > 0) {
			print " &middot; <a href=\"$permalink#comments\">$commentCount comment";
			if ($commentCount <> 1) {
				print "s";
			}
			print "</a>";
		}
		else if (($thisCommentsOn == 1) && (strtotime($postDateTime) > strtotime("-6 months"))) {
			print " &middot; <a href=\"$permalink#add-comment\" style=\"text-decoration:underline\">comment</a>";
		}
		print "</div>\n";
		print "</div>\n";
		$lastDate = $thisDate;
	}
}
ob_end_flush();
?>
</div>
<?php if (!$isDateArchive) { ?>
<div id="footer">
	<div class="navigation">
		&#9664; <a href="/page/<?php print $olderPageNum ?>">Older Posts</a>
		<?php if ($pageNum == 2) { ?> 
			&nbsp;<span style="color:#777;">&middot;</span>&nbsp; <a href="/">Newer Posts</a> &#9654;
		<?php } elseif ($pageNum > 1) { ?> 
			&nbsp;<span style="color:#777;">&middot;</span>&nbsp; <a href="/page/<?php print $newerPageNum ?>">Newer Posts</a> &#9654;
		<?php } elseif ($pageNum == 1) { ?> <span style="color:#777;">&middot;</span> <a href="/archive/">Archive</a><?php } ?>
	</div>
</div>
<?php } else { ?>
<div id="footer">
	<div class="navigation">
		<a href="/archive/">Archive</a>
	</div>
</div>
<?php } ?>
<?php require("footer.php"); ?>
