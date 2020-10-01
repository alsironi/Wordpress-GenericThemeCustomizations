<?php

// ------------ CUSTOM POST TYPES ------------

// POST TYPE para WP THEMES
function afz_webs_cpt(){
register_post_type( 'wpthemes',
    array(
    'labels'        => array(
                      'name'           => 'WP Themes',
                      'singular_name'  => 'WP Theme'
                      ),
    'supports'      => array(
                      'title',
					  'author'
                      ),
    'public'        => true,
    'has_archive'   => false,
    'rewrite'       => array('slug' => 'wptheme'),
    'menu_position' => 4,
    'menu_icon'     => 'dashicons-welcome-view-site'
    )
);
}
add_action( 'init', 'afz_webs_cpt' );


// POST TYPE para THEME PARTS
function afz_webpart_cpt(){
	register_post_type( 'themeparts',
		array(
		'labels'        => array(
						  'name'           => 'Theme parts',
						  'singular_name'  => 'Theme part'
						  ),
		'supports'      => array(
						  'title',
						  'author'
                          ),
        'taxonomies'    => array( 'category' ),
		'public'        => true,
		'has_archive'   => false,
		'rewrite'       => array('slug' => 'themepart'),
		'menu_position' => 4,
		'menu_icon'     => 'dashicons-admin-page'
		)
	);
}
add_action( 'init', 'afz_webpart_cpt' );


// META BOXES
function afz_add_webparts_metaboxes(){

    add_meta_box(
        'afz_metabox_webpart_html',       // Id
        'HTML',                           // Title
        'afz_metabox_webpart_html',       // Callback
        'webparts',                       // CPT
        'normal',                           // Where
        'default'                         // Load priority
    );

}
add_action( 'add_meta_boxes', 'afz_add_webparts_metaboxes' );


// Render name metabox
function afz_metabox_webpart_html(){
    global $post;
        
    // Get the data if it's already been entered
    $webpart_html = get_post_meta( $post->ID, 'webpart_html', true );
    if(!$webpart_html){ $webpart_html = ''; }

    // Input
    echo '<pre>'. htmlentities($webpart_html) .'</pre>';
}


// ADD COLUMNS TO BACK END LISTING

// Add the custom columns to the wpthemes post type:
add_filter( 'manage_wpthemes_posts_columns', 'afz_set_custom_wpthemes_columns' );
function afz_set_custom_wpthemes_columns($columns){

    unset( $columns['date'] ); // Unset and set again to keep it the last
    $columns['price'] = 'Price';
    $columns['payment_status'] = 'Payment status';
    $columns['date'] = 'Date';

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_wpthemes_posts_custom_column' , 'afz_custom_wpthemes_columns', 10, 2 );
function afz_custom_wpthemes_columns( $column, $post_id ){

    switch ( $column ){
        case 'price' :
            echo (get_post_meta( $post_id , 'price' , true ) / 100) . '€';
        break;
        case 'payment_status':
            $paid = get_post_meta( $post_id , 'paid' , true );
            if(metadata_exists('wpthemes', $post_id , 'payment_id')){
                echo '<span style="color:green;">'.get_post_meta( $post_id , 'payment_id' , true ).'</span>';
            }else{
                echo '<span style="color:red;">Unpaid</span>';
            }
        break;
    }

}

?>