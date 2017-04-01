<?php
require("onfocus-ini.inc");
// Paging
$query = "SELECT Max(DateCreated) FROM items";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
while ($tp = mysql_fetch_row($result)) {
	$maxdate = $tp[0];
}
$pageTitle = "onfocus archive";
$pageDescription = "Linking 17 years of onfocus.com month by month.";
$pageNum = 1;
$isDateArchive = 0;
require("header.php");
?>
	<h2>&#9670;&nbsp;&nbsp;Archive&nbsp;&nbsp;&#9670;</h2>
	
	<div class="post" style="margin-top:18px;">
		<h3>Start Here</h3>
		<div class="post-text">
		You have to start somewhere.
		<ul>
			<li><a href="https://www.onfocus.com/amafeed/">Amazon Feed Generator</a></li>
			<li><a href="https://www.onfocus.com/eat_generator.asp">What do you want for dinner? I dunno.</a> (1999)</li>
			<li><a href="https://www.onfocus.com/2016/11/6842/pinboard-popular-tweets">Pinboard Popular Tweets</a> (Nov 2016)</li>
			<li><a href="https://www.onfocus.com/2004/09/3566/guerilla-media-literacy-list">Media Literacy Reading List</a> (Sep 2004)</li>
			<li><a href="https://www.onfocus.com/2005/08/3732/how-i-write-a-hack">How I Write a Hack</a> (Aug 2005)</li>
		</ul>
		</div>
	</div>
	
	<div class="post">
		<h3>Most Hearted Posts</h3>
		<div class="post-text">
		Each post has a clickable heart that I added in October 2016: <a href="https://www.onfocus.com/2016/10/6812/c2bk-infrastructure-report-hearts">Hearts</a>. These posts have the most heart-clicks:
		<ul>
			<?php
			$query = "SELECT COUNT(hearts.post_id), items.post_id, items.title, items.DateCreated, items.url_slug FROM hearts INNER JOIN items ON items.post_id = hearts.post_id WHERE heart = 1 AND items.hide = 0 GROUP BY items.post_id, items.title, items.DateCreated, items.url_slug ORDER BY COUNT(hearts.post_id) DESC, post_id DESC LIMIT 10";
			if (!$result = @ mysql_query ($query, $connection))
			   	logError();
			if (mysql_num_rows($result) == 0) {
				die("<div class=\"post-text\">Couldn't find any hearts! WTF?!</div>");
			} 
			else {
				while ($heart = mysql_fetch_array($result)) {
					$title = $heart['title'];
					$id = $heart['post_id'];
					$slug = $heart['url_slug'];
					$postDateTime = $heart['DateCreated'];
					$thisYear = date('Y',strtotime($postDateTime));
					$thisMonth = date('m',strtotime($postDateTime));
					$permalink = "/$thisYear/$thisMonth/$id";
					if ($slug !== '') {
						$permalink .= "/$slug";
					}
					print "<li><a href=\"$permalink\">$title</a></li>";
				}
			}
			?>
		</ul>
		</div>
	</div>

	<div class="post">
		<h3>Post Archive</h3>
		<div class="post-text">
		For serious browsers only: 17 years worth of onfocus posts, month by month:
		<br/><br/>
		<table border="0" cellpadding="6" style="line-height:150%;"><tr valign="top"> 
		<?php
		$cal_month_abb = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		$startYear = 1999;
		$endYear = date("Y",strtotime($maxdate));
		for ($i = $startYear; $i <= $endYear; $i++) {
			print "<td style=\"text-align:center;\">";
			print "<div style=\"font-weight:bold;margin-bottom:5px;\">&nbsp;".$i."&nbsp;</div>";
			$startMonth = 1;
			$endMonth = 12;
			if ($i == $endYear) {
				$endMonth = date("n",strtotime($maxdate));
			}
			if ($i == $startYear) {
				$startMonth = 8;
				print "<br /><br /><br /><br /><br /><br /><br />";
			}
			for ($j = $startMonth; $j <= $endMonth; $j++) {
				$lzj = $j;
				if (strlen($lzj)==1) {
					$lzj = "0$lzj";
				}
				if (($j == 9) && ($i == 2007)) {
					print "<br />";
				}
				else {
					print "&nbsp;<a href=\"/".$i."/".$lzj."\">".$cal_month_abb[$j-1]."</a>&nbsp;<br />";
				}
			}
			print "</td>";
			if ($i == 2007) {
				print "</tr></table><br /><br /><table border=\"0\" cellpadding=\"6\" style=\"line-height:150%;\"><tr valign=top>";
			}
		}
		?>
		</tr></table>
		<br />
		I started this site in 1998, and there are a few remnants of the early days in the <a href="https://web.archive.org/web/*/http://www.onfocus.com/">Internet Archive</a>.
		</div>
	</div>
<?php
$query = "SELECT GalleryName, DateCreated, URL, ThumbURL, TotalPhotos FROM Galleries ORDER BY DateCreated DESC";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
?>
	<div class="post" id="galleryArchive">
		<h3>Gallery Archive</h3>
		<div class="post-text">
			Before Flickr, Facebook, Instagram, and others I posted a lot of pictures here. I used to post one or two pictures in a post and then link to a gallery of more. These are links to those galleries:
			<br /><br />
			<?php while ($tp = mysql_fetch_row($result)) {
				$galleryName = $tp[0];
				$galleryDTM = $tp[1];
				$galleryURL = $tp[2];
				$galleryThumbURL = $tp[3];
				$galleryThumbURL = str_replace("http://","https://",$galleryThumbURL);
				$galleryThumbURL = str_replace("thumbs/","",$galleryThumbURL);
				$galleryThumbURL = str_replace("https://www.onfocus.com/",LOCAL_CDN_URL."/img/200x130/",$galleryThumbURL);
				$galleryTotalPhotos = $tp[4];
				print '<div class="galleryThumb"><a href="https://www.onfocus.com'.$galleryURL.'" title="'. $galleryName .' ('. date('Y', strtotime($galleryDTM)) .') / '. $galleryTotalPhotos .' photos"><img data-src="'.$galleryThumbURL.'" src="'.$galleryThumbURL.'" width="200" height="130"/></a></div>';
			} ?>
		</div>
		<div style="clear:both;"></div>
	</div>
	<!--
	<h2>Popular</h2>
	<div class="post">
		<div class="post-text" style="margin-top:18px;">
		According to <a href=" //www.google.com/analytics/">Google Analytics</a>, these are the most viewed pages over the last 30 days:
		<ul>
			<li><a href="//www.onfocus.com/eat_generator.php">What do you want for dinner? I dunno.</a> - 1999</li>
			<li><a href="//www.onfocus.com/2006/04/3799">Add a batch of dates to Google Calendar</a> - April 18th, 2006</li>
			<li><a href="//www.onfocus.com/2005/06/3712">hot shower for sunburn</a> - June 28th, 2005</li>
			<li><a href="//www.onfocus.com/2007/01/3900">Command Line Zip for Windows</a> - January 4th, 2007</li>
			<li><a href="//www.onfocus.com/cam/2003/dials/">radio dials (2003)</a> and <a href=" //www.onfocus.com/cam/2004/radio-dials/">radio dials (2004)</a></li>
			<li><a href="//www.onfocus.com/2009/07/4247">Remove Google Reader 'Likes'</a> - July, 2009</li>
		</ul>
		</div>
	</div>
	-->
</div>
<div class="fill" style="margin-bottom:12px;"><div class="triangle-up-right rot90"></div><div class="triangle-up-left rotn90"></div></div>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
<?php require("footer.php"); ?>