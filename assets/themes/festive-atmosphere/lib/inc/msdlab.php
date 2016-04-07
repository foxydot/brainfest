<?php
 add_post_type_support( 'page', 'excerpt' );
 add_action('genesis_before_header','msdlab_pre_header');
/**
 * Add pre-header with social and search
 */
function msdlab_pre_header(){
    print '<div class="pre-header">
        <div class="wrap">';
           do_action('msdlab_pre_header');
    print '
        </div>
    </div>';
}

add_action( 'msdlab_pre_header', 'genesis_do_subnav',10,2);
remove_action('genesis_entry_header','genesis_post_info',12);

if(!function_exists('remove_wpautop')){
function remove_wpautop( $content ) { 
    $content = do_shortcode( shortcode_unautop( $content ) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}
}
