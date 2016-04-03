<?php
add_action('init','deregister_infinitive_cpts',99);
function deregister_infinitive_cpts(){
	unregister_post_type('msd_publication');
	unregister_post_type('msd_casestudy');
	unregister_post_type('msd_news');
}

if ( ! function_exists( 'unregister_post_type' ) ) :
function unregister_post_type( $post_type ) {
    global $wp_post_types;
    if ( isset( $wp_post_types[ $post_type ] ) ) {
        unset( $wp_post_types[ $post_type ] );
        return true;
    }
    return false;
}
endif;
if ( ! function_exists( 'do_subtitle' ) ) :
function do_subtitle( $post_id = FALSE ) {
    if(!$post_id){
        global $post;
        $post_id = $post->ID;
    }
    global $subtitle;
    $subtitle->the_meta($post_id);
    print '<h2 class="subtitle">'.$subtitle->get_the_value('subtitle').'</h2>';
}
endif;