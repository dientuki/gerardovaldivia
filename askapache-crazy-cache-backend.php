<?php
if(!@defined('ABSPATH'))@require_once(dirname(__FILE__).'/wp-config.php');
if(!@defined('DB_USER'))@include_once(ABSPATH.'wp-includes/wp-db.php');
if(!@defined('AA_CC_MAX_TIME'))@require_once(ABSPATH.'wp-content/plugins/askapache-crazy-cache/askapache-crazy-cache.php');
if(!@include_once(ABSPATH.'wp-content/wp-cache-config.php'))$cache_max_time=7200;

$aa_cc_valid_nonce=wp_verify_nonce($_GET['_wpnonce'], 'askapache-crazy-cache-backend');
if ( !$aa_cc_valid_nonce )die('Sorry bout cha, AskApache says you are not allowed to be here.');
check_admin_referer('askapache-crazy-cache-backend');

@ignore_user_abort(true);
@set_time_limit(AA_CC_MAX_TIME);
@register_shutdown_function('aa_cc_clean');
$aa_cc_st=array_sum(explode(' ', microtime(true) ));

aa_background_calls();

function aa_background_calls(){
    global $aa_cc_st,$aa_CA,$wpdb,$cache_max_time;
	echo ".\n";
	if(@defined('WPCACHEHOME'))$asuper=true;
	else $asuper=false;
    $aa_CA=get_option('askapache_crazy_cache');
    $tip=gethostbyname($_SERVER['HTTP_HOST']);
    $target=( isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])=='on' ) ? 'ssl://'.$tip : $tip;
    $http_r=array('Host: '.$_SERVER['HTTP_HOST'],'User-Agent: Mozilla/5.0 (AskApache/; +http://www.askapache.com/)','Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,*/*;q=0.5','Accept-Language: en-us,en;q=0.5','Accept-Encoding: none','Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7','Connection: close','Referer: http://www.askapache.com/');
    $g=$myposts=array(); $homep=get_option('home');	
	$aaccposts=$wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' AND post_password = '' AND post_date_gmt <= '" . gmdate('Y-m-d H:i:59') . "'");
	foreach($aaccposts as $pi=>$idd){ $p = str_replace($homep, '', get_permalink($idd)); if(strlen($p)>1)$myposts[]=$p; }
	$aaccpages=$wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'page' AND post_password = ''");
	foreach($aaccpages as $pi=>$idd){ $p = str_replace($homep, '', get_permalink($idd)); if(strlen($p)>1)$myposts[]=$p; }
	$aacccats=get_terms("category",array("hide_empty"=>true,"hierarchical"=>false));
	foreach($aacccats as $cat){ $p = str_replace($homep, '', get_category_link($cat->term_id)); if(strlen($p)>1)$myposts[]=$p; }
    if(!is_array($myposts)||sizeof($myposts)<2)die('cant find your posts');
    foreach($myposts as $p){if(strlen($p)>0) $g[]=$p;}

    foreach(array_chunk($g,10) as $urls){
        foreach ($urls as $i => $url){
			echo ".";
			if($asuper){
 				$file=ABSPATH."wp-content/cache/supercache/".$_SERVER['HTTP_HOST'].$url.'/index.html';
				$file=str_replace('//','/',$file);
				if(file_exists($file)){
					$mtime = filemtime($file);
					$age=time()-$mtime;
					if($age < $cache_max_time)continue;
					else echo $age.">".$cache_max_time." ".$file;
		   		}
			}
		   
            $rbody=$data='';
			$http_recv_headers=$fpinf=$rc=array();
            if( false === ($fp = @fsockopen($target, $_SERVER['SERVER_PORT'], $errno, $errstr, AA_CC_CONNECT_TIME)) || !is_resource($fp)) aa_cc_fsockopen_err($errno,$errstr);
            else {
                aa_cc_timer_start();
				@stream_set_timeout($fp, AA_CC_SOCKET_TIME);
                $http_req_headers='GET '.$url.' HTTP/1.0'."\r\n".join("\r\n", $http_r) . "\r\n\r\n";
                if(!@fwrite($fp, $http_req_headers, strlen($http_req_headers)))die('fwrite error'.$url);
				while ( !feof($fp) && aa_cc_time_ok(aa_cc_timer_stop()) && !$fpinf['timed_out']){
                    $data.= @fread ( $fp, 8192 );
                    $fpinf = @stream_get_meta_data($fp);
                }
                @fclose($fp);
            }
        }
    }
}

?>