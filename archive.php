<?php
require("onfocus-ini.inc");
// Paging
$query = "SELECT Max(DateCreated) FROM items";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
while ($tp = mysql_fetch_row($result)) {
	$maxdate = $tp[0];
}
$pagetitle = "onfocus archive";
$pageNum = 1;
$isDateArchive = 0;
require("header.php");
?>
	<h2>Archive</h2>
	<div class="post">
		<div class="post-text" style="margin-top:18px;">
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