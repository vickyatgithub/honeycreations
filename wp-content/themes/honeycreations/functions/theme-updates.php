<?php
/**
 * Check for theme updates
 *
 * @package     Honey creations 
 * @since        2.0
 * @alter        2.1.3
 *
 */

// Array of theme data stored in style.css
$theme_data = get_theme_data(TEMPLATEPATH . '/style.css');

// Theme name - used for checking for updates
global $shaken_theme_name, $shaken_theme_version;
$shaken_theme_name = $theme_data['Name'];
$shaken_theme_version = $theme_data['Version'];

/*-----------------------------------------------------------------------------------
					 			Check for theme updates  
-----------------------------------------------------------------------------------*/
if( get_option('shaken_latest_version', $shaken_theme_version) > $shaken_theme_version ):
	// An update has been identified before
	add_action('admin_notices', 'shaken_update_notification');

elseif( time() >= get_option( 'shaken_next_check', time() ) ):
	// It's time to check for an update again
	if( shaken_check_version() ){
		add_action('admin_notices', 'shaken_update_notification');
	}
endif;

/** 
 * shaken_xml2array()
 * Create the XML needed to check for theme updates
 *
 * http://mysrc.blogspot.com/2007/02/php-xml-to-array-and-backwards.html
 * @since 1.0
**/
function shaken_xml2array(&$string) {
	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_parse_into_struct($parser, $string, $vals, $index);
	xml_parser_free($parser);
	$mnary=array();
	$ary=&$mnary;
	foreach ($vals as $r) {
		$t=$r['tag'];
		if ($r['type']=='open') {
			if (isset($ary[$t])) {
				if (isset($ary[$t][0])) $ary[$t][]=array(); else $ary[$t]=array($ary[$t], array());
				$cv=&$ary[$t][count($ary[$t])-1];
			} else $cv=&$ary[$t];
			if (isset($r['attributes'])) {foreach ($r['attributes'] as $k=>$v) $cv['_a'][$k]=$v;}
			$cv['_c']=array();
			$cv['_c']['_p']=&$ary;
			$ary=&$cv['_c'];
		} elseif ($r['type']=='complete') {
			if (isset($ary[$t])) { // same as open
				if (isset($ary[$t][0])) $ary[$t][]=array(); else $ary[$t]=array($ary[$t], array());
				$cv=&$ary[$t][count($ary[$t])-1];
			} else $cv=&$ary[$t];
			if (isset($r['attributes'])) {foreach ($r['attributes'] as $k=>$v) $cv['_a'][$k]=$v;}
			$cv['_v']=(isset($r['value']) ? $r['value'] : '');

		} elseif ($r['type']=='close') {
			$ary=&$ary['_p'];
		}
	}    
	_shaken_del_p($mnary);
	return $mnary;
}

///////////////////////////////////////////
// _Internal: Remove recursion in result array
///////////////////////////////////////////
function _shaken_del_p(&$ary) {
	foreach ($ary as $k=>$v) {
		if ($k==='_p') unset($ary[$k]);
		elseif (is_array($ary[$k])) _shaken_del_p($ary[$k]);
	}
}

///////////////////////////////////////////
// Array to XML
///////////////////////////////////////////
function shaken_ary2xml($cary, $d=0, $forcetag='') {
	$res=array();
	foreach ($cary as $tag=>$r) {
		if (isset($r[0])) {
			$res[]=shaken_ary2xml($r, $d, $tag);
		} else {
			if ($forcetag) $tag=$forcetag;
			$sp=str_repeat("\t", $d);
			$res[]="$sp<$tag";
			if (isset($r['_a'])) {foreach ($r['_a'] as $at=>$av) $res[]=" $at=\"$av\"";}
			$res[]=">".((isset($r['_c'])) ? "\n" : '');
			if (isset($r['_c'])) $res[]=shaken_ary2xml($r['_c'], $d+1);
			elseif (isset($r['_v'])) $res[]=$r['_v'];
			$res[]=(isset($r['_c']) ? $sp : '')."</$tag>\n";
		}
		
	}
	return implode('', $res);
}

///////////////////////////////////////////
// Insert element into array
///////////////////////////////////////////
function shaken_ins2ary(&$ary, $element, $pos) {
	$ar1=array_slice($ary, 0, $pos); $ar1[]=$element;
	$ary=array_merge($ar1, array_slice($ary, $pos));
}

/** 
 * shaken_check_version()
 * Compares the current theme's version with the version in 
 * an external XML file.
 *
 * @since 1.0
**/
function shaken_check_version(){
	
	global $shaken_theme_name, $theme_data;
	
	$version_url = "http://versions.shakenandstirredweb.com/versions.xml";
	
	$get_versions = wp_remote_get($version_url);
	if ( !is_wp_error($get_versions) && 200 == $get_versions['response']['code'] ) {
		$versions = $get_versions['body'];
	}
	
	// Set a future date to check
	$next_check = time() + (2 * 24 * 60 * 60);
	update_option('shaken_next_check', $next_check);
	
	if(isset($versions) && $versions != "" && $versions !== false){
		$versions = shaken_xml2array($versions);
		
		foreach($versions['versions']['_c']['version'] as $update){
			$latest = str_replace(".","",trim($update['_v']));
			if($update['_a']['name'] == $shaken_theme_name){
				if(str_replace(".","",$theme_data['Version']) < $latest){
					$shaken_update_version = trim($update['_v']);
					
					update_option('shaken_latest_version', $shaken_update_version);
					
					return $shaken_update_version;
				}
			}
		}
	}
	
	return false;
}

function shaken_update_notification(){
	global $shaken_theme_name, $shaken_theme_version;
	echo "<div class='updated'><p><strong>There is an update available for the $shaken_theme_name theme.</strong><br /> You are running version <strong>$shaken_theme_version</strong>. You may download the update via the download link sent to you when you purchased the theme.</p></div>";
}

?>