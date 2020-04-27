<?php header("Content-Type: application/rss+xml"); ?>
<?xml version="1.0"?>
<?php
require("onfocus-ini.inc");
require("lib/emoji.php");
ob_start();

$cntPost = 0;
$lastDate = 0;

// Paging
$query = "SELECT Count(post_id) FROM items";
if (!$result = mysqli_query ($connection, $query))
   	logError();
while ($tp = mysqli_fetch_row($result)) {
	$totalposts = $tp[0];
}
$pageNum = 1;
$rowsPerPage = 12;
$totalpages = ceil($totalposts / $rowsPerPage);
if (isset($_GET['page'])) {
	$pageNum = $_GET['page'];
	if (!ctype_digit($pageNum) || $pageNum > $totalpages) {
		$pageNum = 1;
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
?>
<rss version="2.0">
<channel>
<title>onfocus.com</title>
<link>https://www.onfocus.com/</link>
<description>A personal weblog by Paul Bausch, a web developer in Corvallis, OR</description>
<language>en-us</language>
<lastBuildDate><?php print date(DATE_RSS_FORMAT); ?></lastBuildDate>
<?php
$query = "SELECT post_id, DateCreated, title, body, url_slug, item_type_id FROM items WHERE hide = 0 ORDER BY DateCreated DESC LIMIT $offset, $rowsPerPage";
if (!$result = mysqli_query ($connection, $query))
   	logError();
if (mysqli_num_rows($result) == 0) {
	die("Couldn't find any posts! WTF?!");
}
else {
	while ($post = mysqli_fetch_array($result)) {
		$cntPost++;
		$slug = $post['url_slug'];
		$title = $post['title'];
		$body = $post['body'];
		$type = $post['item_type_id'];
		// fix up youtube embeds
		if (strpos($body, "class=\"embed\"") !== false) {
			$find = "src=\"https://www.onfocus.com/loading.php\" ";
			$pos = strpos($body, $find);
			if ($pos !== false) {
			    $body = substr_replace($body, "", $pos, strlen($find));
			}
			$body = str_replace("data-src", "src", $body);
		}
		// fix up pinboard favicons
		if ($type == 9) {
			$dom = new DomDocument('1.0', 'UTF-8');
			$dom->loadHTML(mb_convert_encoding($body, 'HTML-ENTITIES', 'UTF-8'));
			$xpath = new DOMXpath($dom);
			foreach($xpath->query('//div[contains(attribute::class, "recmeta")]') as $e ) {
    			// Delete this node
    			$e->parentNode->removeChild($e);
			}
			$body = $dom->saveHTML();
			$body = str_replace('<html><body>','',$body);
			$body = str_replace('</body></html>','',$body);
		}
		$id = $post['post_id'];
		$postDateTime = $post['DateCreated'];
		$thisYear = date('Y',strtotime($postDateTime));
		$thisMonth = date('m',strtotime($postDateTime));
		$permalink = "https://www.onfocus.com/$thisYear/$thisMonth/$id";
		if ($slug !== '') {
			$permalink .= "/$slug";
		}
		$currentYear = date('Y');
		$thisDate = date(DATE_RSS_FORMAT,strtotime($postDateTime));
?>
	<item>
		<title><![CDATA[<?php print $title ?>]]></title>
		<link><?php print $permalink ?></link>
		<description><![CDATA[<?php print $body ?>]]></description>
		<pubDate><?php print $thisDate ?></pubDate>
	</item>
<?php
	}
}
ob_end_flush();
?>
</channel>
</rss>