<?php
require("onfocus-ini.inc");
$pageNum = 1;
$isDateArchive = 0;
$pageTitle = "The What-Do-You-Want-For-Dinner I-Don't-Know-What-Do-You-Want? Dialog Generator | onfocus";
require("header.php");

	if (isset($_POST['hdnHdn'])) {
		$FirstName = Trim(strip_tags($_POST['txtFirstName']));
		if ($FirstName == "") {
			$FirstName = "you";
		}
		$OtherFirstName = Trim(strip_tags($_POST['txtOtherFirstName']));
		if ($OtherFirstName == "") {
			$OtherFirstName = "them";
		}
		$FavoriteFood = Trim(strip_tags($_POST['txtFavoriteFood']));
		if ($FavoriteFood == "") {
			$FavoriteFood = "sushi";
		}
		$BadFood = Trim(strip_tags($_POST['txtBadFood']));
		if ($BadFood == "") {
			$BadFood = "thai";
		}
		$Number = Trim(strip_tags($_POST['txtNumber']));
		if ($Number == "") {
			$Number = "3";
		}
	?>
	<h2 class="archive-title">The What-Do-You-Want-For-Dinner I-Don't-Know-What-Do-You-Want? Dialog Generator Results:</h2>
	<div class="post archive">
	<div class="post-text">
	<b><?php print $FirstName ?></b>: So, what do you want to eat?<br>
	<b><?php print $OtherFirstName ?></b>: I don't know what do you want to eat?<br>
	<b><?php print $FirstName ?></b>: I guess I'm not really that hungry.<br>
	<b><?php print $OtherFirstName ?></b>: Yeah, me neither.<br>
	<b><?php print $FirstName ?></b>: How does <?php print $FavoriteFood ?> sound?<br>
	<b><?php print $OtherFirstName ?></b>: Hmm, we have that a lot.<br>
	<b><?php print $FirstName ?></b>: yeah.<br>
	<b><?php print $OtherFirstName ?></b>: So you're really not hungry?<br>
	<b><?php print $FirstName ?></b>: Well, I could probably eat <i>something</i>.<br>
	<b><?php print $OtherFirstName ?></b>: Like what?<br>
	<b><?php print $FirstName ?></b>: Just about anything, really.<br>
	<b><?php print $OtherFirstName ?></b>: How about <?php print $BadFood ?>?<br>
	<b><?php print $FirstName ?></b>: Yeah, I guess that's ok.<br>
	<b><?php print $OtherFirstName ?></b>: I don't know now.<br>
	<b><?php print $FirstName ?></b>: You don't know? <i>Come on</i>.<br>
	<b><?php print $OtherFirstName ?></b>: We could order Chinese.<br>
	<b><?php print $FirstName ?></b>: You're too lazy to go out and get food?<br>
	<b><?php print $OtherFirstName ?></b>: No, I guess not. Where do you want to go?<br>
	<b><?php print $FirstName ?></b>: I was thinking that new <?php print $FavoriteFood ?> place.<br>
	<b><?php print $OtherFirstName ?></b>: That's all the way downtown!<br>
	<b><?php print $FirstName ?></b>: It's supposed to be good.<br>
	<b><?php print $OtherFirstName ?></b>: I guess I'm just not in the mood.<br>
	<b><?php print $FirstName ?></b>: Well, what are you in the mood for?<br>
	<b><?php print $OtherFirstName ?></b>: You said <i>just about anything</i>.<br>
	<b><?php print $FirstName ?></b>: Anything but <?php print $FavoriteFood ?>.<br>
	<b><?php print $OtherFirstName ?></b>: You suggested that earlier.<br>
	<b><?php print $FirstName ?></b>: I did? hmmm.<br>
	<b><?php print $OtherFirstName ?></b>: I always feel like <?php print $BadFood ?>, but we never go.<br>
	<b><?php print $FirstName ?></b>: That's fine..<br>
	<b><?php print $OtherFirstName ?></b>: I guess I'm just not in the mood.<br>
	<b><?php print $FirstName ?></b>: Well, I could probably eat <i>something</i>.<br>
	<b><?php print $OtherFirstName ?></b>: We could order Chinese.<br>
	<b><?php print $FirstName ?></b>: yeah.<br>
	<b><?php print $OtherFirstName ?></b>: You said <i>just about anything</i>.<br>
	<b><?php print $FirstName ?></b>: I was thinking that new <?php print $FavoriteFood ?> place.<br>
	<b><?php print $OtherFirstName ?></b>: You suggested that earlier.<br>
	<b><?php print $FirstName ?></b>: We could flip for it.<br>
	<b><?php print $OtherFirstName ?></b>: What are we arguing over?<br>
	<b><?php print $FirstName ?></b>: <?php print $FavoriteFood ?> or hamburgers.<br>
	<b><?php print $OtherFirstName ?></b>: heads.<br>
	<b><?php print $FirstName ?></b>: I don't have a quarter.<br>
	<b><?php print $OtherFirstName ?></b>: <?php print $BadFood ?>.<br>
	<b><?php print $FirstName ?></b>: Yeah, I guess that's ok.<br>
	<b><?php print $OtherFirstName ?></b>: Let's get a pizza.<br>
	<b><?php print $FirstName ?></b>: Yeah, ok.<br>
	<b><?php print $OtherFirstName ?></b>: What's your favorite number?<br>
	<b><?php print $FirstName ?></b>: <?php print $Number ?>.
	</div>
	</div>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Responsive Eat -->
	<ins class="adsbygoogle"
	     style="display:block"
	     data-ad-client="ca-pub-7425124421286960"
	     data-ad-slot="1890304351"
	     data-ad-format="auto"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	<?php } else { ?>
	<h2 class="archive-title">The What-Do-You-Want-For-Dinner I-Don't-Know-What-Do-You-Want? Dialog Generator.</h2>
	<div class="post archive">
	<div class="post-text">
	How many times have you argued with someone about what to have for dinner when both of you were too apathetic to actually come to a decision? 
	Well now you can skip the banal conversation with The What-Do-You-Want-For-Dinner-I-Don't-Know-What-Do-You-Want? Dialog Generator and start eating! It's fast and FREE. Just fill in your information below:
	<br /><br />
	<form action="eat_generator.php" method="post" id="eat">
	<table>
	<tr><td align="right"><label for="txtFirstName">Your First Name:</label></td><td><input type="text" size="15" maxlength="10" id="txtFirstName" name="txtFirstName" style="width:150px;background-color:#ddd;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#ddd';"/></td></tr>
	<tr><td align="right"><label for="txtOtherFirstName">Friend's/SO's First Name:</label></td><td><input type="text" size="15" maxlength="10" id="txtOtherFirstName" name="txtOtherFirstName" style="width:150px;background-color:#ddd;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#ddd';"/></td></tr>
	<tr><td align="right"><label for="txtFavoriteFood">Your Favorite Food:</label></td><td><input type="text" size="15" maxlength="10" id="txtFavoriteFood" name="txtFavoriteFood" style="width:150px;background-color:#ddd;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#ddd';"/></td></tr>
	<tr><td align="right"><label for="txtBadFood">Your Least Favorite Food:</label></td><td><input type="text" size="15" maxlength="10" id="txtBadFood" name="txtBadFood" style="width:150px;background-color:#ddd;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#ddd';"/></td></tr>
	<tr><td align="right"><label for="txtNumber">Your Favorite Number:</label></td><td><input type="text" size="15" maxlength="10" id="txtNumber" name="txtNumber" style="width:150px;background-color:#ddd;padding:3px 2px;" onfocus="this.style.backgroundColor='#fff';" onblur="this.style.backgroundColor='#ddd';"/></td></tr>
	<tr><td colspan="2" height="15"></td></tr>
	<tr><td colspan="2" align="right"><input type="hidden" name="hdnHdn" value="true" /><input type="submit" value="ready? discuss..." class="btn" /></td></tr>
	</table>
	</form>
	</div>
	</div>
	<?php } ?>
</div>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
<?php require("footer.php") ?>