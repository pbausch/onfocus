<?php
$query = "SELECT heart FROM hearts WHERE post_id = ". mysql_real_escape_string($_GET['id']) . " AND IP = '" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "'";
if (!$result = @ mysql_query ($query, $connection)) {
	logerror();	
}
else {
	$heart = mysql_fetch_array($result)[0];
}
?>
<div id="lineheart" class="heartbox" title="Click to like. This is equivalent to a favorite, like, star, or heart on social networks. Only better." aria-label="Click to like. This is equivalent to a favorite, like, star, or heart on social networks. Only better." <?php if($heart == 1) { ?>style="display:none;" <?php } ?>>
	<svg class="hearticon" width="29" height="29" viewBox="0 0 29 29" data-status="0"><path d="M16.215 23.716c-.348.288-.984.826-1.376 1.158a.526.526 0 0 1-.68 0c-.36-.307-.92-.78-1.22-1.03C9.22 20.734 3 15.527 3 10.734 3 7.02 5.916 4 9.5 4c1.948 0 3.77.898 5 2.434C15.73 4.898 17.552 4 19.5 4c3.584 0 6.5 3.02 6.5 6.734 0 4.9-6.125 9.96-9.785 12.982zM19.5 5.2c-1.774 0-3.423.923-4.41 2.468a.699.699 0 0 1-.59.323.706.706 0 0 1-.59-.32c-.988-1.54-2.637-2.47-4.41-2.47-2.922 0-5.3 2.49-5.3 5.54 0 4.23 6.19 9.41 9.517 12.19.217.18.566.48.783.66l.952-.79c3.496-2.88 9.348-7.72 9.348-12.05 0-3.05-2.378-5.53-5.3-5.53z"></path></svg>
</div>
<div id="fullheart" class="heartbox" title="Click to unlike. This is equivalent to a favorite, like, star, or heart on social networks. Only better." aria-label="Click to like. This is equivalent to a favorite, like, star, or heart on social networks. Only better." <?php if($heart == 0) { ?>style="display:none;" <?php } ?>>
	<svg class="hearticon" width="29" height="29" viewBox="0 0 29 29"><path d="M19.5 4c-1.948 0-3.77.898-5 2.434C13.27 4.898 11.448 4 9.5 4 5.916 4 3 7.02 3 10.734c0 4.793 6.227 10 9.95 13.11.296.25.853.723 1.212 1.03.196.166.48.166.677 0 .39-.332 1.02-.87 1.37-1.158 3.66-3.022 9.79-8.08 9.79-12.982C26 7.02 23.08 4 19.5 4z" fill-rule="evenodd"></path></svg>
</div>