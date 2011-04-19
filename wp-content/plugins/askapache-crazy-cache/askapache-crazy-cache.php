<?php
/*
Plugin Name: AskApache Crazy Cache
Plugin URI: http://www.askapache.com/wordpress/crazy-cache-wordpress-plugin.html
Description: Caches Entire Site for WP-Cache, WP-Super-Cache, and Hyper-Cache.  <a href="options-general.php?page=askapache-crazy-cache.php">Options configuration panel</a>
Version: 2.0
Author: AskApache
Author URI: http://www.askapache.com
*/

/*
== Installation ==

1. Upload askapache-crazy-cache.zip to the /wp-content/plugins/ directory
2. Unzip into its own folder /wp-content/plugins/askapache-crazy-cache/askapache-crazy-cache.php
3. Activate the plugin through the 'Plugins' menu in WordPress by clicking "AskApache Crazy Cache"
4. Go to your Options Panel and open the "AA Crazy Cache" submenu. /wp-admin/options-general.php?page=askapache-crazy-cache.php
*/


/*
/--------------------------------------------------------------------\
|                                                                    |
| License: GPL                                                       |
|                                                                    |
| AskApache Crazy Cache Plugin - Caches Entire Site                  |
| Copyright (C) 2008, AskApache, www.askapache.com                   |
| All rights reserved.                                               |
|                                                                    |
| This program is free software; you can redistribute it and/or      |
| modify it under the terms of the GNU General Public License        |
| as published by the Free Software Foundation; either version 2     |
| of the License, or (at your option) any later version.             |
|                                                                    |
| This program is distributed in the hope that it will be useful,    |
| but WITHOUT ANY WARRANTY; without even the implied warranty of     |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the      |
| GNU General Public License for more details.                       |
|                                                                    |
| You should have received a copy of the GNU General Public License  |
| along with this program; if not, write to the                      |
| Free Software Foundation, Inc.                                     |
| 51 Franklin Street, Fifth Floor                                    |
| Boston, MA  02110-1301, USA                                        |   
|                                                                    |
\--------------------------------------------------------------------/
*/
if(!@defined('AA_CC_MAX_TIME'))define( 'AA_CC_MAX_TIME', 500 );
if(!@defined('AA_CC_SOCKET_TIME'))define( 'AA_CC_SOCKET_TIME', 40 );
if(!@defined('AA_CC_CONNECT_TIME'))define( 'AA_CC_CONNECT_TIME', 5 );

// aa_cache_all_options_setup
//---------------------------
function aa_cache_all_options_setup() {
    global $aa_CA;
    add_options_page($aa_CA['plugin']['Name'], 'AA Crazy Cache', 8, basename(__FILE__), 'aa_cache_all_page');
}//=====================================================================================





//aa_cache_admin_header
//---------------------------
function aa_cache_admin_header(){
    global $wpdb, $aa_CA, $aa_cc_valid_nonce;
    $aa_CA=get_option('askapache_crazy_cache');
	
    if (! user_can_access_admin_page()) die( __('You do not have sufficient permissions to access this page.') );
    if (!current_user_can(8)||!current_user_can('upload_files'))die(__("You are not allowed to be here without upload permissions"));
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $aa_cc_valid_nonce = wp_verify_nonce($_REQUEST['_wpnonce'], 'askapache-crazy-cache-update_modify');
        if(!$aa_cc_valid_nonce)die(__('Cheatin&#8217; uh?'));
		update_option('askapache_crazy_cache',$aa_CA);
    }
    
    
}//=====================================================================================






