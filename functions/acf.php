<?php 

/*------------------------------------*\
    $ADD ACF OPTIONS PAGES
\*------------------------------------*/

if( function_exists('acf_add_options_page') ) {
   
    acf_add_options_page(array(
        'page_title' => 'Options',
        'menu_title' => 'Options',
        'menu_slug'  => 'options-settings',
        'capability' => 'options-settings',
        'redirect'   => false
    ));
    acf_add_options_sub_page(array(
        'title'       => 'Global',
        'parent_slug' => 'options-settings',
        'capability'  => 'manage_options'
    ));
    acf_add_options_sub_page(array(
        'title'       => 'Contact Details',
        'parent_slug' => 'options-settings',
        'capability'  => 'manage_options'
    ));
    acf_add_options_sub_page(array(
        'title'       => 'Footer',
        'parent_slug' => 'options-settings',
        'capability'  => 'manage_options'
    ));

}

/*------------------------------------*\
    $ACF GOOGLE MAP
\*------------------------------------*/

function td_acf_init() {    
    acf_update_setting('google_api_key', 'AIzaSyAS-PIIwiBkyt54BukihtDtzl3kmlG4_0Y');
}

add_action('acf/init', 'td_acf_init');

/*------------------------------------*\
    $DISPLAY ACF CLONE FIELD GROUP
\*------------------------------------*/

/*
 * Displays a link using clone field values - must be set to "Group"
 * @param - $field - the field name
 * @param - $id - page id or options
 * @param - $class - the link class
 * @usage - <?php echo td_display_clone('field_name','$id','$class',$sub); ?>
*/

function td_display_button($field = '', $id = '', $class = '', $sub = false) {

    // Get field
    if($sub == true) {
        $link = get_sub_field($field, $id);
    } else {
        $link = get_field($field, $id);
    }

    // Defaults
    $link_text   = '';
    $link_url    = '';
    $link_target = '_self';

    // Variables
    $link_type   = $link['link_type'];
    $link_text   = $link['link_text'];
    $page_link   = $link['page_link'];
    $anchor_link = $link['anchor_link'];
    $custom_link = $link['custom_link'];
    $file_link   = $link['file_link'];
    $new_window  = $link['new_window'];

    // Conditional URL
    if($link_type == 'link_page') {
        $link_url = $page_link;
    } elseif($link_type == 'link_anchor') {
        $link_url = $anchor_link;
    } elseif($link_type == 'link_custom') {
        $link_url = $custom_link;
    } elseif ($link_type == 'link_file') {
        $link_url = $file_link;
        $link_target = '_blank';
    }

    // Conditional target
    if($new_window) {
        $link_target = '_blank';
    }

    // Return HTML
    if($link) {
        return '<a href="' . $link_url . '" class="' . $class . '" target="' . $link_target . '">' . $link_text . '</a>';
    }

}

/*------------------------------------*\
    $DISPLAY ACF CLONE FIELD TITLE
\*------------------------------------*/

/*
 * Displays a title using clone field values - must be set to "Group"
 * @param - $field - the field name
 * @param - $id - page id or options
 * @param - $class - the link class
 * @usage - <?php echo td_display_clone('field_name','$id','$class',$sub); ?>
*/

function td_display_title($field = '', $id = '', $class = '', $sub = false) {

    // Get field
    if($sub == true) {
        $title = get_sub_field($field, $id);
    } else {
        $title = get_field($field, $id);
    }

    // Variables
    $heading_level = $title['heading_level'];
    $title_text    = $title['title_text'];

    if($title) {
        return '<' . $heading_level . ' class="' . $class . '">' . $title_text . '</' . $heading_level . '>';
    }

}

/*------------------------------------*\
    $FLEXIBLE PREVIEW PLUGIN
\*------------------------------------*/

function td_acf_image_path() {
    $path = 'images/acf';
    return $path;
}

add_filter( 'acf-flexible-content-preview.images_path', 'td_acf_image_path' );

/*------------------------------------*\
    $LIMIT ACF WYSIWYG
\*------------------------------------*/

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );

function my_toolbars( $toolbars ) {
    $toolbars['Very Basic' ] = array();
    $toolbars['Very Basic' ][1] = array( 'bold' , 'italic' , 'underline' );

    if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false ) {
        unset( $toolbars['Full' ][2][$key] );
    }

    return $toolbars;
}

?>