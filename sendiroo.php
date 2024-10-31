<?php

if (!defined('ABSPATH'))
    exit;
/**
 * Plugin Name: Sendiroo
 * Plugin URI: https://es.wordpress.org/plugins/sendiroo
 * Description: Plugin para Wordpress de Sendiroo
 * Version: 1.7.3
 * Author: Sendiroo Global Logistic S.L.
 * Author URI: https://www.sendiroo.es
 * Requires at least: 4.6
 * Tested up to: 5.5.1
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html  
 * Text Domain: sendiroo
 * Domain Path: /languages
 */
global $api_server;  
global $nombre_app;
global $plugin_version;
global $id_pais_api;
global $servicio;
$wc_activado = false;
$languages_load = substr( get_bloginfo ( 'language' ), 0, 2 );
$api_server_variable = 'sendiroo.'.$languages_load;
$api_server = $api_server_variable;
$nombre_app = 'Sendiroo';
$plugin_version = '1.7.3 DC';
$plugin_cn_version = '173';
$servicio = 'wordpress';
defined('ABSPATH') or die('Error');
add_action( 'plugins_loaded', 'grupoimpultec_load_plugin_textdomain' );
include('configuracion.php');
add_action('admin_menu', 'grupoimpultec_plugin_admin_add_page');
include('orders_list.php');
include('precio_personalizado.php');
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && grupoimpultec_login($GLOBALS['api_server'], get_option('grupoimpultec_usuario_servicio'), get_option('grupoimpultec_password_servicio'))) {
    add_action('admin_menu', 'grupoimpultec_my_add_menu_items');
    add_action('admin_page', 'lista_pedidos');    
}
function grupoimpultec_load_plugin_textdomain() {
    load_plugin_textdomain( 'sendiroo', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

?>