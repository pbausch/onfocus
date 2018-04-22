<!-- <div id="bottom"><div id="copyright">\m/ &gt;_&lt; \m/</div></div> -->
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script>var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script src="<?php print LIVE_SCRIPT ?>"></script>
<?php if (isset($pageFooterAddition)) { print $pageFooterAddition; } ?>
<?php //include_once("lib/analyticstracking.php") ?>
</body>
</html>