// aa_cache_all_page
//---------------------------
function aa_cache_all_page() {
    global $wpdb, $aa_CA, $aa_cc_valid_nonce;
    $f=array();
    echo '<p style="text-align:center; font-size:1.1em; background-color:#E4F2FD; border-top:1px solid #CCC; padding-top:10px; border-bottom:1px solid #CCC; padding-bottom:10px;"> '.$aa_CA['plugin']['Title'].' <strong>'.$aa_CA['plugin']['Version'] . '</strong> by '.$aa_CA['plugin']['Author'].' &nbsp;&nbsp;&nbsp;|&nbsp; <a href="http://www.askapache.com/seo/404-google-wordpress-plugin.html">Google 404 SEO Plugin</a> - <a href="http://www.askapache.com/htaccess/apache-htaccess.html">.htaccess examples</a> - <a href="http://www.htaccesselite.com/">.htaccess help forum</a> </p><hr style="visibility:hidden;" />';
    echo '<div class="wrap"><h2>'.$aa_CA['plugin']['Name'].'</h2> <hr style="visibility:hidden;">';
	
	if($_SERVER['REQUEST_METHOD']==='POST'){
    ?>
    <div class="wrap">
    <?php
		clearstatcache();
        if(isset($_POST['aaccbgcacheall']))				aa_cc_background_cacheall();
		else if(isset($_POST['aaccdeletesupercache'])) 	aa_cc_clean_cache('supercache');
		else if(isset($_POST['aaccdeletewpcache']))		aa_cc_clean_cache('wpcache');
		else if(isset($_POST['aaccdeletehypercache']))	aa_cc_clean_cache('hypercache');
		else if(isset($_POST['aaccdeletecache'])) 		aa_cc_clean_cache('all');
        else if(isset($_POST['aacclistcache']))			$f=aa_cc_list_cache(ABSPATH.'wp-content/cache/');
        else if(isset($_POST['aaccruntests']))			aa_cc_run_tests($aa_CA['cachedir']);
    	?>
        </div>
		<?php 
    } 
	$supersiz=aa_cc_count_cache(ABSPATH.'wp-content/cache/supercache/');
	$wpcachesiz=aa_cc_count_cache(ABSPATH.'wp-content/cache/meta/');
	$hcachesiz=aa_cc_count_cache(ABSPATH.'wp-content/cache/hyper-cache/');
	echo '<pre>';
	if(sizeof($supersiz)>2)echo sizeof($supersiz)." supercache cached files\n";
	if(sizeof($wpcachesiz)>2)echo sizeof($wpcachesiz)." wpcache cached files\n";
	if(sizeof($hcachesiz)>2)echo sizeof($hcachesiz)." hypercache cached files\n";
	echo '</pre>';

    
    ?>
    <form name="wp_aa_cacheall" action="<?php echo attribute_escape($_SERVER["REQUEST_URI"]); ?>" method="post"><?php wp_nonce_field('askapache-crazy-cache-update_modify'); ?>
    <fieldset class="options">
    <legend>Crazy Cache Tools</legend>
    <p><strong>Caching takes place in the background every hour as fast as your server will allow me to work.</strong>.</p>
    <p>This version caches all category pages, single posts, and pages.  Automatically recaches expired files, and won't hog your servers resources.</p>
    <div class="submit">
    <input type="submit" id="aaccbgcacheall" name="aaccbgcacheall" value="Cache Entire Site" />&nbsp;&nbsp;
    <input type="submit" id="aacclistcache" name="aacclistcache" value="List Entire Cache" />&nbsp;&nbsp;
    <input type="submit" id="aaccdeletecache" name="aaccdeletecache" value="Delete Entire Cache" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" id="aaccdeletewpcache" name="aaccdeletewpcache" value="Delete WP-Cache" />&nbsp;&nbsp;
    <input type="submit" id="aaccdeletesupercache" name="aaccdeletesupercache" value="Delete WP-Super-Cache" />&nbsp;&nbsp;
    <input type="submit" id="aaccdeletehypercache" name="aaccdeletehypercache" value="Delete Hyper-Cache" />
    </div>
    </fieldset>
    </form>
    
    <?php if(isset($_POST['aacclistcache'])){echo '<pre>';print_r($f);echo '</pre>';} ?>
    
    </div>

    <?php
    
}//=====================================================================================






