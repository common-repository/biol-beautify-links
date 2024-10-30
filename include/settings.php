<?php

add_action('admin_menu', 'biol_beautify_link_menu');
function biol_beautify_link_menu() {
	add_menu_page('Beautify Inbound Outbound Links Settings', 'BIOL', 'administrator', 'biol-settings-2', 'biol_beautify_link_menu_page', plugins_url("/settingsicon.png", __FILE__ ));
	add_submenu_page('biol-settings-2','Settings','Settings','administrator','biol-settings','biol_beautify_link_menu_page');
	
	global $submenu;
    unset( $submenu['biol-settings-2'][0] );
}
//color picker
add_action( 'admin_enqueue_scripts', 'biol_color_picker' );
function biol_color_picker( $hook_suffix ) {
	// first check that $hook_suffix is appropriate for your admin page
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'bi-link-handle', plugins_url('/js/pick-color.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// Draw the option page
function biol_beautify_link_menu_page() {
	?>
	<div class="wrap">
  <?php settings_errors(); ?>
		<h2>BIOL Settings</h2>
		<form action="options.php" method="post">
			<?php settings_fields('biol_beautify_link_options'); ?>
			<?php do_settings_sections('biol_settings'); ?>
			  <?php submit_button(); ?>
      	</form>  <form method="post" action=<?php $_SERVER['PHP_SELF']?>>
		  <h2>Restore Defaults</h2>
		  <p>
		  Click below button to Restore default settings.
		  </p>
		   <?php wp_nonce_field(plugin_basename( __FILE__ ), 'nonce_reset'); ?>
		  <button class="button" name="rd_form"> Restore Default</button>
		  </form>

		 <script data-name="BMC-Widget" src="https://cdnjs.buymeacoffee.com/1.0.0/widget.prod.min.js" data-id="zJvbHLe" data-description="Support me on Buy me a coffee!" data-message="If you like this plugin consider to buy me a coffee if you can!" data-color="#FF813F" data-position="right" data-x_margin="18" data-y_margin="18"></script>
	</div>
	<?php
}


// Register and define the settings
add_action('admin_init', 'biol_beautify_link_init');
function biol_beautify_link_init(){
	register_setting(
		'biol_beautify_link_options',
		'biol_beautify_link_options',
		'biol_beautify_link_validate'
	);
	add_settings_section(
		'biol_beautify_link_appear',
		'Appearance',
		'biol_beautify_link_sec_text',
		'biol_settings'
	);
	add_settings_field(
		'biol_beautify_link_biol_text',
		'Intro Text',
		'biol_beautify_link_text_input',
		'biol_settings',
		'biol_beautify_link_appear'
);
add_settings_field(
  'biol_beautify_link_biol_bsize',
  'Left Border Size',
  'biol_beautify_link_bsize_input',
  'biol_settings',
  'biol_beautify_link_appear'
);
  add_settings_field(
		'biol_beautify_link_biol_tcolor',
		'Intro Text Color',
		'biol_beautify_link_tcolor_input',
		'biol_settings',
		'biol_beautify_link_appear'
);
add_settings_field(
  'biol_beautify_link_biol_bgcolor',
  'Background Color',
  'biol_beautify_link_bgcolor_input',
  'biol_settings',
  'biol_beautify_link_appear'
);
add_settings_field(
  'biol_beautify_link_biol_bcolor',
  'Border Color',
  'biol_beautify_link_bcolor_input',
  'biol_settings',
  'biol_beautify_link_appear'
);
add_settings_field(
  'biol_beautify_link_biol_hcolor',
  'Link Color',
  'biol_beautify_link_hcolor_input',
  'biol_settings',
  'biol_beautify_link_appear'
);
add_settings_field(
	'biol_beautify_link_biol_hstyle',
	'Link Decoration:',
	'biol_beautify_link_hstyle_input',
	'biol_settings',
	'biol_beautify_link_appear'
  );
add_settings_field(
  'biol_beautify_link_biol_hover',
  'Hover Link Color',
  'biol_beautify_link_hover_input',
  'biol_settings',
  'biol_beautify_link_appear'
);

}

// Draw the section header
function biol_beautify_link_sec_text() {
	echo '<p>Customize the apperance of the box, text and link.</p>';
}

// Display and fill the form field
function biol_beautify_link_text_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$text_string = $options['text_string'];
	// echo the field
	echo "<input id='text_string' name='biol_beautify_link_options[text_string]' type='text' value='$text_string' />";
}


function biol_beautify_link_tcolor_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$text_color = $options['text_color'];
	// echo the field
	echo "<input id='text_color' name='biol_beautify_link_options[text_color]' type='text' value='$text_color' class='the-color-field' />";
}

