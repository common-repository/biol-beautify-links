<?php
/*
Plugin Name:BIOL - Beautify Links
Plugin URI: https://handyshout.com/biol
Description: Create beautiful inline links to posts or external sites with background and intro text.
Author: Satnam Singh
Version: 1.2.2
Author URI: https://profiles.wordpress.org/satnam9/


Beautify Inbound Outbound Links  is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
 Beautify Inbound Outbound Links is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Beautify Inbound Outbound Links. If not, see <http://www.gnu.org/licenses/>.
*/


include( plugin_dir_path( __FILE__ ) . 'include/settings.php');
include( plugin_dir_path( __FILE__ ) . 'include/mcebutton.php');
//getting the setting defaults
$options = get_option('biol_beautify_link_options');
	if($options==false){
register_activation_hook(__FILE__, 'biol_setthedefaults' );
function biol_setthedefaults()
{
	biol_setdefaults();
}
}
	/**
 * Plugin action link to Settings page
*/
if ( ! function_exists('biol_action_links') ) {
    function biol_action_links( $links ) {
    
        $settings_link = '<a href="admin.php?page=biol-settings">' .
            esc_html( __('Settings', 'biol-settings' ) ) . '</a>';
    
        return array_merge( array( $settings_link), $links );
        
    }
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'biol_action_links' );
	}
	
	function biol_verison_fix() {
		$options = get_option('beautify_inbound_outbound_link_options');
		if($options!=false){
			$options = delete_option('beautify_inbound_outbound_link_options');
			if($options)
			{
				echo '<div class="notice notice-success is-dismissible">
				<p>Biol Settings has been reset to default to fix some errors. Sorry for inconvenience.</p>
			</div>';
				biol_setdefaults();
			}
		}
	}
	add_action( 'plugins_loaded', 'biol_verison_fix' );

	//setting defaults
	function biol_setdefaults()
{
	$defaults = array(
		'text_string' => 'Must Read:',
		'bg_color' => '#cccccc',
		'h_style' => '2',
		'h_color' => '#696969',
		'b_color' => '#FF8F00',
		'link_hover' => '#000000',
		'border_size' => '4',
		'bg_color' => '#EAEAEA',
		'text_color' => '#3c7cbd'
	  );
	  
	 $setdefault= wp_parse_args(update_option('biol_beautify_link_options',$defaults),$defaults);	
}
?>