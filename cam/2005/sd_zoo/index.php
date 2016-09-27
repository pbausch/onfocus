<?php
require("onfocus-ini.inc");
require(ROOT_DIR . "/lib/gallery.php");
$pageTitle = "San Deigo Zoo 2005 Gallery";
$pageNum = 1;
$isDateArchive = 0;
$dir = getcwd() . "/";
require(ROOT_DIR . "header.php");
print gallery($dir,$pageTitle);
print <<<END
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
END;
require(ROOT_DIR . "footer.php"); 
?>