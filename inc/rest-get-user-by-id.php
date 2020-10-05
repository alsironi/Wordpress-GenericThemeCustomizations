<?php

// Registramos una ruta nueva para la rest api
function get_user_by_id(){
    register_rest_route( 'devlane', 'get/user/by/id/(?P<user_id>\d+)',
        array(
            'methods' => 'GET', 
            'callback' => 'callback_get_user_by_id'
        )
    );
}
add_action('rest_api_init', 'get_user_by_id');

// Callback
function callback_get_user_by_id($data){

    $JSON = array();

    $JSON['user_id'] = $data['user_id'];

    $JSON['user_meta'] = get_user_meta($data['user_id']);

    return new WP_REST_Response( $JSON, 200 );

}