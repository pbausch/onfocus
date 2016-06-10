<?php
require("onfocus-ini.inc");
$pagetitle = "onfocus contact";
$pageNum = 1;
$isDateArchive = 0;
require("header.php");
?><h2>Contact Paul Bausch</h2>
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
		<table border="0" cellspacing="5">
		<form action="/contact" method="post" name="frmComment" onSubmit="return checkForm(this);">
			<tr><td align="right" valign="middle"><label for="txtName"><nobr>Your Name&nbsp;</nobr></label></td><td><input id="txtName" name="txtName" type="text" size="35" maxlength="25" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" required="required" autofocus="autofocus"/></td></tr>
			<tr><td align="right" valign="middle"><label for="txtEmail"><nobr>Your Email&nbsp;</nobr></label></td><td><input id="txtEmail" name="txtEmail" type="text" size="35" maxlength="100" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';" type="email" required="required"/></td></tr>
			<tr><td colspan="2" height="15">&nbsp;</td></tr>
			<tr><td align="right" valign="middle"><label for="txtSubject"><nobr>Subject&nbsp;</nobr></label></td><td><input id="txtSubject" name="txtSubject" type="text" size="35" maxlength="100" style="width:250px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';"/></td></tr>
			<tr><td align="right" valign="top"><label for="txaBody"><nobr>Comments&nbsp;</nobr></label></td><td><textarea cols="40" rows="14" id="txaBody" name="txaBody" style="width:400px;background-color:#eee;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#eee';"></textarea></td></tr>
			<tr><td>&nbsp;</td><td><input class="btn" style="margin-top:10px;" type="submit" value="send message"/></td></tr>
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
<?php require("footer.php"); ?>