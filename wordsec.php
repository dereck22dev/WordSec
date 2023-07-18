<?php
/*
Plugin Name: WordSec 
Plugin URI: https://github.com/dereck22dev/WordSec
Description: About
plugin wordpress simple et open source pour maximiser la securité de votre site wordpress
Author: dereck22dev
Version: 1.0
Author URI: https://github.com/dereck22dev
*/


register_activation_hook( 'activate/WordSec/wordsec.php' , 'on_ws_active')

register_deactivation_hook(
    __FILE__,
    array( $this, 'deactivate' )
);

function on_ws_active()
{
    //Désactiver débogage

    define('WP_DEBUG_LOG', '/path/outside/of/webserver/root/debug.log');

    /**
     * permet de resteindre l'API REST
     */
    function wordsec_filter_rest_api ( $result ) {
        if (!empty( $result )) {return $result;}
        
        if (!is_user_logged_in()) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 'failed', 401 ) );
        }
    
        return $result;
        
    }
    
    
    //Désactiver XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    //Restreindre l'API REST
    add_filter( 'rest_authentication_errors', 'wordsec_filter_rest_api');
    
    //Désactiver jsonp
    add_filter('rest_jsonp_enabled', '__return_false');
    
}


function on_ws_inactive()
{
    define('WP_DEBUG_LOG', '/path/outside/of/webserver/root/debug.log');

    /**
     * permet de resteindre l'API REST
     */
    function wordsec_filter_rest_api ( $result ) {
        if (!empty( $result )) {return $result;}
        
        if (!is_user_logged_in()) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 'failed', 401 ) );
        }
    
        return $result;
        
    }
    
    
    //Désactiver XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');
    
    //Restreindre l'API REST
    add_filter( 'rest_authentication_errors', 'wordsec_filter_rest_api');
    
    //Désactiver jsonp
    add_filter('rest_jsonp_enabled', '__return_false');
    
}
