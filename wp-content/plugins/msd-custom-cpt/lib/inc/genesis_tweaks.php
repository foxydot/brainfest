<?php
add_action('genesis_entry_header','msdlab_speaker_session_meta',11);
    if(!function_exists('msdlab_speaker_session_meta')){
        function msdlab_speaker_session_meta(){
            global $post, $session_info, $speakers, $speaker_title;
            $cpt = get_post_type($post->ID);
            switch($cpt){
                case 'msd_session':
                    ?>
                    <h6>
            <?php if($session_info->get_the_value('timeslot')){$timeslot = get_term($session_info->get_the_value('timeslot'),'msd_timeslot'); print $timeslot->name;} ?>
            </h6>
            <?php $hasMod = FALSE; ?>
            <?php while($session_info->have_fields('moderator')): ?>
            <?php if($session_info->is_first()){ ?>
            <h6>Moderator: 
            <?php } ?>
            <?php $speaker = get_post($session_info->get_the_value());?>
            <a href="<?php print get_permalink($speaker->ID);?>">
            <?php print $speaker->post_title; ?>
            </a>
            <?php if($session_info->is_last()){ ?>
            </h6>
            <?php } else { ?>
            , 
            <?php } ?>
            <?php $hasMod = TRUE; ?>
            <?php endwhile; ?>
            <?php while($session_info->have_fields('speaker')): ?>
            <?php if($session_info->is_first()){ ?>
                <?php if($hasMod){ ?>
                    <h6>Panelists: 
                <?php } else { ?>
                    <h6>Speakers: 
                <?php } ?>
            <?php } ?>
            <?php $speaker = get_post($session_info->get_the_value());?>
            <a href="<?php print get_permalink($speaker->ID);?>">
            <?php print $speaker->post_title; ?>
            </a>
            <?php if($session_info->is_last()){ ?>
            </h6>
            <?php } else { ?>
            , 
            <?php } ?>
            <?php endwhile; ?>
                    <?php
                    break;
            case 'msd_speaker':
                ?>
            <?php the_post_thumbnail('medium', array('class' => 'alignright')); ?>
            <?php 
            if($speaker_title->get_the_value('speaker_title')!=''): ?>
            <h6><?php $speaker_title->the_value('speaker_title'); ?></h6>
            <?php endif; ?>
            <?php if($speakers->get_the_value('focus-areas')!=''): ?>
            <p><strong>Focus Area:</strong> <?php $speakers->the_value('focus-areas'); ?></p>
            <?php endif; ?>
            <?php
            break;
            }
            
        }
    }
