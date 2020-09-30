<?php

// Función para insertar un theme part
function insert_themepart($theme_id,$themepart_title,$themepart_html){
    wp_insert_post(array(
        'post_title' => $themepart_title,
        'post_type' => 'themeparts',
        'post_status' => 'publish',
        'meta_input' => array(
            'theme_id' => $theme_id,
            'themepart_html' => $themepart_html
            )
    ));
}

?>