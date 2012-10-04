<?php

/* Display a plugin update notice that can be dismissed.  This notice is displayed on all admin pages until dismissed. */

add_action('admin_notices', 'jwl_admin_notice');
function jwl_admin_notice() {
	global $current_user ;
		$user_id = $current_user->ID;
		/* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'jwl_ignore_notice') ) {
		if ( current_user_can( 'manage_options' ) ) {
			echo '<div class="updated"><p>';
			printf(__('<span style="color:green;">Thank you for choosing Ultimate Tinymce.</span><br />Please visit the <a href="admin.php?page=ultimate-tinymce">Ultimate Tinymce Settings Page</a> to begin customization of your editor.<br />If you are upgrading from a previous version, you will need to <a href="admin.php?page=ultimate-tinymce">reconfigure</a> your button row settings.<span style="float:right;"><a href="%1$s">Hide Notice</a></span>'), '?jwl_nag_ignore=0');
			echo "</p></div>";
		}
	}
}
add_action('admin_init', 'jwl_nag_ignore');
function jwl_nag_ignore() {
	global $current_user;
		$user_id = $current_user->ID;
		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset($_GET['jwl_nag_ignore']) && '0' == $_GET['jwl_nag_ignore'] ) {
			 add_user_meta($user_id, 'jwl_ignore_notice', 'true', true);
	}
}

// Change our default Tinymce configuration values
function jwl_change_mce_options($initArray) {
	$initArray['popup_css'] = plugin_dir_url( __FILE__ ) . 'css/popup.css';
	$initArray['theme_advanced_font_sizes'] = '6px=6px,8px=8px,10px=10px,12px=12px,14px=14px,16px=16px,18px=18px,20px=20px,22px=22px,24px=24px,28px=28px,32px=32px,36px=36px,40px=40px,44px=44px,48px=48px,52px=52px,62px=62px,72px=72px';
	$initArray['plugin_insertdate_dateFormat'] = '%B %d, %Y';  // added for inserttimedate proper format
	$initArray['plugin_insertdate_timeFormat'] = '%I:%M:%S %p';  // added for inserttimedate proper format
	$initArray['wordpress_adv_hidden'] = false; // Always enable kitchen sink upon page refesh

	return $initArray;
}
add_filter('tiny_mce_before_init', 'jwl_change_mce_options');

// Insert a dashboard Ultimate Tinymce Widget for RSS feed.
$jwl_dashboard = get_option('jwl_dashboard_widget');
if ($jwl_dashboard == '1') {
	
	add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
	function my_custom_dashboard_widgets() {
	   global $wp_meta_boxes;
	   wp_add_dashboard_widget('jwl_tinymce_dashboard_widget', 'Ultimate Tinymce RSS Feed', 'jwl_tinymce_widget', 'jwl_configure_widget');
	}
	
	function jwl_tinymce_widget() {
		$jwl_widgets = get_option( 'jwl_dashboard_options' ); // Get the dashboard widget options
		$jwl_widget_id = 'jwl_tinymce_dashboard_widget'; // This must be the same ID we set in wp_add_dashboard_widget
		/* Check whether we have set the post count through the controls. If we didn't, set the default to 5 */
		$jwl_total_items = 	isset( $jwl_widgets[$jwl_widget_id] ) && isset( $jwl_widgets[$jwl_widget_id]['items'] )
							? absint( $jwl_widgets[$jwl_widget_id]['items'] ) : 5;
		// Echo the output of the RSS Feed.
		echo '<p style="border-bottom:#000 1px solid;">'; echo 'Showing ('.$jwl_total_items.') Posts'; echo '</p>';
		echo '<div class="rss-widget">';
		   wp_widget_rss_output(array( 'url' => 'http://www.plugins.joshlobe.com/feed/', 'title' => '', 'items' => $jwl_total_items, 'show_summary' => 0, 'show_author' => 0, 'show_date' => 0 ));
		echo "</div>";
		echo '<p style="text-align:center;border-top: #000 1px solid;padding:5px;"><a href="http://www.joshlobe.com/2011/10/ultimate-tinymce/">Ultimate Tinymce</a> - Visual Wordpress Editor</p>';
	}
	
	function jwl_configure_widget(){
		$jwl_widget_id = 'jwl_tinymce_dashboard_widget'; // This must be the same ID we set in wp_add_dashboard_widget
		$jwl_form_id = 'jwl-dashboard-control'; // Set this to whatever you want
			
		// Checks whether there are already dashboard widget options in the database
		if ( !$jwl_widget_options = get_option( 'jwl_dashboard_options' ) )
			$jwl_widget_options = array(); // If not, we create a new array
		// Check whether we have information for this form
		if ( !isset($jwl_widget_options[$jwl_widget_id]) )
			$jwl_widget_options[$jwl_widget_id] = array(); // If not, we create a new array
		// Check whether our form was just submitted
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST[$jwl_form_id]) ) {
			/* Get the value. In this case ['items'] is from the input field with the name of '.$form_id.'[items] */
			$jwl_number = absint( $_POST[$jwl_form_id]['items'] );
			$jwl_widget_options[$jwl_widget_id]['items'] = $jwl_number; // Set the number of items
			update_option( 'jwl_dashboard_options', $jwl_widget_options ); // Update our dashboard widget options so we can access later
		}
		
		/* Check if we have set the number of posts previously. If we didn't, then we just set it as empty. This value is used when we create the input field */
		$jwl_number = isset( $jwl_widget_options[$jwl_widget_id]['items'] ) ? (int) $jwl_widget_options[$jwl_widget_id]['items'] : '';
		
		// Create our form fields. Pay very close attention to the name part of the input field.
		echo '<p><label for="jwl_tinymce_dashboard_widget-number">' . __('Number of posts to show:') . '</label>';
		echo '<input id="jwl_tinymce_dashboard_widget-number" name="'.$jwl_form_id.'[items]" type="text" value="' . $jwl_number . '" size="3" /></p>';
	}
}

