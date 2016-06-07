<?php 
require("onfocus-ini.inc");
if (isset($_GET['id'])) {
	$query = "SELECT post_id, DateCreated FROM Items WHERE post_id = ". mysql_real_escape_string($_GET['id']);
	if (!$result = @ mysql_query ($query, $connection))
	   	logError();
	if (mysql_num_rows($result) == 0) {
		send404();
	}
	else {
		while ($post = mysql_fetch_array($result)) {
			$id = $post['post_id'];
			$postDateTime = $post['DateCreated'];
			$thisYear = date('Y',strtotime($postDateTime));
			$thisMonth = date('m',strtotime($postDateTime));
			$permalink = "/$thisYear/$thisMonth/$id";
			header("Location: $permalink",TRUE,301);
		}
	}
}	
?>