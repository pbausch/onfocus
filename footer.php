<!-- <div id="bottom"><div id="copyright">\m/ &gt;_&lt; \m/</div></div> -->
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script>var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="<?php print LIVE_SCRIPT ?>"></script>
<script src="/js/jquery.fancybox.min.js"></script>
<script>
//$(function() {
//	if ($.fancybox.isMobile) { 
//	    $.fancybox.destroy();
//	}
//});
</script>
<?php if (isset($pageFooterAddition)) { print $pageFooterAddition; } ?>
<?php //include_once("lib/analyticstracking.php") ?>
</body>
</html>