// Set an admin bar link to the settings page
$jwl_admin_links = get_option('jwl_admin_bar_link');
if ($jwl_admin_links == '1') {
	function jwl_admin_bar_init() {
		// Is the user sufficiently leveled, or has the bar been disabled?
		if (!is_super_admin() || !is_admin_bar_showing() )
			return;
		// Good to go, lets do this!
		add_action('admin_bar_menu', 'jwl_admin_bar_links', 500);
	}
	add_action('admin_bar_init', 'jwl_admin_bar_init');

	function jwl_admin_bar_links() {
		global $wp_admin_bar;
		// Links to add, in the form: 'Label' => 'URL'
		$links = array( 'Settings Page' => '' );
		$wp_admin_bar->add_menu( array( 'title' => 'Ultimate Tinymce', 'href' => false, 'id' => 'jwl_links', 'href' => '/wp-admin/admin.php?page=ultimate-tinymce' ));
		/** * Add the submenu links. */
		foreach ($links as $label => $url) { $wp_admin_bar->add_menu( array( 'title' => $label, 'href' => '/wp-admin/admin.php?page=ultimate-tinymce', 'parent' => 'jwl_links' )); }
	}
}

// Set our language localization folder (used for adding translations)
function jwl_ultimate_tinymce() {
 load_plugin_textdomain('jwl-ultimate-tinymce', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'jwl_ultimate_tinymce' );

// set field names for using custom fields in edit posts/pages admin panel.
function jwl_field_func($atts) {
   global $post;
   $name = $atts['name'];
   		if (empty($name)) return;
   return get_post_meta($post->ID, $name, true);
}
add_shortcode('field', 'jwl_field_func');

// Add ALL our settings
function jwl_settings_api_init() {
 	// This creates each settings option group.  These are used as headers in our admin panel settings page.	
 	add_settings_section('jwl_setting_section1', '', 'jwl_setting_section_callback_function1', 'ultimate-tinymce1');
	add_settings_section('jwl_setting_section2', '', 'jwl_setting_section_callback_function2', 'ultimate-tinymce2');
	add_settings_section('jwl_setting_section3', '', 'jwl_setting_section_callback_function3', 'ultimate-tinymce3');
	add_settings_section('jwl_setting_section4', '', 'jwl_setting_section_callback_function4', 'ultimate-tinymce4');
	
 	// This adds our individual settings to each option group defined above.	
	// These are the settings for Row 3
 	add_settings_field('jwl_fontselect_field_id', __('Font Select Button','jwl-ultimate-tinymce'), 'jwl_fontselect_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_fontsizeselect_field_id', __('Font Size Button','jwl-ultimate-tinymce'), 'jwl_fontsizeselect_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_cut_field_id', __('Cut Button','jwl-ultimate-tinymce'), 'jwl_cut_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_copy_field_id', __('Copy Button','jwl-ultimate-tinymce'), 'jwl_copy_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_paste_field_id', __('Paste Button','jwl-ultimate-tinymce'), 'jwl_paste_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_backcolorpicker_field_id', __('Background Color Picker Button','jwl-ultimate-tinymce'), 'jwl_backcolorpicker_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_forecolorpicker_field_id', __('Foreground Color Picker Button','jwl-ultimate-tinymce'), 'jwl_forecolorpicker_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_advhr_field_id', __('Horizontal Rule Button','jwl-ultimate-tinymce'), 'jwl_advhr_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_visualaid_field_id', __('Visual Aid Button','jwl-ultimate-tinymce'), 'jwl_visualaid_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_anchor_field_id', __('Anchor Button','jwl-ultimate-tinymce'), 'jwl_anchor_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_sub_field_id', __('Subscript Button','jwl-ultimate-tinymce'), 'jwl_sub_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_sup_field_id', __('Superscript Button','jwl-ultimate-tinymce'), 'jwl_sup_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_search_field_id', __('Search Button','jwl-ultimate-tinymce'), 'jwl_search_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_replace_field_id', __('Replace Button','jwl-ultimate-tinymce'), 'jwl_replace_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1'); add_settings_field('jwl_datetime_field_id', __('Insert Date/Time Button','jwl-ultimate-tinymce'), 'jwl_datetime_callback_function', 'ultimate-tinymce1', 'jwl_setting_section1');
	
	// These are the settings for Row 4
	add_settings_field('jwl_styleselect_field_id', __('Style Select Button','jwl-ultimate-tinymce'), 'jwl_styleselect_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_tableDropdown_field_id', __('Table Controls Dropdown Button','jwl-ultimate-tinymce'), 'jwl_tableDropdown_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_emotions_field_id', __('Emotions Button','jwl-ultimate-tinymce'), 'jwl_emotions_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_image_field_id', __('Advanced Image Button','jwl-ultimate-tinymce'), 'jwl_image_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_preview_field_id', __('Preview Button','jwl-ultimate-tinymce'), 'jwl_preview_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_cite_field_id', __('Citations Button','jwl-ultimate-tinymce'), 'jwl_cite_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_abbr_field_id', __('Abbreviations Button','jwl-ultimate-tinymce'), 'jwl_abbr_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_acronym_field_id', __('Acronym Button','jwl-ultimate-tinymce'), 'jwl_acronym_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_del_field_id', __('Delete Button','jwl-ultimate-tinymce'), 'jwl_del_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_ins_field_id', __('Insert Button','jwl-ultimate-tinymce'), 'jwl_ins_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_attribs_field_id', __('Attributes Button','jwl-ultimate-tinymce'), 'jwl_attribs_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_styleprops_field_id', __('Styleprops Box','jwl-ultimate-tinymce'), 'jwl_styleprops_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_code_field_id', __('HTML Code Button','jwl-ultimate-tinymce'), 'jwl_code_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_codemagic_field_id', __('HTML Code Magic Button','jwl-ultimate-tinymce'), 'jwl_codemagic_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); 	 add_settings_field('jwl_media_field_id', __('Insert Media Button','jwl-ultimate-tinymce'), 'jwl_media_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_youtube_field_id', __('Insert YouTube Video Button','jwl-ultimate-tinymce'), 'jwl_youtube_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_imgmap_field_id', __('Image Map Editor Button','jwl-ultimate-tinymce'), 'jwl_imgmap_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_visualchars_field_id', __('Toggle Visual Characters Button','jwl-ultimate-tinymce'), 'jwl_visualchars_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_print_field_id', __('Print Button','jwl-ultimate-tinymce'), 'jwl_print_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2'); add_settings_field('jwl_shortcodes_field_id', __('Shortcodes Select Button','jwl-ultimate-tinymce'), 'jwl_shortcodes_callback_function', 'ultimate-tinymce2', 'jwl_setting_section2');
	
	// Settings for miscellaneous options and features
	add_settings_field('jwl_tinycolor_css_field_id', __('Change the color of the Editor.','jwl-ultimate-tinymce'), 'jwl_tinycolor_css_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_tinymce_nextpage_field_id', __('Enable NextPage (PageBreak) Button.','jwl-ultimate-tinymce'), 'jwl_tinymce_nextpage_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_postid_field_id', __('Add ID Column to page/post admin list.','jwl-ultimate-tinymce'), 'jwl_postid_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_shortcode_field_id', __('Allow shortcode usage in widget text areas.','jwl-ultimate-tinymce'), 'jwl_shortcode_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_php_widget_field_id', __('Use PHP Text Widget','jwl-ultimate-tinymce'), 'jwl_php_widget_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_linebreak_field_id', __('Enable Line Break Shortcode','jwl-ultimate-tinymce'), 'jwl_linebreak_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_columns_field_id', __('Enable Columns Shortcodes','jwl-ultimate-tinymce'), 'jwl_columns_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_defaults_field_id', __('Enable Advanced Insert/Edit Link Button','jwl-ultimate-tinymce'), 'jwl_defaults_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_div_field_id', __('Enable "Div Clear" Buttons','jwl-ultimate-tinymce'), 'jwl_div_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_autop_field_id', __('Remove <b>p</b> and <b>br</b> tags','jwl-ultimate-tinymce'), 'jwl_autop_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3'); add_settings_field('jwl_signoff_field_id', __('Add a Signoff Shortcode','jwl-ultimate-tinymce'), 'jwl_signoff_callback_function', 'ultimate-tinymce3', 'jwl_setting_section3');
	
	// Settings for Admin Options
	add_settings_field('jwl_dashboard_widget', __('Enable dashboard widget','jwl-ultimate-tinymce'), 'jwl_dashboard_widget_callback_function', 'ultimate-tinymce4', 'jwl_setting_section4'); add_settings_field('jwl_admin_bar_link', __('Enable admin bar link','jwl-ultimate-tinymce'), 'jwl_admin_bar_link_callback_function', 'ultimate-tinymce4', 'jwl_setting_section4');
 	
	// Register our settings so that $_POST handling is done for us and our callback function just has to echo the <input>.
	// Register settings for Row 3
 	register_setting('jwl_options_group','jwl_fontselect_field_id'); register_setting('jwl_options_group','jwl_fontselect_dropdown'); register_setting('jwl_options_group','jwl_fontsizeselect_field_id'); register_setting('jwl_options_group','jwl_fontsizeselect_dropdown'); register_setting('jwl_options_group','jwl_cut_field_id'); register_setting('jwl_options_group','jwl_cut_dropdown'); register_setting('jwl_options_group','jwl_copy_field_id'); register_setting('jwl_options_group','jwl_copy_dropdown'); register_setting('jwl_options_group','jwl_paste_field_id'); register_setting('jwl_options_group','jwl_paste_dropdown'); register_setting('jwl_options_group','jwl_backcolorpicker_field_id'); register_setting('jwl_options_group','jwl_backcolorpicker_dropdown'); register_setting('jwl_options_group','jwl_forecolorpicker_field_id'); register_setting('jwl_options_group','jwl_forecolorpicker_dropdown'); register_setting('jwl_options_group','jwl_advhr_field_id'); register_setting('jwl_options_group','jwl_advhr_dropdown'); register_setting('jwl_options_group','jwl_visualaid_field_id'); register_setting('jwl_options_group','jwl_visualaid_dropdown'); register_setting('jwl_options_group','jwl_anchor_field_id'); register_setting('jwl_options_group','jwl_anchor_dropdown'); register_setting('jwl_options_group','jwl_sub_field_id'); register_setting('jwl_options_group','jwl_sub_dropdown'); register_setting('jwl_options_group','jwl_sup_field_id'); register_setting('jwl_options_group','jwl_sup_dropdown'); register_setting('jwl_options_group','jwl_search_field_id'); register_setting('jwl_options_group','jwl_search_dropdown'); register_setting('jwl_options_group','jwl_replace_field_id'); register_setting('jwl_options_group','jwl_replace_dropdown'); register_setting('jwl_options_group','jwl_datetime_field_id'); register_setting('jwl_options_group','jwl_datetime_dropdown');
	
	// Register settings for Row 4
	register_setting('jwl_options_group','jwl_styleselect_field_id'); register_setting('jwl_options_group','jwl_styleselect_dropdown'); register_setting('jwl_options_group','jwl_tableDropdown_field_id'); register_setting('jwl_options_group','jwl_tableDropdown_dropdown'); register_setting('jwl_options_group','jwl_emotions_field_id'); register_setting('jwl_options_group','jwl_emotions_dropdown'); register_setting('jwl_options_group','jwl_image_field_id'); register_setting('jwl_options_group','jwl_image_dropdown'); register_setting('jwl_options_group','jwl_preview_field_id'); register_setting('jwl_options_group','jwl_preview_dropdown'); register_setting('jwl_options_group','jwl_cite_field_id'); register_setting('jwl_options_group','jwl_cite_dropdown'); register_setting('jwl_options_group','jwl_abbr_field_id'); register_setting('jwl_options_group','jwl_abbr_dropdown'); register_setting('jwl_options_group','jwl_acronym_field_id'); register_setting('jwl_options_group','jwl_acronym_dropdown'); register_setting('jwl_options_group','jwl_del_field_id'); register_setting('jwl_options_group','jwl_del_dropdown'); register_setting('jwl_options_group','jwl_ins_field_id'); register_setting('jwl_options_group','jwl_ins_dropdown'); register_setting('jwl_options_group','jwl_attribs_field_id'); register_setting('jwl_options_group','jwl_attribs_dropdown'); register_setting('jwl_options_group','jwl_styleprops_field_id'); register_setting('jwl_options_group','jwl_styleprops_dropdown'); register_setting('jwl_options_group','jwl_code_field_id'); register_setting('jwl_options_group','jwl_code_dropdown'); register_setting('jwl_options_group','jwl_codemagic_field_id'); register_setting('jwl_options_group','jwl_codemagic_dropdown'); register_setting('jwl_options_group','jwl_media_field_id'); register_setting('jwl_options_group','jwl_media_dropdown'); register_setting('jwl_options_group','jwl_youtube_field_id'); register_setting('jwl_options_group','jwl_youtube_dropdown'); register_setting('jwl_options_group','jwl_imgmap_field_id'); register_setting('jwl_options_group','jwl_imgmap_dropdown'); register_setting('jwl_options_group','jwl_visualchars_field_id'); register_setting('jwl_options_group','jwl_visualchars_dropdown'); register_setting('jwl_options_group','jwl_print_field_id'); register_setting('jwl_options_group','jwl_print_dropdown'); register_setting('jwl_options_group','jwl_shortcodes_field_id'); register_setting('jwl_options_group','jwl_shortcodes_dropdown');
	
	// Register Settings for miscellaneous options and features
	register_setting('jwl_options_group','jwl_tinycolor_css_field_id'); register_setting('jwl_options_group','jwl_tinymce_nextpage_field_id'); register_setting('jwl_options_group','jwl_postid_field_id'); register_setting('jwl_options_group','jwl_shortcode_field_id'); register_setting('jwl_options_group','jwl_php_widget_field_id'); register_setting('jwl_options_group','jwl_linebreak_field_id'); register_setting('jwl_options_group','jwl_columns_field_id'); register_setting('jwl_options_group','jwl_defaults_field_id'); register_setting('jwl_options_group','jwl_div_field_id'); register_setting('jwl_options_group','jwl_autop_field_id'); register_setting('jwl_options_group','jwl_signoff_field_id');
	
	// Register settings for Admin Options
	register_setting('jwl_options_group','jwl_dashboard_widget'); register_setting('jwl_options_group','jwl_admin_bar_link');
	
}
add_action('admin_init', 'jwl_settings_api_init');

?>