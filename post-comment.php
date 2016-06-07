<?php
require("onfocus-ini.inc");
if (!isset($_POST['token']) || !isset($_POST['postid']) || ($_POST['token'] != $_SESSION['token']) || !is_numeric($_POST['postid'])) {
	$error = "Keep in mind that JavaScript and Cookies must be enabled to comment on this site. Please check your browser and browser extension settings to make sure both JavaScript and Cookies are enabled for this domain.";
}
if (!isset($error) && (!isset($_POST['comment']) || ($_POST['comment'] == ""))) {
	$error = "Please go back and add a comment.";
}
if (!isset($error) && (!isset($_POST['name']) || ($_POST['name'] == ""))) {
	$error = "Please go back and add your name.";
}
if (isset($_POST['postid']) && is_numeric($_POST['postid'])) {
	$query = "SELECT post_id, DateCreated, comments_on FROM items WHERE post_id = " . mysql_real_escape_string($_POST['postid']);
	if (!$result = @ mysql_query ($query, $connection))
	   	logError();
	if (mysql_num_rows($result) == 0) {
		$error = "Something went horribly wrong. Please make sure you have JavaScript and Cookies enabled for this site.";
	} 
	else {
		while ($post = mysql_fetch_array($result)) {
			$postDate = date('U',strtotime($post['DateCreated']));
			$postID = $post['post_id'];
			$thisCommentsOn = $post['comments_on'];
		}
	}
}
// Not Valid?
if (!isset($error) && (!isset($postID) || !is_numeric($postID))) {
	$error = "The post you want to comment on wasn't found. That's odd. Please go back and try again.";
}
// Check to make sure comments are enabled for this post.
if (isset($thisCommentsOn) && isset($postDate)) {
	if (($thisCommentsOn == 0) || ($postDate < strtotime("-6 months"))) {
		$error = "Comments are disabled for this post.";
	}
}
// Add some keyword filters
if ((preg_match("/custom writing/i", $_POST['comment'])) || (preg_match("/term paper/i", $_POST['comment']))) {
	$error = "Comments are disabled for this post.";
}

if (isset($error)) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="/screen.css" />
	<title>Comment Error | onfocus</title>
	<meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>
</head>
<body>
<h1 class="archive-sitetitle"><a href="/"><?php print APP_TITLE ?></a></h1>
<div class="tagline">by <a href="/about">Paul Bausch</a>, <?php print APP_JOBTITLE ?>.</div>
<div class="blog">
<h2 class="archive-title">Comment Error</h2>
<div class="post archive">
	<div class="post-text">Sorry, your comment was not added. <?php print $error ?> <br /><br /> You can always <a href="http://www.onfocus.com/contact">contact me</a> if you're getting this error consistantly and it seems like you shouldn't.</div>
</div>
<div class="footer">
<div class="navigation"><a href="/">Home</a></div>
</div>
</div>
</body>
</html>
<?php
	die;
}

// ADD COMMENT
$comment = $_POST['comment'];
$comment = trim($comment);
$comment = strip_tags($comment);
$comment_f = mysql_real_escape_string($comment);
$name = $_POST['name'];
$name = trim($name);
$name = strip_tags($name);
$name_f = mysql_real_escape_string($name);
$url = $_POST['url'];
$url = trim($url);
$url = strip_tags($url);
$url_f = mysql_real_escape_string($url);
$ip = $_SERVER['REMOTE_ADDR'];
$ip_f = mysql_real_escape_string($ip);
$comment_date = date("Y-m-d H:i:s");
$hide_f = 0;
if ($url_f == "http://www.lowest-rate-loans.com") {
	$hide_f = 1;
}

$insert = "INSERT INTO comments (post_id,author,url,date,ip,comment,hide) VALUES ($postID,'$name_f','$url_f','$comment_date','$ip_f','$comment_f',$hide_f)";
if (!$add = @ mysql_query ($insert, $connection)) {
	logerror();	
}

//Build permalink to post
$thisYear = date('Y',$postDate);
$thisMonth = date('m',$postDate);
$permalink = "http://www.onfocus.com/$thisYear/$thisMonth/$postID";


// Mail me
$from_name = "onfocus comment";
$from_email = "comments@onfocus.com";
$message = "comment added by $name\r\n\r\n$permalink";
$subject = "comment added";
$headers = "From: $from_name <$from_email>" . "\r\n" .
    "Reply-To: $from_email" . "\r\n" .
    "X-Mailer: PHP/" . phpversion() . "\r\n" .
    "Originating-IP: " . $_SERVER['REMOTE_ADDR'];
$message = wordwrap($message, 70);
mail('pbausch@gmail.com', $subject, $message, $headers);

// Set comment default cookie
setcookie("name", $name, time()+60*60*24*365, "/", ".onfocus.com");
setcookie("url", $url, time()+60*60*24*365, "/", ".onfocus.com");

// Redirect to the post
header("Location: $permalink");
?>