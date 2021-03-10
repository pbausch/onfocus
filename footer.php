<!-- <div id="bottom"><div id="copyright">\m/ &gt;_&lt; \m/</div></div> -->
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script>var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?php print LIVE_SCRIPT ?>"></script>
<script src="/js/jquery.fancybox.min.js"></script>
<?php if (isset($pageFooterAddition)) { print $pageFooterAddition; } ?>
<?php echo $tag_code; ?>
</body>
</html>