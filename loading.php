<?php 
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60*60*24*45)) . ' GMT'); 
header('Cache-Control: public');
?>
<html>
<head>
	<style>
		html, body {
		    margin: 0;
		    padding: 0;
		    width: 100%;
		    height: 100%;
		    display: table;
			font-family:"Lucida Grande",Verdana,"Lucida Sans","Lucida Sans Unicode",sans-serif;
			background-color:#eee;
		}
		#content {
		    display: table-cell;
		    text-align: left;
		    vertical-align: top;
		}
		#msg {
			background-color: rgba(255,255,255,0.5);
			padding: 20px;
		}
	</style>
</head>
<body>
	<div id="content">
		<div id="msg">Loading...</div>
	</div>
	<script>
		var src = window.frameElement.getAttribute('data-src');
		var video_id = src.split('/embed/')[1];
		if(video_id != undefined) {
			video_id = video_id.replace('?rel=0','');
		 	var content = document.getElementById("content");
			content.style.backgroundImage = 'url(https://img.youtube.com/vi/'+ video_id +'/hqdefault.jpg)';
			content.style.backgroundSize = 'cover';
		}
	</script>
</body>
</html>