function biol_beautify_link_bgcolor_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$bg_color = $options['bg_color'];
	// echo the field
	echo "<input id='bg_color' class='the-color-field' name='biol_beautify_link_options[bg_color]' type='text' value='$bg_color' />";
}

function biol_beautify_link_bsize_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$border_size = $options['border_size'];
	// echo the field
	echo "<input id='border_size' name='biol_beautify_link_options[border_size]' type='text' value='$border_size' />";
}



function biol_beautify_link_bcolor_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$b_color = $options['b_color'];
	// echo the field
	echo "<input id='b_color' name='biol_beautify_link_options[b_color]' type='text' value='$b_color' class='the-color-field' />";
}


function biol_beautify_link_hcolor_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$h_color = $options['h_color'];
	// echo the field
	echo "<input id='h_color' name='biol_beautify_link_options[h_color]' type='text' value='$h_color' class='the-color-field' />";
}

//hover color
function biol_beautify_link_hover_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	$link_hover = $options['link_hover'];
	// echo the field
	echo "<input id='link_hover' name='biol_beautify_link_options[link_hover]' type='text' value='$link_hover' class='the-color-field' />";
}
//link styling
function biol_beautify_link_hstyle_input() {
	// get option data
	$options = get_option('biol_beautify_link_options');
	?>

	 <select name='biol_beautify_link_options[h_style]'>
	<option value='1' <?php selected( $options['h_style'], 1 ); ?>>None</option>
	<option value='2' <?php selected( $options['h_style'], 2 ); ?>>Underline</option>
	<option value='3'<?php selected( $options['h_style'], 3 ); ?>>Double</option>	
	<option value='4' <?php selected( $options['h_style'], 4 ); ?>>Wavy</option>
	<option value='5'<?php selected( $options['h_style'], 5 ); ?>>Overline</option>	

</select>
<?php
}

