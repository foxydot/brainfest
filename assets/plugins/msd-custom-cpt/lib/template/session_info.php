<?php
global $speaker_title,$speakers,$tracks;
    for($i=2013;$i<=(int) date("Y")+1;$i++){ $years[] = $i; } 
    $tracks = get_terms('msd_track',array('hide_empty'=> false,'orderby'=> 'id' ));
    $timeslots = get_terms('msd_timeslot',array('hide_empty'=> false,'orderby'=> 'id' ));
	$args = array( 'post_type' => 'msd_speaker', 'numberposts' => -1, 'orderby'=> 'menu_order', 'meta_query' => array(
        array(
            'key' => '_msd_event-year',
            'value' => serialize(strval((int) date("Y"))),
            'compare' => 'LIKE'
        )
    ));
	$speakers = get_posts($args); 
	?>
<div class="my_meta_control">
    <label>Event Year(s)</label>
        <p>
        <?php 
            foreach($years AS $year){
                $mb->the_field('event-year'); ?>
                <div style="display: inline-block;width: 20%;"><input type="checkbox" name="<?php $mb->the_name(); ?>[]" value="<?php echo $year; ?>"<?php $mb->the_checkbox_state($year); ?>/> <?php echo $year; ?></div>
          <?php  } ?>
        </p>
 		<p><label>Panelists/Speakers</label>
 		<div style="-moz-column-count: 3;
        -moz-column-gap: 20px;
        -webkit-column-count: 3;
        -webkit-column-gap: 20px;
        column-count: 3;
		column-gap: 20px;">
			<?php 
    foreach($speakers AS $speaker){
		$mb->the_field('speaker',WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI);
     	 print '
     	<input type="checkbox" name="'.$mb->get_the_name().'" value="'.$speaker->ID.'" '.$mb->get_the_checkbox_state($speaker->ID).'> '.$speaker->post_title.'<br />'; 
     }
			?>
			</div>
		</p>
 		<p><label>Moderator(s)</label>
 		<div style="-moz-column-count: 3;
        -moz-column-gap: 20px;
        -webkit-column-count: 3;
        -webkit-column-gap: 20px;
        column-count: 3;
		column-gap: 20px;">
			<?php 
    foreach($speakers AS $speaker){
		$mb->the_field('moderator',WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI); 
     	 print '
     	<input type="checkbox" name="'.$mb->get_the_name().'" value="'.$speaker->ID.'" '.$mb->get_the_checkbox_state($speaker->ID).'> '.$speaker->post_title.'<br />';
     }
			?>
			</div>
		</p>
		<?php $mb->the_field('track'); ?>
 		<p><label>Track</label>
		<select name="<?php $mb->the_name(); ?>">
			<option>Select Track</option>
			<option value='all'<?php selected('all',$mb->get_the_value()) ?>>All</option>
			<?php 
    foreach($tracks AS $track){
     	 print '
     	<option value="'.$track->term_id.'"'.selected($track->term_id,$mb->get_the_value()).'>'.$track->name.'</option>';
     }
			?>
		</select></p>
		<?php $mb->the_field('timeslot'); ?>
 		<p><label>Timeslot</label>
		<select name="<?php $mb->the_name(); ?>">
			<option>Select Timeslot</option>
			<?php 
    foreach($timeslots AS $timeslot){
     	 print '
     	<option value="'.$timeslot->term_id.'"'.selected($timeslot->term_id,$mb->get_the_value()).'>'.$timeslot->name.'</option>';
     }
			?>
		</select></p>
 </div>