//---------------------------
function aa_cc_background_cacheall(){
    $backend = ABSPATH.'askapache-crazy-cache-backend.php';
	$e='eNq9V+1v2zYT/+wC/R+uhjFJmywnBYqmTpXGc72lWNsUSfaGriBoiZK5SKRKSnXcNv/7jqTkl8QF+uV5DBgmj/f64/Hu/PxFtagePuCZ/+g0ZRkXLPW9yc+X'.
	'7yZXZ14QnCr2seGKESkS5qdcCVoyn5BfXr2eERJE3mhZDRMpMp5HqMgLju/qevkz+f1ydmF0cZEUTdrqam1EHipoD7RRls6/oWgyIdMpeTP5i1y9ejO759u2'.
	'PnSoZqIeVUWTc6FHVF/TiiYLNkwU/bwaJma9n7pr/JsedxbM0qnYwiAYWBop6Q2pecnip48PDlDlwwcDSkmSkE+04CkRRmu8rMgnpni2cnt/QH6dXb33yLKy'.
	'e+9DCN5eT4dzmlwzkbbegg+P7quHIOXM9y6lUiuYy6aGZEFDmOjriVUImq40rGQDVDEQsgZaFHLJUqglzBksmGKRtYDMyTWhackFUSxDuvK/w7GHD055LiTe'.
	'UqOZInQuVe3XqmHm8FSz2iJECl7y2t+9YsuhWM51jZJ60dSpXAqSNSKpuRRo3UabFIwKa6sNX9cxVYquiG5Kn91UhUwRAvBCKHmipLHnPIDAeYhixuVcyUak'.
	'JEEEtO9OOluwl+XLwweAn7yQc1rA2npoVtNJOFhW6Ty8kwuotseShYR+9I/omx0m2ibJ/3w3nUzPZmfnNsMHVDcVU7Hx1goWmkFHzCjujp0LzmKcI5yyasHp'.
	'robYqyHWDQuTFah5ZdgXUtfzlX3UA4LP9I/ZxXvv7OrqHTk7v7zyPmz4qUL22Aeu8dLuMF8iI/zwA+ha1dKkj9rDEMeeFB4E8AI8rYvxaORFxg0YW286Q4u6'.
	'rohyN+h7Z+jfGJBxn3Oh9zvm1HCS40scwxv5mRcFHT2JDsBfJ/joGH4yKtHccrmM1qhEiSxHgRd6kyRhFYrX7KYe3ZRFSKuq4Ak1KN7fL+qy+MlQLbvZHX+M'.
	'D6Jnbl8VlAtLOAp/HP1oV0/WNoavqcgbmrMxMDFsdMjEXY6ZSGTKRT7GpyjYhj5dUIWwj+HV5fnw6OjJs+Fh2NTZ8MgqeBo6U09RYCqFYDZnx5AUUhslF+65'.
	'juGbQGzyIo8H5apC1HV7BcEx3oksWbWTXYaCQj1MSsy9JHESNuOHJ4YxkYXfv5y9nk2v4NVL+OXi/A20x5YX/jybXczArPHJ0LrREINXNfOC64UHk7cv3Vm9'.
	'qpg9wc0WuaJaL6VKzdEWOaU1I3lZw3Ok9yGCvDQk3/t7WA5TOBvz8ZNnXoAHfa9vYu5lWJoQBn8TBVANg4rHJwOepsEXXKMRzGyseni/pkJbOLAsY0UxoeJj'.
	'LLHiimvfSiBg+KRRoGDCH1TByWHQQfr+QzyojuF2jRomw/8WNTTwLdT2xW/8+T/Gj69K27TCAl9qv497lku16ocu9/oLjs2XlVW96scnpgqGSGKKqmSBT7JA'.
	'oq2Cwf1QjGobCS6+J4jONHGB4HZ4Yrwi/DsjMq/HzAxcE+d8xxJ8/ar5ZyazDeX5Y9eWEypqwMqfmg6s7B3p9VNch9NKuXsJvuy6chDgm3Ve3JqOtS3pumCy'.
	'aExEeXiIvEZHowrd9a4tdvDtiWXhEJ9YRsPX63Udy/arnulYbROyapDSG2S8YHE3IfW3JiQ3a1lut+zvL+aRMYfzJKLBbiJTWT1nrdW9fXke9o7Qw689Clo+'.
	'dMtsCbvBiUH77qwNALWUpv1iFhiyXfs70piROYstPRg65u7ExpszeA53mnlgguSiWXPaBm3BMgJR/wSD3RWJ+oijNWxlEP5e79ZK37b7zcXYgqzmMl3FAyxj'.
	'NPZaSNomyZJPZMFoyhQWkaziIosHKlnX7V1FGATYxwJxHONdZ+ZFnGZaJteyMsnkOnwIm9txv+Td+YVptjBgSgnpfvE2cIq049r0/O1brFduZAvg61cwb0Ax'.
	'jSltHlpWIdXNRmtrBFX4rb5W3V1/LZRfdmnm4zQZKJUpgThNdjd4iloYLUk3VOK0a6x3fl6eT3+bXa0ny7t6O0w/riH1cBA3o4fNSzCpOjqMDryo/4/C0S36'.
	'V3Lhu3XYSdvOYkiWvMeK/VeRLRWvmfPtntkQutd99yQIXNVw4oCwSeXc6xBYLjCvzB+BzJYbRN5MZRvEiLz2d/GTlR9Ypkcugd575iQliB2ObHvgt1CZZIxM'.
	'9iDeKdqzkRwdPnsM+5C1Ila7ybj2kkzNLVlNTcum1tU9krf3SaeZnWr2SWxxt0v8sUXxxcl/5+eRTg==';
    if(file_exists($backend)){
		$mtime = filemtime($backend);
		$age=time()-$mtime;
		if($age < AA_CC_MAX_TIME){
			echo '<p>Already Working...</p>';
			return true;
		}
		else echo "<p>Beginning To Cache Entire Site</p>";
	}

    
    if(aa_cc_unlink($backend))aa_cc_file_put_c($backend,gzuncompress(base64_decode($e)));
    wp_schedule_single_event(time()+AA_CC_MAX_TIME,'aa_cc_clean');
    $cookie=AUTH_COOKIE.'='.urlencode($_COOKIE[AUTH_COOKIE]);
    $path=wp_nonce_url("askapache-crazy-cache-backend.php", 'askapache-crazy-cache-backend');
    $ref='http://www.askapache.com';
    $useragent='Mozilla/5.0 (compatible; AskApache/'.$aa_CA['plugin']['Version'].'; +http://www.askapache.com/wordpress/crazy-cache-wordpress-plugin.html)';
    $port=$_SERVER['SERVER_PORT'];
    $ip=gethostbyname($_SERVER['HTTP_HOST']);
    $scheme=((isset($_SERVER['HTTPS'] ) && strtolower($_SERVER['HTTPS']) == 'on') || $_SERVER['SERVER_PORT']=='443' ) ? 'ssl://' : '';
    if(false===($fp = fsockopen($scheme.$ip, $port, $errno, $errstr, AA_CC_CONNECT_TIME))) aa_cc_fsockopen_err($errno,$errstr);
	else {
        if(!@fputs($fp, "GET /$path HTTP/1.0\r\nHost: ".$_SERVER['HTTP_HOST']."\r\nUser-Agent: $useragent\r\nReferer: $ref\r\nAccept: */*\r\nCookie: $cookie\r\nConnection: close\r\n\r\n")) return false;
        else $g=@fgets($fp,2);
        @fclose($fp);
    }
    
    return true;
}//=====================================================================================