// validation
function biol_beautify_link_validate($fields) { 
     
  $valid_fields=array();
  $options = get_option('biol_beautify_link_options');
  // Validate Fields
  $text = trim( $fields['text_string'] ); 
  $text= strip_tags( stripslashes( $text ) );
	
  $linkstyle = trim( $fields['h_style'] ); 
  $valid_fields['h_style'] = strip_tags( stripslashes( $linkstyle ) );
 
  $backcolor= trim( $fields['bg_color'] ); 
  $backcolor = strip_tags( stripslashes( $backcolor ) );
     
 
  $bordercolor = trim( $fields['b_color'] );
  $bordercolor = strip_tags( stripslashes( $bordercolor ) );
     
 
  $bordersize = trim( $fields['border_size'] );
  $bordersize = strip_tags( stripslashes( $bordersize ) );
     
 
  $linkcolor = trim( $fields['h_color'] );
  $linkcolor= strip_tags( stripslashes( $linkcolor ) );
     
 
  $linkhover = trim( $fields['link_hover'] );
  $linkhover= strip_tags( stripslashes( $linkhover ) );
     
 
  $textcolor = trim( $fields['text_color'] );
  $textcolor  = strip_tags( stripslashes( $textcolor ) );
     
 #3background color check

  if( FALSE === biol_check_color( $backcolor ) ) {
   
      // Set the error message
      add_settings_error( 'bg_color', 'bg_color_error', 'Invalid Background Color!', 'error' ); // $setting, $code, $message, $type
       
      // Get the previous valid value
      $valid_fields['bg_color']  = $options['bg_color'] ;
   
  } else {
   
      $valid_fields['bg_color'] = $backcolor ;  
   
  }

//border color check
  if( FALSE === biol_check_color( $bordercolor ) ) {
   
	// Set the error message
	add_settings_error( 'b_color', 'b_color_error', 'Invalid Border Color!', 'error' ); // $setting, $code, $message, $type
	 
	// Get the previous valid value
	$valid_fields['b_color']  = $options['b_color'] ;
 
} else {
 
	$valid_fields['b_color'] = $bordercolor ;  
 
}
if( FALSE === biol_check_color( $linkcolor ) ) {
   
	// Set the error message
	add_settings_error( 'h_color', 'h_colorerror', 'Invalid Link Color!', 'error' ); // $setting, $code, $message, $type
	 
	// Get the previous valid value
	$valid_fields['h_color']  = $options['h_color'] ;
 
} else {
 
	$valid_fields['h_color'] = $linkcolor ;  
 
}
if( FALSE === biol_check_color( $linkhover ) ) {
   
	// Set the error message
	add_settings_error( 'link_hover', 'h_colorerror', 'Invalid Link Hover Color!', 'error' ); // $setting, $code, $message, $type
	 
	// Get the previous valid value
	$valid_fields['link_hover']  = $options['link_hover'] ;
 
} else {
 
	$valid_fields['link_hover'] = $linkhover ;  
 
}
if( FALSE === biol_check_color( $textcolor ) ) {
   
	// Set the error message
	add_settings_error( 'text_color', 'text_color_error', 'Invalid Text Color!', 'error' ); // $setting, $code, $message, $type
	 
	// Get the previous valid value
	$valid_fields['text_color']  = $options['text_color'] ;
 
} else {
 
	$valid_fields['text_color'] = $textcolor ;  
 
}
if( FALSE === biol_check_text( $text ) ) {
   
	// Set the error message
	add_settings_error( 'text_string', 'text_string_error', 'Invalid Text! Only Aplhabet, - , > and : allowed.', 'error' ); // $setting, $code, $message, $type
	 
	// Get the previous valid value
	$valid_fields['text_string']  = $options['text_string'] ;
 
} else {
 
	$valid_fields['text_string'] = $text ;  
 
}
if( FALSE === biol_check_number( $bordersize ) ) {
   
	// Set the error message
	add_settings_error( 'border_size', 'border_size_error', 'Invalid Border size! Only 0-50 allowed.', 'error' ); // $setting, $code, $message, $type
	 
	// Get the previous valid value
	$valid_fields['border_size']  = $options['border_size'] ;
 
} else {
 
	$valid_fields['border_size'] = $bordersize ;  
 
}

 
  return apply_filters( 'biol_beautify_link_validate', $valid_fields, $fields);
}

function biol_check_color( $value ) { 
   
	if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // if user insert a HEX color with #     
        return true;
    }
     
	return false;
}

function biol_check_text( $value ) { 
   
	if ( preg_match( '/^[a-zA-Z-,>: ]*$/', $value ) ) { // if user insert a HEX color with #     
        return true;
    }
     
	return false;
}

function biol_check_number( $value ) { 
   
	if ( preg_match( '/^[1-9][0-9]?$|^50$/', $value ) ) { // if user insert a HEX color with #     
        return true;
    }
     
	return false;
}
add_action('init','biol_restore_defaults');
function biol_restore_defaults()
{
	//restore default
if(isset($_POST['rd_form'])) {
	if (!isset( $_POST['nonce_reset'] ) || ! wp_verify_nonce( $_POST['nonce_reset'], plugin_basename( __FILE__ ))){
	die("Failed to verify Nonce");
	 }else{
		biol_set_default();
	}
  }
}
function biol_set_default()
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
	 echo '<div class="notice notice-success is-dismissible">
	 <p>Settings has been restored!</p>
 </div>';
}

?>