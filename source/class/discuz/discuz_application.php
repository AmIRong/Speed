<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: discuz_application.php 34608 2014-06-11 02:07:39Z nemohou $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class discuz_application extends discuz_base{


	var $mem = null;

	var $session = null;

	var $config = array();

	var $var = array();

	var $cachelist = array();

	var $init_db = true;
	var $init_setting = true;
	var $init_user = true;
	var $init_session = true;
	var $init_cron = true;
	var $init_misc = true;
	var $init_mobile = true;

	var $initated = false;

	var $superglobal = array(
		'GLOBALS' => 1,
		'_GET' => 1,
		'_POST' => 1,
		'_REQUEST' => 1,
		'_COOKIE' => 1,
		'_SERVER' => 1,
		'_ENV' => 1,
		'_FILES' => 1,
	);
	public function timezone_set($timeoffset = 0) {
	    if(function_exists('date_default_timezone_set')) {
	        @date_default_timezone_set('Etc/GMT'.($timeoffset > 0 ? '-' : '+').(abs($timeoffset)));
	    }
	}
	static function &instance() {
	    static $object;
	    if(empty($object)) {
	        $object = new self();
	    }
	    return $object;
	}
	public function __construct() {
	    $this->_init_env();
	    $this->_init_config();
	    $this->_init_input();
	    $this->_init_output();
	}
	private function _get_client_ip() {
	    $ip = $_SERVER['REMOTE_ADDR'];
	    if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
	        foreach ($matches[0] AS $xip) {
	            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
	                $ip = $xip;
	                break;
	            }
	        }
	    }
	    return $ip;
	}
	
}

?>