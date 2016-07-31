<?php
//$colors = array("69D2E7", "A7DBD8", "E0E4CC", "F38630", "FA6900"); //giant goldfish
$colors = array("FE4365", "FC9D9A", "F9CDAD", "C8C8A9", "83AF9B"); //(◕〝◕)
//$colors = array("CFF09E", "A8DBA8", "79BD9A", "3B8686", "0B486B"); //adrift in dreams
$logocolor = $colors[array_rand($colors)];
$redhex  = substr($logocolor,0,2);
$greenhex = substr($logocolor,2,2);
$bluehex = substr($logocolor,4,2);
$tr = hexdec($redhex);
$tg = hexdec($greenhex);
$tb = hexdec($bluehex);
$hsl = rgbToHsl($tr,$tg,$tb);
$h = $hsl[0];
$s = $hsl[1];
$l = $hsl[2];
$h2 = $h + 0.5;
$s2 = $s;
$l2 = $l + 0.5;
if ($h2 > 1) {$h2 -= 1;}
if ($s2 > 1) {$s2 -= 1;}
if ($l2 > 1) {$l2 -= 1;}
$rgb = hslToRgb($h2,$s2,$l2);
$rhex = sprintf("%02X",round($rgb[0]));
$ghex = sprintf("%02X",round($rgb[1]));
$bhex = sprintf("%02X",round($rgb[2]));
$gradcolor = $rhex.$ghex.$bhex;

function rgbToHsl( $r, $g, $b ) {
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;

	$r /= 255;
	$g /= 255;
	$b /= 255;

    $max = max( $r, $g, $b );
	$min = min( $r, $g, $b );

	$h;
	$s;
	$l = ( $max + $min ) / 2;
	$d = $max - $min;

    	if( $d == 0 ){
        	$h = $s = 0; // achromatic
    	} else {
        	$s = $d / ( 1 - abs( 2 * $l - 1 ) );

		switch( $max ){
	            case $r:
	            	$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
                        if ($b > $g) {
	                    $h += 360;
	                }
	                break;

	            case $g: 
	            	$h = 60 * ( ( $b - $r ) / $d + 2 ); 
	            	break;

	            case $b: 
	            	$h = 60 * ( ( $r - $g ) / $d + 4 ); 
	            	break;
	        }			        	        
	}

	return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}

function hslToRgb( $h, $s, $l ){
    $r; 
    $g; 
    $b;

	$c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
	$x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
	$m = $l - ( $c / 2 );

	if ( $h < 60 ) {
		$r = $c;
		$g = $x;
		$b = 0;
	} else if ( $h < 120 ) {
		$r = $x;
		$g = $c;
		$b = 0;			
	} else if ( $h < 180 ) {
		$r = 0;
		$g = $c;
		$b = $x;					
	} else if ( $h < 240 ) {
		$r = 0;
		$g = $x;
		$b = $c;
	} else if ( $h < 300 ) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}

	$r = ( $r + $m ) * 255;
	$g = ( $g + $m ) * 255;
	$b = ( $b + $m  ) * 255;

    return array( floor( $r ), floor( $g ), floor( $b ) );
}
?>