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
$rowsPerPage = 12;
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
	print "<h2 class=\"subtitle\">Archive of Posts from ".date("F Y",$thisArchiveDate)."</h2>";
	$thisArchiveYear = mysql_real_escape_string($thisArchiveYear);
	$thisArchiveMonth = mysql_real_escape_string($thisArchiveMonth);
	$query = "SELECT post_id, DateCreated, title, body, (SELECT count(comment_id) FROM comments WHERE post_id = items.post_id AND hide = 0 AND trackback = 0) AS comment_count, comments_on, item_type_id, url_slug FROM items WHERE Year(DateCreated) = $thisArchiveYear AND Month(DateCreated) = $thisArchiveMonth AND hide = 0 ORDER BY DateCreated DESC";
}
else {
	if ($pageNum == 1) {
	// welcome message for the homepage
?>

<div class="welcome other"><div class="post-text">
	Welcome to onfocus&mdash;a weblog by <a href="https://www.onfocus.com/about">Paul Bausch</a> where I post recommended links, my photos, and occasional thoughts. <span class="nomobile"><a href="http://xml.onfocus.com/posts">Subscribe here</a> if you like RSS.</span>
</div></div>

<?php
	}
	//print "<h2><span class=\"dmd\">&#9670;</span>&nbsp;&nbsp;a weblog by pb&nbsp;&nbsp;<span class=\"dmd\">&#9670;</span></h2>";
	$query = "SELECT post_id, DateCreated, title, body, (SELECT count(comment_id) FROM comments WHERE post_id = items.post_id AND hide = 0 AND trackback = 0) AS comment_count, comments_on, item_type_id, url_slug FROM items WHERE hide = 0 ORDER BY DateCreated DESC LIMIT $offset, $rowsPerPage";
}
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) == 0) {
	die("<div class=\"post-text entry-content\">Something went wrong! We'll be back soon.</div>");
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
		// if this is a photo post, add fancybox
		$vert = 0;
		if ($post['item_type_id'] == 8) {
			$dom = new DOMDocument;
			$dom->loadHTML($body, LIBXML_HTML_NODEFDTD);
			$images = $dom->getElementsByTagName('img');
			foreach ($images as $image) {
				$src = $image->getAttribute('src');
				$src = str_replace('.jpg','_o.jpg',$src);
				$img_width = $image->getAttribute('width');
				$img_height = $image->getAttribute('height');
				if ($img_height > $img_width) {
					$vert = 1;
				}
				$modal = $dom->createElement('a');
		        $modal->setAttribute('data-fancybox',$slug);
				$modal->setAttribute('href', $src);
				$modal->setAttribute('style','cursor:zoom-in');
				$image->parentNode->replaceChild($modal, $image);
				$image->setAttribute('style','display:block');
				$modal->appendChild($image);
			}
			$html = $dom->saveHTML();
			$body = substr($html, 12, -15); //remove added html/body tags
		}
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$postDate8601 = date(DATE_ISO8601, strtotime($postDateTime));
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
		$thisDate = str_replace("st","<sup>st</sup>",$thisDate);
		$thisDate = str_replace("th","<sup>th</sup>",$thisDate);
		$thisDate = str_replace("nd","<sup>nd</sup>",$thisDate);
		$thisDate = str_replace("rd","<sup>rd</sup>",$thisDate);
		$thisTime = date(TIME_FORMAT,strtotime($postDateTime));
		$thisTime = preg_replace('/\s(\S*)$/', '&nbsp;$1', $thisTime);
		$notitle = 1;
		if ($thisDate !== $lastDate) {
			//print "<h2>$thisDate</h2>\n";
		}
		else {
			//print "<div class=\"daysep\"></div>";
		}
		print "<article class=\"post hentry";
		if (($type == 5) || ($type == 6) || ($type == 8)) {
			print " photo";
			if ($vert == 1) {
				print " vert";
			}
		}
		else {
			print " other";
		}
		print "\">\n";
		if ((strpos($title,"Links for") === false) && ($type != 7) && ($type != 5) && ($type != 6) && ($type != 8) && ($type != 9)) {
			print "<h3 class=\"title entry-title\">$title</h3>\n";
			$notitle = 0;
		}
		print "<div class=\"post-text entry-content";
		if ($notitle == 1) {
			print " notitle";
		}
		print "\"";
		print ">$body</div>\n";
		if (($type == 5) || ($type == 6) || ($type == 8)) {
			print "<div class=\"photo-title entry-title\">";
			if (strpos($title,"instagram photo") === false) {
				print $title;
			}
			else {
				print "Untitled";
			}
			print "</div>";
		}
		
		print "<div class=\"post-byline\">";
		if ($thisYear > 2017) {
			if ($type == 1) {
				print "Thoughts &middot; ";
			}
			if ($type == 9) {
				print "Recommended &middot; ";
			}
			if (($type == 5) || ($type == 6) || ($type == 8)) {
				print "Photos &middot; ";
			}
		}
		print "<span class=\"updated\" datetime=\"$postDate8601\">$thisDate, <a href=\"$permalink\">$thisTime</a></span>";
		
		if ($commentCount > 0) {
			print " &middot; <a href=\"$permalink#comments\">$commentCount&nbsp;comment";
			if ($commentCount <> 1) {
				print "s";
			}
			print "</a>";
		}
		else if (($thisCommentsOn == 1) && (strtotime($postDateTime) > strtotime("-6 months"))) {
			print " &middot; <a href=\"$permalink#comment\" style=\"text-decoration:underline\">comment</a>";
		}
		print "</div>\n";
		print "<div class=\"vcard\" style=\"display:none;\"><span class=\"fn\">Paul Bausch</span></div>\n";
		print "</article>\n";
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
		<span class="flourish">&#9670;</span>&nbsp;&nbsp;<a href="/page/<?php print $olderPageNum ?>" class="pulse" style="padding-right:0;">More Posts</a>&nbsp;&nbsp;<span class="flourish">&#9670;</span>
		<?php if ($pageNum == 2) { ?> 
		    <!-- <span class="flourish">&#9670;</span> <a href="/" style="padding-left:10px;">Home</a> -->
		<?php } elseif ($pageNum > 1) { ?> 
		    <!-- <span class="flourish">&#9670;</span> <a href="/" style="padding-left:10px;">Home</a> -->
		<?php } elseif ($pageNum == 1) { ?><!-- <span class="flourish">&#9670;</span> <a href="/archive/" style="padding-left:10px;">Archive</a> --><?php } ?>
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
