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
//add_filter('genesis_footer_widget_areas','msdlab_flexible_footer_widgets');

function msdlab_flexible_footer_widgets($output, $footer_widgets){
}
