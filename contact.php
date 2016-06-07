<?php
require("onfocus-ini.inc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>About onfocus by Paul Bausch</title>
	<link rel="stylesheet" href="http://o.snapgallery.net/screen032010.css" />
	<script language="JavaScript">
		function checkForm(f) {
			if (f.txtName.value == '') {
				alert('Please enter your name. ');	
				return false;
			}
			if (f.txtEmail.value == '') {
				alert('Please enter your email. ');	
				return false;
			}
			if (f.txaBody.value == '') {
				alert('Please enter the text of your email. ');
				return false;
			}
			f.submit.disabled = true;
			return true;
		}
	</script>
</head>
<body>
<div id="header" onclick="document.location='/';"></div>
<div id="blog">
	<h2>Contact Paul Bausch</h2>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$from_name = $_POST["txtName"];
		$from_email = $_POST["txtEmail"];
		$message = $_POST["txaBody"];
		$subject = $_POST["txtSubject"] . " [" . APP_TITLE . " contact]";
		$headers = "From: $from_name <$from_email>" . "\r\n" .
		    "Reply-To: $from_email" . "\r\n" .
		    "X-Mailer: PHP/" . phpversion() . "\r\n" .
		    "Originating-IP: " . $_SERVER['REMOTE_ADDR'];


		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$message = wordwrap($message, 70);

		// Send
		mail('pbausch@gmail.com', $subject, $message, $headers);
	?>
		<div class="post" style="margin-top:18px;">
			<div class="post-text">Thanks! Your message was sent. I'll try to get back to you as soon as I can.
			<br /><br />
			Now you might want to <a href="/">go back to the front page</a>.
			</div>
		</div>	
	<?php
	}
	else {
	?>
	<div class="post" style="margin-top:18px;">
		<div class="post-text">This handy form will send a message directly to my inbox.
		<br /><br />
		<table border="0">
		<form action="/contact" method="post" name="frmComment" onSubmit="return checkForm(this);">
			<tr><td align="right" valign="middle"><span class="post-byline"><nobr>your name&nbsp;</nobr></span></td><td><input name="txtName" type="text" size="35" maxlength="25" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" required="required" autofocus="autofocus"/></td></tr>
			<tr><td align="right" valign="middle"><span class="post-byline"><nobr>your email&nbsp;</nobr></span></td><td><input name="txtEmail" type="text" size="35" maxlength="100" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" type="email" required="required"/></td></tr>
			<tr><td colspan="2" height="15">&nbsp;</td></tr>
			<tr><td align="right" valign="middle"><span class="post-byline"><nobr>subject&nbsp;</nobr></span></td><td><input name="txtSubject" type="text" size="35" maxlength="100" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';"/></td></tr>
			<tr><td align="right" valign="top"><span class="post-byline"><nobr>comments&nbsp;</nobr></span></td><td><textarea cols="40" rows="14" name="txaBody" style="width:400px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';"></textarea></td></tr>
			<tr><td>&nbsp;</td><td><input style="margin-top:10px;" type="submit" value="send message"/></td></tr>
		</form>
		</table>
		</div>
	</div>
	<?php } ?>
</div>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
<div id="bottom"></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-76008-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>