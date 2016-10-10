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
	<h2>Post Archive</h2>
	<div class="post">
		<div class="post-text" style="margin-top:18px;">
		Here are 17 years worth of onfocus.com posts, month by month:
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
		I started this site in 1998, and there are a few remnants of the early days in the <a href=" //web.archive.org/web/*/ //www.onfocus.com/">Internet Archive</a>.
		</div>
	</div>
<?php
$query = "SELECT GalleryName, DateCreated, URL, ThumbURL, TotalPhotos FROM Galleries ORDER BY DateCreated DESC";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
?>
	<h2>Gallery Archive</h2>
	<div class="post" id="galleryArchive">
		<div class="post-text" style="margin-top:18px;">
			Before Flickr, Facebook, Instagram, and others I posted a lot of pictures here. I used to post one or two pictures in a post and then link to a gallery of more. These are links to those galleries:
			<br /><br />
			<?php while ($tp = mysql_fetch_row($result)) {
				$galleryName = $tp[0];
				$galleryDTM = $tp[1];
				$galleryURL = $tp[2];
				$galleryThumbURL = $tp[3];
				$galleryThumbURL = str_replace("http://","https://",$galleryThumbURL);
				$galleryThumbURL = str_replace("thumbs/","",$galleryThumbURL);
				$galleryThumbURL = str_replace(".com/",".com/img/200x130/",$galleryThumbURL);
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
			<li><a href=" //www.onfocus.com/eat_generator.php">What do you want for dinner? I dunno.</a> - 1999</li>
			<li><a href=" //www.onfocus.com/2006/04/3799">Add a batch of dates to Google Calendar</a> - April 18th, 2006</li>
			<li><a href=" //www.onfocus.com/2005/06/3712">hot shower for sunburn</a> - June 28th, 2005</li>
			<li><a href=" //www.onfocus.com/2007/01/3900">Command Line Zip for Windows</a> - January 4th, 2007</li>
			<li><a href=" //www.onfocus.com/cam/2003/dials/">radio dials (2003)</a> and <a href=" //www.onfocus.com/cam/2004/radio-dials/">radio dials (2004)</a></li>
			<li><a href=" //www.onfocus.com/2009/07/4247">Remove Google Reader 'Likes'</a> - July, 2009</li>
		</ul>
		</div>
	</div>
	-->
</div>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
<?php require("footer.php"); ?>