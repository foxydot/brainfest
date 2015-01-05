<?php for($i=2013;$i<=(int) date("Y")+1;$i++){ $years[] = $i; } ?>
<div class="my_meta_control">
        <label>Event Year(s)</label>
        <p>
        <?php 
            foreach($years AS $year){
                $mb->the_field('event-year'); ?>
                <div style="display: inline-block;width: 20%;"><input type="checkbox" name="<?php $mb->the_name(); ?>[]" value="<?php echo $year; ?>"<?php $mb->the_checkbox_state($year); ?>/> <?php echo $year; ?></div>
          <?php  } ?>
        </p>
        <?php $mb->the_field('focus-areas'); ?>
        <label>Focus Areas</label>
        <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
 </div>