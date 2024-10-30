<?php

function biol_beautify_link_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
			   return;
	   }
   // check if WYSIWYG is enabled
   if (get_user_option( 'rich_editing'== true) ) {
	   add_filter( 'mce_external_plugins', 'biol_beautify_link_mce_button' );
	   add_filter( 'mce_buttons', 'biol_beautify_link_register_mce_button' );
	   }
}
add_action('admin_head', 'biol_beautify_link_button');

// tinymce script
function biol_beautify_link_mce_button( $plugin_array ) {
  $plugin_array['biol_beautify_link_mcebutton'] = plugin_dir_url( __FILE__ ).'js/mce.js';
  return $plugin_array;
}

// register new button in the editor
function biol_beautify_link_register_mce_button( $buttons ) {
	array_push($buttons, 'biol_beautify_link_mcebutton');
	return $buttons;
}

//register shortcode
function register_biol(){
    add_shortcode('biol','biol_beautify_link_shortcode_function');
}
add_action('init','register_biol');

function biol_beautify_link_shortcode_function($atts)
{

    extract(shortcode_atts(array(
        'ltext' => '',
        'url' => '',
        'follow'=> '',
        'opentab'=>''
    ), $atts));
$url=esc_attr($url);
$title=esc_attr($ltext);
$follow=esc_attr($follow);
$openNew=esc_attr($opentab);
if($openNew=='yes')
{
    $nw="target='_blank'";
}
if($follow=='no')
{
    $nf="rel='nofollow'";
}

//get values from option
 $options = get_option('biol_beautify_link_options');
 $thetextstring= $options['text_string']  ;
 $thetextcolor=$options['text_color'];
 $thebordersize=$options['border_size'].'px';
 $thelinkcolor=$options['h_color'];
 $thelinkhover=$options['link_hover']  ;
 $thebordercolor=$options['b_color'];
 $thebackcolor= $options['bg_color'] ; 
 $thelinkstyle=biol_linkstyle();

 //building the view
 	$string= "<style>
.biol_box
{
    background:$thebackcolor;
    border-style: solid;
    border-width:0px 0px 0px $thebordersize;
    border-color:$thebordercolor;
    color:#fff;
    width:100%;
    height:auto;
    font-family: Verdana, Geneva, sans-serif;
}
.biol_content
{
    padding:15px;
}
.biol_content a,.blink
{
color:$thelinkcolor;
text-decoration: $thelinkstyle !important;
}
.biol_content a:hover
{
color:$thelinkhover ;
text-decoration:$thelinkstyle !important;
}
.biol_content .introtext{
    color:$thetextcolor; 
    text-transform: Capitalize;
}
</style>
<div class='biol_box'>
<div class='biol_content'>
    <span class='introtext'> $thetextstring</span>
<a class='blink' alt='".$title."' ".$nf."".$nw." href='".$url."'>".$title."</a></div>
</div>
<br>";

$r=$string;
	return $r;
}

//get link decoration
function biol_linkstyle()
{
    $options = get_option('biol_beautify_link_options');

    $style=$options['h_style'];
    
switch ($style) {
    case 1:
        return $string='none';
    break;
    case 2:
        return $string='underline';
    break;
    case 3:
        return $string='underline double';
    break;
    case 4:
        return $string='underline wavy';
    break;
    case 5:
        return $string='overline';
    break;
    default:
   return $string=none;
}
}
?>