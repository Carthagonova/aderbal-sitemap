<?php
//eventos
 function lc_create_evento_aderbal() {
 // set up labels
 $labels = array (
 'name' => 'Eventos Aderbal',
 'singular_name' => 'evento',
 'add_new' => 'Añadir nuevo evento',
 'add_new_item' => 'Añadir nuevo evento',
 'edit_item' => 'Editar evento',
 'new_item' => 'Nuevo evento',
 'all_items' => 'Todos los eventos',
 'view_item' => 'Ver evento',
 'search_items' => 'Buscar eventos',
 'not_found' => 'No se han encontrado',
 'not_found_in_trash' => 'No se han encontrado eventos en la papelera',
 'parent_item_colon' => '',
 'menu_name' => 'Eventos Aderbal',
'register_meta_box_cb' => 'add_url_metaboxes',
 );
 //register post type
 register_post_type ( 'aderbal', array(
 'labels' => $labels,
 'has_archive' => true,
 'public' => true,
 'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
// 'taxonomies' => array( 'post_tag', 'category' ),
 'exclude_from_search' => false,
 'capability_type' => 'post',
//'posts_per_page' => -1,
 'rewrite' => array( 'slug' => 'eventos' ),

 )
 );
 }
 add_action( 'init', 'lc_create_evento_aderbal' );


?>
