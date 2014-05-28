<?php 
global $video;

$video = new WPAlchemy_MetaBox(array
    (
        'id' => '_video',
        'title' => 'Video Information',
        'types' => array('msd_video'),
        'context' => 'normal',
        'priority' => 'high',
        'template' => WP_PLUGIN_DIR.'/'.plugin_dir_path('msd-custom-cpt/msd-custom-cpt.php').'lib/template/video-information.php',
        'autosave' => TRUE,
        'mode' => WPALCHEMY_MODE_EXTRACT, // defaults to WPALCHEMY_MODE_ARRAY
        'prefix' => '_video_' // defaults to NULL
    ));