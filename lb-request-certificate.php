<?php

/*
 * Plugin Name: LB Request Certificate
 * Description: Request and Download Certificate based on your ID (brazilian CPF) number
 *  Version: 1.0.0
 * Author: Lucas Bacciotti Moreira
*/

//=================================================
// Security: Abort if this file is called directly
//=================================================
if (!defined('ABSPATH')) {
    die;
}

//=================================================
// Absolute path
//=================================================
define('LB_REQUEST_CERTIFICATE_PLUGIN_DIR', plugin_dir_path(__FILE__));

//=================================================
// Includes
//=================================================
require_once LB_REQUEST_CERTIFICATE_PLUGIN_DIR . '/includes/lb_request_certificate_settings.php';
require_once LB_REQUEST_CERTIFICATE_PLUGIN_DIR . '/includes/lb_request_certificate_scripts.php';
