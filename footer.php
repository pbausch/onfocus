<!-- <div id="bottom"><div id="copyright">\m/ &gt;_&lt; \m/</div></div> -->
<?php if (isset($thisToken)) { if ($thisToken != '') { ?><script>var token = '<?php print $thisToken; ?>';</script><?php }} ?>
<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?php print LIVE_SCRIPT ?>"></script>
<script src="/js/jquery.fancybox.min.js"></script>
<?php if (isset($pageFooterAddition)) { print $pageFooterAddition; } ?>
<?php //if ($_SERVER['REMOTE_ADDR'] <> HOME_IP) { ?>
<script async defer data-website-id="03ed9b9b-a963-4b3c-8c40-7bd8ba62eefd" src="https://umami.onfocus.com/umami.js"></script>
<script>
function link_is_external(link_element) {
    return (link_element.host !== window.location.host);
}
$(function() {
    $('a').each(function() {
        if (link_is_external(this)) {
           $(this).click(function(e) {
                e.preventDefault();
                umami.trackEvent($(this).text(), 'link click');
                setTimeout(function () { window.location.href = $(this).attr('href'); }, 250); 
           }); 
        }
    });
});

</script>
<?php //} ?>
</body>
</html>