// aa_cc_unlink
//---------------------------
function aa_cc_unlink($f) {
    if(! @file_exists($f) )return true;
    if( @chmod($f,0777) && @unlink($f) )return true;
    $stat = @stat(@dirname($f)); $dp = $stat['mode'] & 0007777;
    if( @chmod(dirname($f),$dp) && @unlink($f) && @chmod(dirname($f),$stat['mode']))return true;
	if(! @file_exists($f) )return true;
    else return false;
}//=====================================================================================


// aa_cc_file_put_c
//---------------------------
function aa_cc_file_put_c($filename,$content){
	$c=false;
    if (function_exists("file_put_contents")) return @ file_put_contents($filename, $content);
    if(false === ($fh = @fopen($filename, 'wb'))) return false;
	$c=@fwrite($fh, $content, strlen($content));
    if(!@fclose($fh))die('couldnt fclose!');
    return $c;
}//=====================================================================================



//---------------------------
function aa_cc_time_ok($t=0) {
    global $aa_cc_st;
	$pa=array_sum(explode(' ', microtime(true) ));
	$total=$aa_cc_st-$pa;
	if( $t > AA_CC_SOCKET_TIME ) {
		echo 'killed script.. socket too long '.$t;
		return false;
	}
    if( $total > AA_CC_MAX_TIME ) {
		die('killed script.. max too long '.$total);
		return false;
	}
   return true;
}//=====================================================================================

