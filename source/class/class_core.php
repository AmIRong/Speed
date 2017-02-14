<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: class_core.php 33982 2013-09-12 06:36:35Z hypowang $
 */

error_reporting(E_ALL);

define('IN_DISCUZ', true);
define('DISCUZ_ROOT', substr(dirname(__FILE__), 0, -12));
define('DISCUZ_CORE_DEBUG', false);
define('DISCUZ_TABLE_EXTENDABLE', false);

set_exception_handler(array('core', 'handleException'));

if(DISCUZ_CORE_DEBUG) {
	set_error_handler(array('core', 'handleError'));
	register_shutdown_function(array('core', 'handleShutdown'));
}

if(function_exists('spl_autoload_register')) {
	spl_autoload_register(array('core', 'autoload'));
} else {
	function __autoload($class) {
		return core::autoload($class);
	}
}

C::creatapp();

class core
{	
    private static $_tables;
	private static $_imports;
	private static $_app;
	private static $_memory;
    
	public static function creatapp() {
	    if(!is_object(self::$_app)) {
	        self::$_app = discuz_application::instance();
	    }
	    return self::$_app;
	}
}

class C extends core {}
class DB extends discuz_database {}

?>