<?php

// Registramos una ruta nueva para la rest api
function get_transactions_by_user_id(){
    register_rest_route( 'devlane', 'get/transactions/by/user/id/(?P<user_id>\d+)',
        array(
            'methods' => 'GET', 
            'callback' => 'callback_get_transactions_by_user_id'
        )
    );
}
add_action('rest_api_init', 'get_transactions_by_user_id');

// Callback
function callback_get_transactions_by_user_id($data){

    $JSON = array();

    $JSON['user_id'] = $data['user_id'];

    $args = array(
    'post_type' => 'transactions',
    'author' => $data['user_id']
    );

    // Realizamos la consulta
    $transactions_by_user = new WP_Query($args);

    // Procesamos los datos
    if( $transactions_by_user->have_posts() ){
        while( $transactions_by_user->have_posts() ) {

            // Seleccionar el post (en cada vuelta pasa al post siguiente)
            $transactions_by_user->the_post();
            
            $transaction_info = array();
            $transaction_info['transaction_id'] = get_the_ID();
            
            // Pillar los datos básicos del post
            $transaction_info['transaction_stripe_id'] = get_the_title();

            // Pillar metadatos
            $transaction_info['transaction_email'] = get_post_meta( get_the_ID(), 'transaction_email', true);
            $transaction_info['transaction_name'] = get_post_meta( get_the_ID(), 'transaction_name', true);
            $transaction_info['transaction_amount'] = get_post_meta( get_the_ID(), 'transaction_amount', true);
            $transaction_info['transaction_type'] = get_post_meta( get_the_ID(), 'transaction_type', true);

            $JSON['transactions'][] = $transaction_info;

        }
        wp_reset_postdata();

    }

    return new WP_REST_Response( $JSON, 200 );

}