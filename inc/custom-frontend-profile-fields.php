<?php

// FRONTEND PROFILE CUSTOMIZATIONS

// Add tabs (editing groups) to the profile
function afz_add_tabs_frontent_profile( $tabs ) {
	
	/* add our tab to the tabs array */
	$tabs[] = array(
		'id' => 'TABprofile',
		'label' => 'Profile',
		'tab_class' => 'profile-tab',
		'content_class' => 'profile-content',
	);
	
	/* return all the tabs */
	return $tabs;
	
}
add_filter( 'afzfp_tabs', 'afz_add_tabs_frontent_profile', 30 );

// Add fields to the tabs 1
function afz_add_fields_to_TABprofile( $fields ){
	
	$fields[] = array(
		'id' => 'F_fecha_nacimiento', 
		'label' => 'Fecha de nacimiento',
		'type' => 'text'
    );

    $fields[] = array(
		'id' => 'F_domicilio', 
		'label' => 'Domicilio',
		'type' => 'text'
    );

    $fields[] = array(
		'id' => 'F_codigo_postal', 
		'label' => 'Código postal',
		'type' => 'text'
    );

    $fields[] = array(
		'id' => 'F_localidad', 
		'label' => 'Localidad',
		'type' => 'text'
    );

    $fields[] = array(
		'id' => 'F_telefono', 
		'label' => 'Teléfono',
		'type' => 'text'
    );

	return $fields;
	
}
add_filter( 'afzfp_fields_TABprofile', 'afz_add_fields_to_TABprofile', 10 );