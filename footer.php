<div id="bottom"><div id="copyright">\m/ >_< \m/</div></div>
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script type="text/javascript" language="javascript">var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script type="text/javascript" src="//www.onfocus.com/post030609-min.js"></script>
<script>
	function focusin(t) {
		t.setAttribute("style","-webkit-filter:blur(0px)");
	}
	function defocus(t) {
		t.setAttribute("style","-webkit-filter:blur(3px)");
	}
	
</script>
<?php include_once("analyticstracking.php") ?>
</body>
</html>