<?php

if ( isset( $_POST['uninstall'], $_POST['uninstall_confirm'] ) ) {
    ultimate_tinymce_uninstall();
}

function ultimate_tinymce_uninstall() {
	
	delete_option('jwl_fontselect_field_id'); delete_option('jwl_fontsizeselect_field_id'); delete_option('jwl_cut_field_id'); delete_option('jwl_copy_field_id'); delete_option('jwl_paste_field_id'); delete_option('jwl_backcolorpicker_field_id'); delete_option('jwl_forecolorpicker_field_id'); delete_option('jwl_advhr_field_id'); delete_option('jwl_visualaid_field_id'); delete_option('jwl_anchor_field_id'); delete_option('jwl_sub_field_id'); delete_option('jwl_sup_field_id'); delete_option('jwl_search_field_id'); delete_option('jwl_replace_field_id'); delete_option('jwl_datetime_field_id'); delete_option('jwl_fontselect_dropdown'); delete_option('jwl_fontsizeselect_dropdown'); delete_option('jwl_cut_dropdown'); delete_option('jwl_copy_dropdown'); delete_option('jwl_paste_dropdown'); delete_option('jwl_backcolorpicker_dropdown'); delete_option('jwl_forecolorpicker_dropdown'); delete_option('jwl_advhr_dropdown'); delete_option('jwl_visualaid_dropdown'); delete_option('jwl_anchor_dropdown'); delete_option('jwl_sub_dropdown'); delete_option('jwl_sup_dropdown'); delete_option('jwl_search_dropdown'); delete_option('jwl_replace_dropdown'); delete_option('jwl_datetime_dropdown');

	delete_option('jwl_styleselect_field_id'); delete_option('jwl_tableDropdown_field_id'); delete_option('jwl_emotions_field_id'); delete_option('jwl_image_field_id'); delete_option('jwl_preview_field_id'); delete_option('jwl_cite_field_id'); delete_option('jwl_abbr_field_id'); delete_option('jwl_acronym_field_id'); delete_option('jwl_del_field_id'); delete_option('jwl_ins_field_id'); delete_option('jwl_attribs_field_id'); delete_option('jwl_styleprops_field_id'); delete_option('jwl_code_field_id'); delete_option('jwl_codemagic_field_id'); delete_option('jwl_media_field_id'); delete_option('jwl_youtube_field_id'); delete_option('jwl_imgmap_field_id'); delete_option('jwl_visualchars_field_id'); delete_option('jwl_print_field_id'); delete_option('jwl_shortcodes_field_id'); delete_option('jwl_styleselect_dropdown'); delete_option('jwl_tableDropdown_dropdown'); delete_option('jwl_emotions_dropdown'); delete_option('jwl_image_dropdown'); delete_option('jwl_preview_dropdown'); delete_option('jwl_cite_dropdown'); delete_option('jwl_abbr_dropdown'); delete_option('jwl_acronym_dropdown'); delete_option('jwl_del_dropdown'); delete_option('jwl_ins_dropdown'); delete_option('jwl_attribs_dropdown'); delete_option('jwl_styleprops_dropdown'); delete_option('jwl_code_dropdown'); delete_option('jwl_codemagic_dropdown'); delete_option('jwl_media_dropdown'); delete_option('jwl_youtube_dropdown'); delete_option('jwl_imgmap_dropdown'); delete_option('jwl_visualchars_dropdown'); delete_option('jwl_print_dropdown'); delete_option('jwl_shortcodes_dropdown');
	
	delete_option('jwl_tinycolor_css_field_id'); delete_option('jwl_tinymce_nextpage_field_id'); delete_option('jwl_postid_field_id'); delete_option('jwl_shortcode_field_id'); delete_option('jwl_php_widget_field_id'); delete_option('jwl_linebreak_field_id'); delete_option('jwl_columns_field_id'); delete_option('jwl_defaults_field_id'); delete_option('jwl_div_field_id'); delete_option('jwl_autop_field_id'); delete_option('jwl_signoff_field_id');
	
	delete_option('jwl_dashboard_widget'); delete_option('jwl_admin_bar_link');
	
	delete_option('jwl_dashboard_options');
 
    // Do not change (this deactivates the plugin)
    $current = get_settings('active_plugins');
    array_splice($current, array_search( $_POST['plugin'], $current), 1 ); // Array-function!
    update_option('active_plugins', $current);
    header('Location: plugins.php?deactivate=true');
}

function jwl_ultimate_tinymce_form_uninstall() {
	?>
    <span class="content_wrapper_title"><?php _e('Uninstall Ultimate Tinymce','jwl-ultimate-tinymce'); ?></span>
    <form method="post">
	<input id="plugin" name="plugin" type="hidden" value="ultimate-tinymce/main.php" /> <?php  // The value must match the folder/file of the plugin.
    if ( isset( $_POST['uninstall'] ) && ! isset( $_POST['uninstall_confirm'] ) ) { 
	?><div id="message" class="error">
  			<p>
    		<?php _e('You must also check the confirm box before options will be uninstalled and deleted.','jwl-ultimate-tinymce'); ?>
  			</p>
		</div>
 	  <?php
    }
	_e('<ul class="help_tab_list_image"><li>The options for this plugin are not removed upon deactivation to ensure that no data is lost unintentionally.</li><li>If you wish to remove all plugin information from your database be sure to run this uninstall utility first.</li><li>This is a great way to "reset" the plugin, in case you experience problems with the editor.</li><li>This option is NOT reversible. Ultimate Tinymce plugin settings will need to be re-configured if deleted.</li></ul>','jwl-ultimate-tinymce'); ?>
    <center><br /><br />
	<input name="uninstall_confirm" type="checkbox" value="1" /> <?php _e('Please confirm before proceeding<br /><br />','jwl-ultimate-tinymce'); ?>
	<input class="button-primary" name="uninstall" type="submit" value="<?php _e('Uninstall','jwl-ultimate-tinymce'); ?>" />
	</form>
    </center>
<?php
}
/* End Uninstalling Database Values */

// admin notice for not verifying to uninstall database
if ( isset( $_POST['uninstall'] ) && ! isset( $_POST['uninstall_confirm'] ) ) {
	function jwl_tinymce_top_uninstall_notice() {
		echo '<div id="message" class="error"><p>';
		_e('You must also check the confirm box before options will be uninstalled and deleted.','jwl-ultimate-tinymce');
    	echo '</p></div>';
	}
	add_action('admin_notices','jwl_tinymce_top_uninstall_notice');
}
?>