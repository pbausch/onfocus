<!-- <div id="bottom"><div id="copyright">\m/ &gt;_&lt; \m/</div></div> -->
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script>var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?php print LIVE_SCRIPT ?>"></script>
<script src="/js/jquery.fancybox.min.js"></script>
<?php if (isset($pageFooterAddition)) { print $pageFooterAddition; } ?>
<!-- Start Open Web Analytics Tracker -->
<script type="text/javascript">
//<![CDATA[
var owa_baseUrl = 'https://www.onfocus.com/owa/';
var owa_cmds = owa_cmds || [];
owa_cmds.push(['setSiteId', '0eb8c5ed7e29d6444ee1b29be68cfa81']);
owa_cmds.push(['trackClicks']);

(function() {
    var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
    owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
    _owa.src = owa_baseUrl + 'modules/base/js/owa.tracker-combined-min.js';
    var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
}());
//]]>
</script>
<!-- End Open Web Analytics Code -->
</body>
</html>