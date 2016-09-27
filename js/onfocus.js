function swapnoimg() {
    for (var i = 0; i < document.images.length; i++) { 
		img = document.images[i];
		w = img.naturalWidth;
		h = img.naturalHeight;
		if (!img.complete) {
			img.src = 'https://www.onfocus.com/no-image.gif';
		}
		else if ((w == 0) || (h == 0)) {
			img.src = 'https://www.onfocus.com/no-image.gif';
		}
	}
}
function addEvent(obj, evType, fn){ 
 if (obj.addEventListener){ 
   obj.addEventListener(evType, fn, false); 
   return true; 
 } else if (obj.attachEvent){ 
   var r = obj.attachEvent("on"+evType, fn); 
   return r; 
 } else { 
   return false; 
 } 
}
function submitForm() {
	var c = document.getElementById("comment");
	var cv = trim(c.value);
	if ((cv==null)||(cv=="")) {
		alert('Please enter a comment.');
		c.focus();
		return false;
	}
	var n = document.getElementById("name")
	var nv = trim(n.value);
	if ((nv==null)||(nv=="")) {
		alert('Please enter your name.');
		n.focus();
		return false;
	}
	var t = document.getElementById("token");
	t.value = token;
	return true;
}
function trim (str) {
	var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}
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
		} 
	} 
}
addEvent(window, 'load', swapnoimg);
addEvent(window, 'load', deferVideos);