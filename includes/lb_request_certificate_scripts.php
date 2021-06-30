<?php
//=================================================
// Scripts Page
//=================================================
// Enqueue CSS and JS/jQuery
//=================================================
add_action('admin_enqueue_scripts', 'lb_request_certificate_add_scripts');

function lb_request_certificate_add_scripts()
{
    wp_enqueue_script(
        'lb_request_certificate_js',
        plugin_dir_url(__FILE__) . '../js/lb_request_certificate_js.js',
        array('jquery'),
        null,
        true
    );
    wp_enqueue_style(
        'lb_certificate',
        plugin_dir_url(__FILE__) . '../css/lb_request_certificate_css.css'
    );
}
