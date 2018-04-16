<?php
require("onfocus-ini.inc");
$pagetitle = "About onfocus by Paul Bausch";
$pageNum = 1;
$isDateArchive = 0;
require("header.php");
?>
<style>
	.blend {
		display:inline-block;
		margin: auto;
		border-radius: 50%;
		margin-bottom:15px;
		transition: 1s filter linear, .5s -webkit-filter linear;
	}
	.blend img {
		transition: 1s filter linear, .5s -webkit-filter linear;
		border-radius: 50%;
	}
	.blend:hover {
		background: linear-gradient(135deg, #536976 0%, #90485f 50%);
		transition: 1s filter linear, .5s -webkit-filter linear;
	}
	.blend:hover img {
		border-radius: 50%;
		mix-blend-mode: lighten;
		-webkit-filter: grayscale(100%) contrast(.8);
		filter: grayscale(100%) contrast(.8);
	}
	.flourish img:hover {
		filter: grayscale(100%);
		transition: 1s filter linear, .5s -webkit-filter linear;
	}
</style>
	<!-- <h2><span class="dmd">&#9670;</span>&nbsp;&nbsp;About&nbsp;&nbsp;<span class="dmd">&#9670;</span></h2> -->
	<div class="post other">
	<div style="text-align:center;">
	<div class="blend">
		<img src="https://d1x6es5xzge33k.cloudfront.net/pb-deck-avatar-backup.jpg" width="140" height="140" alt="Paul Bausch" style="display:block;"/>
	</div>
	</div>
	<h2 class="title">About Paul Bausch</h2>
		<div class="post-text">
		<div style="margin-top:15px;">
		Hi, how's it going? I'm pb&mdash;a Web Developer in <a href="//en.wikipedia.org/wiki/Corvallis,_Oregon">Corvallis, Oregon</a>.
		<br /><br />
		onfocus is my personal website where I've been posting whatever comes to mind since 1998. These days it's mostly pictures.
		</div>
		<div class="flourish" style="text-align:center;margin:15px;font-size:1.5em;">
			<img src="fig111.png" style="width:150px;padding-top:10px;"/>
		</div>
		<div class="post-text">
		In 2017 I started working at <a href="http://ecampus.oregonstate.edu/">Oregon State University Ecampus</a>, one of the top online education programs in the US.
		<br /><br />
		From 2006-2016 I worked at <a href="//www.metafilter.com/">MetaFilter</a>, an amazing online community. If you want to know more about MetaFilter, start with <a href="//vimeo.com/11916466">this talk by Matt Haughey</a>&mdash;it's a great introduction.
		<br /><br />
		From 2008-2013 I co-developed <a href="//www.fuelly.com/">Fuelly</a> which helps people share and compare their vehicle fuel economy.
		<br /><br />
		From 2003-2008 I developed and ran ORblogs.com, an Oregon weblog directory.
		<br /><br />
		From 2002-2006 I wrote <a href="//www.amazon.com/gp/redirect.html?ie=UTF8&amp;location=http%3A%2F%2Fwww.amazon.com%2Fs%3Fie%3DUTF8%26redirect%3Dtrue%26search-type%3Dss%26index%3Dbooks%26ref%3Dntt%255Fathr%255Fdp%255Fsr%255F1%26field-author%3DPaul%2520Bausch&amp;tag=onfocus&amp;linkCode=ur2&amp;camp=1789&amp;creative=390957">some books</a><img src="https://www.assoc-amazon.com/e/ir?t=onfocus&amp;l=ur2&amp;o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /> about web applications. 
		<br /><br />
		From 1999-2001 I helped create an early weblog tool called <a href="//www.blogger.com/home">Blogger</a> at Pyra Labs.
		<br /><br />
		(Here are <a href="https://makerba.se/m/ffatkg/pbausch">a few of these projects and more on Makerbase</a>.)
		</div>
		<div class="flourish" style="text-align:center;margin:15px;font-size:1.5em;">
			<img src="fig113.png" style="width:160px;padding-top:10px;"/>
		</div>
		<div class="post-text">
		Before 1999 I studied broadcast journalism at the University of Nebraska in Lincoln.
		<br /><br />
		When I'm not computering I like to hike and camp. Oregon is a great place for those.
		</div></div></div>
		<div class="post" style="margin-top:18px;">
		<h2 class="title">Contact Me</h2>
		<div class="post-text">
		You can <a href="/contact">send me an email here</a>.
		<br /><br /> Or you can connect with me on any of these sites:
		<div id="socialgrid">
			<div class="socmeed">
				<a href="http://vsco.co/onfocus/" title="VSCO" rel="me"><svg id="vscoicon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M24,0.002c-13.234,0-24,10.767-24,24c0,13.233,10.766,24,24,24c13.233,0,24-10.767,24-24 C48,10.769,37.233,0.002,24,0.002z M47.059,24.002c0,0.798-0.041,1.586-0.12,2.363l-4.076-0.503c0.06-0.612,0.092-1.232,0.092-1.859 c0-0.593-0.031-1.178-0.084-1.757l4.078-0.486C47.02,22.498,47.059,23.246,47.059,24.002z M0.941,24.002 c0-0.784,0.04-1.559,0.117-2.323l4.076,0.497c-0.058,0.601-0.09,1.209-0.09,1.825c0,0.615,0.032,1.222,0.089,1.822l-4.077,0.492 C0.981,25.555,0.941,24.783,0.941,24.002z M41.906,17.797l3.842-1.447c0.506,1.433,0.873,2.93,1.087,4.475l-4.074,0.486 C42.587,20.099,42.298,18.924,41.906,17.797z M42.014,24.002c0,1.2-0.12,2.372-0.345,3.506l-4.038-0.933 c0.157-0.835,0.243-1.694,0.243-2.574c0-0.915-0.091-1.809-0.261-2.675l4.042-0.911C41.889,21.576,42.014,22.775,42.014,24.002z  M24,36.935c-7.131,0-12.933-5.801-12.933-12.932c0-7.131,5.801-12.933,12.933-12.933c7.131,0,12.932,5.802,12.932,12.933 C36.932,31.133,31.131,36.935,24,36.935z M24.439,42.005l0.007-4.14c1.829-0.058,3.569-0.471,5.154-1.174l1.789,3.733 C29.259,41.387,26.91,41.945,24.439,42.005z M16.553,40.398l1.802-3.727c1.583,0.708,3.322,1.128,5.15,1.193l-0.007,4.14 C21.027,41.935,18.681,41.368,16.553,40.398z M5.986,24.002c0-1.249,0.128-2.469,0.372-3.648l4.038,0.925 c-0.176,0.881-0.27,1.791-0.27,2.723c0,0.863,0.083,1.706,0.235,2.526L6.32,27.446C6.103,26.331,5.986,25.18,5.986,24.002z  M23.529,6v4.14c-1.801,0.06-3.516,0.465-5.082,1.151l-1.795-3.73C18.763,6.614,21.086,6.063,23.529,6z M31.404,7.587l-1.809,3.724 c-1.577-0.698-3.307-1.11-5.125-1.171V6C26.936,6.064,29.279,6.624,31.404,7.587z M41.575,16.915 c-0.456-1.127-1.017-2.2-1.672-3.208l3.383-2.323c0.84,1.279,1.554,2.646,2.129,4.084L41.575,16.915z M41.444,19.499l-4.044,0.912 c-0.462-1.723-1.246-3.315-2.287-4.705l3.242-2.57C39.775,15.006,40.84,17.16,41.444,19.499z M34.521,14.973 c-1.138-1.324-2.52-2.432-4.078-3.252l1.808-3.724c2.117,1.096,3.99,2.597,5.515,4.404L34.521,14.973z M33.316,7.504l1.917-3.629 c1.349,0.756,2.613,1.644,3.777,2.645l-2.727,3.063C35.365,8.8,34.373,8.103,33.316,7.504z M32.487,7.061 c-1.074-0.54-2.205-0.98-3.383-1.31l0.993-3.983c1.502,0.412,2.942,0.973,4.306,1.666L32.487,7.061z M28.191,5.52 c-1.181-0.268-2.403-0.424-3.656-0.459V0.957c1.595,0.037,3.149,0.235,4.648,0.581L28.191,5.52z M23.594,5.057 c-1.236,0.026-2.443,0.169-3.611,0.422l-0.982-3.984c1.483-0.329,3.018-0.514,4.592-0.542V5.057z M19.069,5.701 c-1.185,0.32-2.324,0.75-3.406,1.282l-1.906-3.633c1.372-0.683,2.82-1.235,4.329-1.636L19.069,5.701z M14.829,7.42 c-1.067,0.592-2.071,1.284-2.999,2.064l-2.718-3.07c1.176-0.997,2.451-1.881,3.811-2.629L14.829,7.42z M15.804,7.969l1.795,3.73 c-1.56,0.815-2.946,1.918-4.089,3.238l-3.236-2.583C11.806,10.553,13.684,9.057,15.804,7.969z M9.683,13.086l3.233,2.581 c-1.046,1.387-1.835,2.976-2.303,4.697l-4.04-0.925C7.185,17.103,8.257,14.952,9.683,13.086z M6.461,16.823l-3.835-1.457 c0.586-1.444,1.311-2.816,2.163-4.098l3.376,2.333C7.498,14.612,6.926,15.69,6.461,16.823z M6.125,17.703 c-0.401,1.135-0.698,2.318-0.877,3.54l-4.072-0.497c0.221-1.555,0.596-3.061,1.112-4.501L6.125,17.703z M5.248,26.759 c0.179,1.221,0.476,2.404,0.876,3.539l-3.84,1.452c-0.515-1.44-0.89-2.945-1.11-4.5L5.248,26.759z M6.459,31.177 c0.465,1.133,1.036,2.21,1.702,3.221l-3.379,2.328c-0.851-1.282-1.576-2.654-2.16-4.097L6.459,31.177z M6.523,28.366l4.037-0.917 c0.446,1.74,1.224,3.348,2.26,4.756l-3.242,2.579C8.163,32.896,7.112,30.721,6.523,28.366z M13.403,32.943 c1.141,1.35,2.533,2.48,4.106,3.316l-1.802,3.727c-2.132-1.111-4.017-2.633-5.545-4.465L13.403,32.943z M14.816,40.576l-1.912,3.632 c-1.358-0.749-2.631-1.632-3.805-2.629l2.723-3.067C12.749,39.292,13.751,39.984,14.816,40.576z M15.649,41.013 c1.08,0.532,2.217,0.963,3.4,1.284l-0.988,3.985c-1.507-0.402-2.953-0.955-4.323-1.638L15.649,41.013z M19.963,42.52 c1.166,0.254,2.371,0.398,3.605,0.426l-0.006,4.104c-1.572-0.03-3.106-0.216-4.586-0.547L19.963,42.52z M24.509,42.944 c1.232-0.033,2.436-0.182,3.599-0.441l0.976,3.986c-1.479,0.334-3.01,0.525-4.581,0.559L24.509,42.944z M29.022,42.277 c1.178-0.324,2.31-0.758,3.384-1.292l1.901,3.636c-1.365,0.685-2.806,1.239-4.308,1.645L29.022,42.277z M33.238,40.545 c1.058-0.593,2.053-1.284,2.974-2.061l2.714,3.075c-1.168,0.995-2.435,1.876-3.786,2.625L33.238,40.545z M32.237,40.015 l-1.789-3.734c1.576-0.831,2.972-1.955,4.117-3.301l3.231,2.588C36.263,37.395,34.373,38.911,32.237,40.015z M38.384,34.833 l-3.232-2.589c1.041-1.404,1.823-3.01,2.276-4.749l4.035,0.932C40.866,30.78,39.805,32.95,38.384,34.833z M41.538,31.183 l3.834,1.462c-0.582,1.434-1.303,2.797-2.148,4.072L39.85,34.38C40.51,33.376,41.076,32.307,41.538,31.183z M41.874,30.304 c0.398-1.125,0.694-2.298,0.874-3.508l4.072,0.503c-0.222,1.544-0.596,3.039-1.109,4.469L41.874,30.304z M42.753,10.609 l-3.381,2.322c-0.709-0.981-1.508-1.892-2.387-2.72l2.729-3.064C40.837,8.196,41.855,9.356,42.753,10.609z M8.404,7.035l2.72,3.072 c-0.891,0.827-1.703,1.737-2.423,2.72l-3.374-2.331C6.237,9.243,7.267,8.082,8.404,7.035z M5.32,37.497l3.378-2.327 c0.719,0.982,1.529,1.892,2.419,2.718l-2.724,3.068C7.256,39.911,6.228,38.751,5.32,37.497z M39.631,40.935l-2.716-3.076 c0.882-0.823,1.686-1.728,2.399-2.705l3.371,2.336C41.783,38.737,40.76,39.892,39.631,40.935z"></path></svg></a>	
				<div class="soccaption">VSCO</div>	
			</div>
			<div class="socmeed">
				<a href="//pinboard.in/u:pb" title="Pinboard" rel="me"><svg id="pinboardicon" width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path fill-rule="nonzero" d="M8.901 9.723L5.895 12.8l.48-2.708-4.09-5.045L0 5.169 5.053 0v1.969l4.81 4.43 3.008-.737-3.126 3.322L16 16z"/></svg></a>
				<div class="soccaption">Pinboard</div>
			</div>
			<div class="socmeed">
				<a href="https://github.com/pbausch/" title="GitHub" rel="me"><svg id="githubicon" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M8 0C3.58 0 0 3.582 0 8c0 3.535 2.292 6.533 5.47 7.59.4.075.547-.172.547-.385 0-.19-.007-.693-.01-1.36-2.226.483-2.695-1.073-2.695-1.073-.364-.924-.89-1.17-.89-1.17-.725-.496.056-.486.056-.486.803.056 1.225.824 1.225.824.714 1.223 1.873.87 2.33.665.072-.517.278-.87.507-1.07-1.777-.2-3.644-.888-3.644-3.953 0-.873.31-1.587.823-2.147-.09-.202-.36-1.015.07-2.117 0 0 .67-.215 2.2.82.64-.178 1.32-.266 2-.27.68.004 1.36.092 2 .27 1.52-1.035 2.19-.82 2.19-.82.43 1.102.16 1.915.08 2.117.51.56.82 1.274.82 2.147 0 3.073-1.87 3.75-3.65 3.947.28.24.54.73.54 1.48 0 1.07-.01 1.93-.01 2.19 0 .21.14.46.55.38C13.71 14.53 16 11.53 16 8c0-4.418-3.582-8-8-8"/></svg></a>
				<div class="soccaption">GitHub</div>
			</div>
			<div class="socmeed">
				<a href="//www.linkedin.com/in/paulbausch" title="LinkedIn" rel="me"><svg id="linkedinicon" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M13.632 13.635h-2.37V9.922c0-.886-.018-2.025-1.234-2.025-1.235 0-1.424.964-1.424 1.96v3.778h-2.37V6H8.51v1.04h.03c.318-.6 1.092-1.233 2.247-1.233 2.4 0 2.845 1.58 2.845 3.637v4.188zM3.558 4.955c-.762 0-1.376-.617-1.376-1.377 0-.758.614-1.375 1.376-1.375.76 0 1.376.617 1.376 1.375 0 .76-.617 1.377-1.376 1.377zm1.188 8.68H2.37V6h2.376v7.635zM14.816 0H1.18C.528 0 0 .516 0 1.153v13.694C0 15.484.528 16 1.18 16h13.635c.652 0 1.185-.516 1.185-1.153V1.153C16 .516 15.467 0 14.815 0z" fill-rule="nonzero"/></svg></a>
				<div class="soccaption">LinkedIn</div>
			</div>
		</div>
		</div>
		</div>
		<div style="clear: both;"></div>
		<div class="post">
		<h2 class="title">About onfocus</h2>
		<div class="post-text">
		I share links, photos, and occasional thoughts. Here's <a href="http://xml.onfocus.com/posts">the feed</a> for the blog if you want to subscribe: <a href="http://xml.onfocus.com/posts"><img src="//o.snapgallery.net/feed.png" width="12" height="12" border="0" style="vertical-align:middle;" title="Subscribe to onfocus" alt="rss"/></a> And here's <a href="/archive">the archive</a> if you want to go back in time.
		<div class="flourish" style="text-align:center;margin:15px;font-size:1.5em;">
			<img src="fig110.png" style="width:160px;padding-top:10px;"/>
		</div>
		<code>onfocus</code> is the name of a <a href="//en.wikipedia.org/wiki/JavaScript">JavaScript</a> event. In 1998 when I was looking for a domain name to go along with my new blog I was using JavaScript quite a bit and thought it was a good fit. I still use JavaScript quite a bit so it was a lucky bet. If this weblog was about JavaScript it would be even better.
		</div>
		</div>
</div>
<div class="fill" style="margin-bottom:12px;"><div class="triangle-up-right rot90"></div><div class="triangle-up-left rotn90"></div></div>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
<?php require("footer.php"); ?>