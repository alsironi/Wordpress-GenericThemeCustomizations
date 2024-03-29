<?php
/**
* Plugin Name: Theme customizations
* Description: Bridge between generic plugins and custom stuff
* Version: 1.0.4
* Author: Devlane
* GitHub Plugin URI: https://github.com/aleonsir/negocioyweb-customizations
**/

defined('ABSPATH') || exit;

// Custom functions
require_once plugin_dir_path(__FILE__).'inc/custom-functions.php';

// Custom post types
require_once plugin_dir_path(__FILE__).'inc/custom-posts-types.php';

// Custom profile fields
require_once plugin_dir_path(__FILE__).'inc/custom-frontend-profile-fields.php';

// Create stripe customer when a new user registers
require_once plugin_dir_path(__FILE__).'inc/create-stripe-customer-on-user-registration.php';

// REST endpoints
require_once plugin_dir_path(__FILE__).'inc/rest-get-themeparts-by-wptheme-id.php';
require_once plugin_dir_path(__FILE__).'inc/rest-get-transactions-by-user-id.php';
require_once plugin_dir_path(__FILE__).'inc/rest-get-user-by-id.php';