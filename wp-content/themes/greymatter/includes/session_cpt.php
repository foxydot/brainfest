<?php
class MSDSessionCPT {
	public function MSDSessionCPT(){
        add_action( 'init', array(&$this,'register_tax_track') );
        add_action( 'init', array(&$this,'register_tax_timeslot') );
        add_action( 'init', array(&$this,'register_cpt_session') );
		add_shortcode( 'list-sessions', array(&$this,'list_sessions') );
		add_filter( 'enter_title_here', array(&$this,'msd_change_default_title' ));
		add_action('admin_footer',array(&$this,'subtitle_footer_hook'));
		add_image_size('session_headshot',75,75,true);
	}
	
    function register_tax_track() {
    
        $labels = array( 
            'name' => _x( 'Tracks', 'session' ),
            'singular_name' => _x( 'Track', 'session' ),
            'search_items' => _x( 'Search Tracks', 'session' ),
            'popular_items' => _x( 'Popular Tracks', 'session' ),
            'all_items' => _x( 'All Tracks', 'session' ),
            'parent_item' => _x( 'Parent Track', 'session' ),
            'parent_item_colon' => _x( 'Parent Track:', 'session' ),
            'edit_item' => _x( 'Edit Track', 'session' ),
            'update_item' => _x( 'Update Track', 'session' ),
            'add_new_item' => _x( 'Add New Track', 'session' ),
            'new_item_name' => _x( 'New Track Name', 'session' ),
            'separate_items_with_commas' => _x( 'Separate Tracks with commas', 'session' ),
            'add_or_remove_items' => _x( 'Add or remove Tracks', 'session' ),
            'choose_from_most_used' => _x( 'Choose from the most used Pratice areas', 'session' ),
            'menu_name' => _x( 'Tracks', 'session' ),
        );
    
        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => false,
            'meta_box_cb' => false,
    
            'rewrite' => false,
            'query_var' => true
        );
    
        register_taxonomy( 'msd_track', array('msd_session'), $args );
    }