//---------------------------
function aa_cc_timer_start() {
	global $aa_cc_timestart;
	$aa_cc_timestart = array_sum(explode(' ', microtime(true) ));
	return true;
}//=====================================================================================

//---------------------------
function aa_cc_timer_stop() {
	global $aa_cc_timestart, $aa_cc_timeend;
	$aa_cc_timeend = array_sum(explode(' ', microtime(true) ));
	$timetotal = $aa_cc_timeend-$aa_cc_timestart;
	$r = number_format($timetotal, 3);
	return $r;
}//=====================================================================================

//---------------------------
function aa_cc_fsockopen_err($errno,$errstr){
    switch($errno){
        case -3: $err="socket creation failed (-3)";
        case -4: $err="dns lookup failure (-4)";
        case -5: $err="connection refused or timed out (-5)";
        default: $err="connection failed (".$errno.")";
    }
    print_r('bad fsockopen!'."\n(".$errno.") ".$err.$errstr);
}//=====================================================================================





//---------------------------
function aa_cc_rmdir($file) {
	$file=rtrim($file,'/');
	if(strpos($file,ABSPATH.'wp-content/cache')!==false){
    if (is_dir($file) && !is_link($file)) {
		$d=dir($file);
    	while( false!==($r=$d->read())) {
        	if($r=="."||$r==".htaccess"||$r==".."||is_link($d->path.$r))continue;
			if ( !aa_cc_rmdir($d->path.'/'.$r) ) {echo "Failed to remove ".$d->path.'/'.$r."\n";sleep(1); aa_cc_rmdir($d->path.'/'.$r);}
    	}
		$d->close();
        return @rmdir($file);
    } else return @unlink($file);
	} else error_log("Bad $file");
}//=====================================================================================


//---------------------------
function aa_cc_clean_cache($cleanwhat='all'){
	switch($cleanwhat){
		case 'all':
			if(is_dir(ABSPATH.'wp-content/cache.old/'))aa_cc_rmdir(ABSPATH.'wp-content/cache.old/');
			if(rename(ABSPATH.'wp-content/cache/', ABSPATH.'wp-content/cache.old/')) aa_cc_rmdir(ABSPATH.'wp-content/cache.old/');
			else aa_cc_rmdir(ABSPATH.'wp-content/cache/');
		break;
		case 'hypercache':
			if(is_dir(ABSPATH.'wp-content/cache/hyper-cache.old/'))aa_cc_rmdir(ABSPATH.'wp-content/cache/hyper-cache.old/');
			if(rename(ABSPATH.'wp-content/cache/hyper-cache/', ABSPATH.'wp-content/cache/hyper-cache.old/')) aa_cc_rmdir(ABSPATH.'wp-content/cache/hyper-cache.old/');
			else aa_cc_rmdir(ABSPATH.'wp-content/cache/hyper-cache/');
		break;
		case 'wpcache':
			if(is_dir(ABSPATH.'wp-content/cache/meta.old/'))aa_cc_rmdir(ABSPATH.'wp-content/cache/meta.old/');
			if(rename(ABSPATH.'wp-content/cache/meta/',ABSPATH.'wp-content/cache/meta.old/'))aa_cc_rmdir(ABSPATH.'wp-content/cache/meta.old/');
			else aa_cc_rmdir(ABSPATH.'wp-content/cache/meta/');
			$d=dir(ABSPATH.'wp-content/cache/');
    		while( false!==($r=$d->read())) {
        		if($r=='.htaccess'||$r=="."||$r==".."||is_link($d->path.$r)||strpos($r,'wp-cache-')===false)continue;
			    else @unlink($d->path.$r);
    		}
			$d->close();
		break;
		case 'supercache':
			if(is_dir(ABSPATH.'wp-content/cache/supercache.old/'))aa_cc_rmdir(ABSPATH.'wp-content/cache/supercache.old/');
			if(rename(ABSPATH.'wp-content/cache/supercache/',ABSPATH.'wp-content/cache/supercache.old/'))aa_cc_rmdir(ABSPATH.'wp-content/cache/supercache.old/');
			else aa_cc_rmdir(ABSPATH.'wp-content/cache/supercache/');
		break;
	}
}//=====================================================================================




