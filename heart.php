<?php
require("onfocus-ini.inc");
$heart = mysql_real_escape_string($_GET['h']);
$pid = mysql_real_escape_string($_GET['pid']);
$t = $_GET['t'];
$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);

if ($t != $_SESSION['token']) {
	print "heart rejected. :(";
	die;
}

$insert = "INSERT INTO hearts (heart,post_id,IP,date_created) VALUES ($heart,$pid,'$IP',now())
  ON DUPLICATE KEY UPDATE heart=$heart";
if (!$add = @ mysql_query ($insert, $connection)) {
	logerror();	
}
?>
heart accepted.