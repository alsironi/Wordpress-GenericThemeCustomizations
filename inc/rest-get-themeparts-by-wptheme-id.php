<?php

// Registramos una ruta nueva para la rest api
function get_themeparts_by_wptheme_id(){
    register_rest_route( 'devlane', 'get/themeparts/by/wptheme/id/(?P<wptheme_id>\d+)',
        array(
            'methods' => 'GET', 
            'callback' => 'callback_get_themeparts_by_wptheme_id'
        )
    );
}
add_action('rest_api_init', 'get_themeparts_by_wptheme_id');

// Callback
function callback_get_themeparts_by_wptheme_id($data){

    $JSON = array();

    $JSON['wptheme_id'] = $data['wptheme_id'];

    $args = array(
    'post_type' => 'themeparts',
    'meta_query' => array(
        array(
            'key' => 'theme_id',
            'value' => $data['wptheme_id'],
            'compare' => '=',
        )
    )
    );

    // Realizamos la consulta
    $themeparts_de_wptheme = new WP_Query($args);

    // Procesamos los datos
    if( $themeparts_de_wptheme->have_posts() ){
        while( $themeparts_de_wptheme->have_posts() ) {

            // Seleccionar el post (en cada vuelta pasa al post siguiente)
            $themeparts_de_wptheme->the_post();
            
            $themepart_info = array();
            $themepart_info['themepart_id'] = get_the_ID();
            
            // Pillar los datos básicos del post
            $themepart_info['themepart_titulo'] = get_the_title();

            // Pillar metadatos
            $themepart_info['themepart_html'] = get_post_meta( get_the_ID(), 'themepart_html', true);
            $themepart_info['is_included'] = get_post_meta( get_the_ID(), 'is_included', true);

            $JSON['themeparts'][] = $themepart_info;

        }
        wp_reset_postdata();

    }

    return new WP_REST_Response( $JSON, 200 );

}