//---------------------------
function aa_cc_list_cache($dir,$files=array()) {
    if (is_dir($dir) && !is_link($dir)) {
	$d=dir($dir);
    while( false!==($r=$d->read())) {
        if($r=='.htaccess'||$r=="."||$r==".."||is_link($d->path.$r))continue;
		$dp=$d->path.$r;
        if( is_dir($d->path.$r.'/') ) {
			$files[]=str_replace(ABSPATH,'/',$d->path.$r.'/');
			$files=aa_cc_list_cache($d->path.$r.'/',$files);
		}
		else $files[]=str_replace(ABSPATH,'/',$d->path.$r);
    }
	$d->close();
	ksort($files);
	}
	return $files;
}//=====================================================================================


function aa_cc_clean(){
	aa_cc_unlink(ABSPATH.'askapache-crazy-cache-backend.php');
}

//---------------------------
function aa_cc_count_cache($dir,$files=array()) {
	$dir=rtrim($dir,'/');
	if (is_dir($dir) && !is_link($dir)) {
    $d=dir($dir);
    while( false!==($r=$d->read())) {
        if($r=='.htaccess'||$r=="."||$r==".."||is_link($d->path.'/'.$r))continue;
        if( is_dir($d->path.'/'.$r.'/') ) $files=aa_cc_list_cache($d->path.'/'.$r.'/',$files);
		else $files[]=str_replace(ABSPATH,'/',$d->path.'/'.$r);
    }
	$d->close();
	}
	return $files;
}//=====================================================================================





// aa_cache_all_deactivate
//---------------------------
function aa_cache_all_deactivate(){
    delete_option('askapache_crazy_cache');
	aa_cc_unlink(ABSPATH.'askapache-crazy-cache-backend.php');
    wp_clear_scheduled_hook('aa_cc_background_cacheall_hook');
}//=====================================================================================



// aa_cache_all_activate
//---------------------------
function aa_cache_all_activate(){
    global $aa_CA;
    $aa_CA['plugin'] = get_plugin_data(__FILE__);
    update_option('askapache_crazy_cache',$aa_CA);
    if (!wp_next_scheduled('aa_cc_background_cacheall_hook'))wp_schedule_event( time(), 'hourly', 'aa_cc_background_cacheall_hook' );
}//=====================================================================================


register_activation_hook(__FILE__, 'aa_cache_all_activate');
register_deactivation_hook(__FILE__, 'aa_cache_all_deactivate');

if( strpos($_SERVER['REQUEST_URI'], basename(__FILE__))!==false ) add_action('admin_head', 'aa_cache_admin_header');
add_action('admin_menu', 'aa_cache_all_options_setup');
add_action( 'aa_cc_background_cacheall_hook', 'aa_cc_background_cacheall' );
?>