<div id="bottom"><div id="copyright">\m/ &gt;_&lt; \m/</div></div>
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script type="text/javascript" language="javascript">var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script type="text/javascript" src="//www.onfocus.com/post030609-min.js"></script>
<script>
	function focusin(t) {
		t.setAttribute("style","-webkit-filter:blur(0px);filter:blur(0px)");
	}
	function defocus(t) {
		t.setAttribute("style","-webkit-filter:blur(3px);filter:blur(3px)");
	}
	function deferVideos() {
		var vidDefer = document.getElementsByTagName('iframe');
		for (var i=0; i<vidDefer.length; i++) {
			if(vidDefer[i].getAttribute('data-src')) {
				vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
				console.log('src set');
			} 
		} 
  	}
  	window.onload = deferVideos;
</script>
<?php if (isset($pageFooterAddition)) { print $pageFooterAddition; } ?>
<?php include_once("analyticstracking.php") ?>
</body>
</html>