function register_tax_timeslot() {
    
        $labels = array( 
            'name' => _x( 'Timeslots', 'session' ),
            'singular_name' => _x( 'Timeslot', 'session' ),
            'search_items' => _x( 'Search Timeslots', 'session' ),
            'popular_items' => _x( 'Popular Timeslots', 'session' ),
            'all_items' => _x( 'All Timeslots', 'session' ),
            'parent_item' => _x( 'Parent Timeslot', 'session' ),
            'parent_item_colon' => _x( 'Parent Timeslot:', 'session' ),
            'edit_item' => _x( 'Edit Timeslot', 'session' ),
            'update_item' => _x( 'Update Timeslot', 'session' ),
            'add_new_item' => _x( 'Add New Timeslot', 'session' ),
            'new_item_name' => _x( 'New Timeslot Name', 'session' ),
            'separate_items_with_commas' => _x( 'Separate Timeslots with commas', 'session' ),
            'add_or_remove_items' => _x( 'Add or remove Timeslots', 'session' ),
            'choose_from_most_used' => _x( 'Choose from the most used Pratice areas', 'session' ),
            'menu_name' => _x( 'Timeslots', 'session' ),
        );
    
        $args = array( 
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => false,
            'meta_box_cb' => false,
    
            'rewrite' => false,
            'query_var' => true
        );
    
        register_taxonomy( 'msd_timeslot', array('msd_session'), $args );
    }

 
    
	function register_cpt_session() {
	
	    $labels = array( 
	        'name' => _x( 'Sessions', 'session' ),
	        'singular_name' => _x( 'Session', 'session' ),
	        'add_new' => _x( 'Add New', 'session' ),
	        'add_new_item' => _x( 'Add New Session', 'session' ),
	        'edit_item' => _x( 'Edit Session', 'session' ),
	        'new_item' => _x( 'New Session', 'session' ),
	        'view_item' => _x( 'View Session', 'session' ),
	        'search_items' => _x( 'Search Sessions', 'session' ),
	        'not_found' => _x( 'No session items found', 'session' ),
	        'not_found_in_trash' => _x( 'No session items found in Trash', 'session' ),
	        'parent_item_colon' => _x( 'Parent Session:', 'session' ),
	        'menu_name' => _x( 'Sessions', 'session' ),
	    );
	
	    $args = array( 
	        'labels' => $labels,
	        'hierarchical' => false,
	        'description' => 'Sessions',
	        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'page-attributes'),
	        'taxonomies' => array( 'genre' ),
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'menu_position' => 20,
	        
	        'show_in_nav_menus' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => false,
	        'has_archive' => true,
	        'query_var' => true,
	        'can_export' => true,
	        'rewrite' => array('slug'=>'session-items','with_front'=>false),
	        'capability_type' => 'post'
	    );
	
	    register_post_type( 'msd_session', $args );
	    flush_rewrite_rules();
	}
	
	function msd_change_default_title( $title ){
		$screen = get_current_screen();
	
		if  ( 'msd_session' == $screen->post_type ) {
			$title = 'Enter Session Title';
		}
	
		return $title;
	}
	
	function subtitle_footer_hook()
	{
		?><script type="text/javascript">
        jQuery('#titlediv').after(jQuery('#_subtitle_metabox'));
        jQuery('#_subtitle_metabox').after(jQuery('#_session_info_metabox'));
		</script><?php
	}
		
	function list_sessions( $atts ) {
		extract( shortcode_atts( array(
		), $atts ) );
		global $session_info,$subtitle;
        $tracks = get_terms('msd_track',array('hide_empty'=> false,'orderby'=> 'id' ));
        $timeslots = get_terms('msd_timeslot',array('hide_empty'=> false,'orderby'=> 'id', ));
		$num_tracks = count($tracks);
		$num_timeslots = count($timeslots);
		
		$args = array( 'post_type' => 'msd_session', 'numberposts' => -1, 'orderby'=> 'menu_order','meta_query' => array(
        array(
            'key' => '_msd_event-year',
            'value' => serialize(strval((int) date("Y"))),
            'compare' => 'LIKE'
        )
    ) );		
		$items = get_posts($args);
		$session_data = array();
	    foreach($items AS $item){
	        $subtitle->the_meta($item->ID);
	    	$session_info->the_meta($item->ID);
	    	$session_data[$session_info->get_the_value('timeslot')][$session_info->get_the_value('track')]['subtitle'] = $subtitle->get_the_value('subtitle');
	    	$session_data[$session_info->get_the_value('timeslot')][$session_info->get_the_value('track')]['speaker'] = get_post($session_info->get_the_value('speaker'));
	    	$session_data[$session_info->get_the_value('timeslot')][$session_info->get_the_value('track')]['post'] = $item;
	     }
		//structure table
		//table header
		$headerrow = '<tr><th></th>';
		foreach($tracks AS $track){
			$headerrow .= '<th class="track">'.$track->name.'</th>';
		}
		$headerrow .= '</tr>';
        //$table = $headerrow;
        foreach($timeslots AS $timeslot){
			$table .= '<tr>
	        		<th class="time">'.$timeslot->name.'</th>';
				foreach($tracks AS $track){
					if($session_data[$timeslot->term_id]['all']){
						$table .= '<td colspan="'.$num_tracks.'"><a style="font-weight: 700;" href="'.get_permalink($session_data[$timeslot->term_id]['all']['post']->ID).'">'.$session_data[$timeslot->term_id]['all']['post']->post_title.'</a> '.$session_data[$timeslot->term_id][$track->term_id]['subtitle'].'</td>';
						break 1;
					} else {
<<<<<<< HEAD
						$table .= '<td class="track"><a href="'.get_permalink($session_data[$timeslot->term_id][$track->term_id]['post']->ID).'">'.$session_data[$timeslot->term_id][$track->term_id]['post']->post_title.'</a></td>';
=======
						$table .= '<td class="track"><a style="font-weight: 700;" href="'.get_permalink($session_data[$timeslot->term_id][$track->term_id]['post']->ID).'">'.$session_data[$timeslot->term_id][$track->term_id]['post']->post_title.'</a>'.$session_data[$timeslot->term_id][$track->term_id]['subtitle'].'</td>';
>>>>>>> d9ae545918ae13000a3bb5f067733e9c82541b87
					}
				}
	        $table .= '</tr>';

		}
		$width = (100-$num_tracks)/($num_tracks+1);
		$style = '<style>table.agenda th.track{width:'.$width.'%;visibility: hidden;}</style>';
	    //return
		return '<table class="agenda">'.$table.'</table><div class="clear"></div>'.$style;
	}	
}
$msd_sessions = new MSDSessionCPT;


// add a custom meta box
	$session_info = new WPAlchemy_MetaBox(array
	(
		'id' => '_session_info',
		'title' => 'Session Information',
		'types' => array('msd_session'), 
		'context' => 'normal', 
		'priority' => 'high', 
		'template' => dirname(__FILE__).'/template/session_info.php',
		'mode' => WPALCHEMY_MODE_EXTRACT,
		'prefix' => '_msd_'
	));
    $subtitle = new WPAlchemy_MetaBox(array
    (
        'id' => '_subtitle',
        'title' => 'Subtitle',
        'types' => array('msd_session'), 
        'context' => 'normal', 
        'priority' => 'high', 
        'template' => dirname(__FILE__).'/template/subtitle.php',
        'mode' => WPALCHEMY_MODE_EXTRACT,
        'prefix' => '_msd_'
    ));

//$tracks = array('Business Intelligence and Big Data','Digital Analytics','Digital Advertising Solutions','Digital CRM','Risk Management');
//$timeslots = array('7:30AM - 8:45AM','8:45AM - 9:30AM','9:40AM - 10:40AM','11:00AM - 12:00PM','12:00PM - 1:20PM','1:35PM - 2:50PM','3:00PM - 4:00PM');
