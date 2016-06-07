function swapnoimg(){for(var i=0;i<document.images.length;i++){img=document.images[i];w=img.naturalWidth;h=img.naturalHeight;if(!img.complete){img.src='http://www.onfocus.com/no-image.gif';}
else if((w==0)||(h==0)){img.src='//www.onfocus.com/no-image.gif';}}}
function addEvent(obj,evType,fn){if(obj.addEventListener){obj.addEventListener(evType,fn,false);return true;}else if(obj.attachEvent){var r=obj.attachEvent("on"+evType,fn);return r;}else{return false;}}
function submitForm(){var c=document.getElementById("comment");var cv=trim(c.value);if((cv==null)||(cv=="")){alert('Please enter a comment.');c.focus();return false;}
var n=document.getElementById("name")
var nv=trim(n.value);if((nv==null)||(nv=="")){alert('Please enter your name.');n.focus();return false;}
var t=document.getElementById("token");t.value=token;return true;}
function trim(str){var	str=str.replace(/^\s\s*/,''),ws=/\s/,i=str.length;while(ws.test(str.charAt(--i)));return str.slice(0,i+1);}
addEvent(window,'load',swapnoimg);