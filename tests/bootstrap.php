<?php
/**
 * Test Bootstrap File for Nomadenstuff E-Commerce
 */

define('ENVIRONMENT', 'testing');
define('BASEPATH', __DIR__ . '/../system/');
define('APPPATH', __DIR__ . '/../application/');
define('VIEWPATH', __DIR__ . '/../application/views/');

// Load CodeIgniter Core Constants
if (file_exists(APPPATH . 'config/constants.php')) {
    require_once APPPATH . 'config/constants.php';
}

// Stub CI_Controller if needed
if (!class_exists('CI_Controller')) {
    class CI_Controller {
        private static $instance;
        public function __construct() {
            self::$instance =& $this;
        }
        public static function &get_instance() {
            return self::$instance;
        }
    }
}

// Stub CI_Model if needed
if (!class_exists('CI_Model')) {
    class CI_Model {
        public $db;
        public $session;
        public $load;
        public function __construct() {}
    }
}

// Load MY_Model & MY_Controller if not defined
if (!class_exists('MY_Model')) {
    require_once APPPATH . 'core/MY_Model.php';
}

if (!class_exists('MY_Controller')) {
    require_once APPPATH . 'core/MY_Controller.php';
}
