<?php

 // These are our callback functions for each settings option GROUP described above.
 function jwl_setting_section_callback_function1() {
 	_e('<p>&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>Description</u></strong><span style="margin-left:200px;"><strong><u>Enable</u></strong></span><span style="margin-left:20px;"><strong><u>Image</u></strong></span><span style="margin-left:35px;"><strong><u>Help</u></strong></span><span style="margin-left:20px;"><strong><u>Row Selection</u></strong></span></p>','jwl-ultimate-tinymce');
 }
 function jwl_setting_section_callback_function2() {
 	_e('<p>&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>Description</u></strong><span style="margin-left:200px;"><strong><u>Enable</u></strong></span><span style="margin-left:20px;"><strong><u>Image</u></strong></span><span style="margin-left:35px;"><strong><u>Help</u></strong></span><span style="margin-left:20px;"><strong><u>Row Selection</u></strong></span></p>','jwl-ultimate-tinymce');
 }
 function jwl_setting_section_callback_function3() {
 	_e(' ','jwl-ultimate-tinymce');
 }
 function jwl_setting_section_callback_function4() {
 	_e(' ','jwl-ultimate-tinymce');
 }
 
 // Begin callback functions	 
 function jwl_fontselect_callback_function() {
    echo '<input name="jwl_fontselect_field_id" id="fontselect" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_fontselect_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/fontselect.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/fontselect.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_fontselect = get_option('jwl_fontselect_dropdown');
			$items_fontselect = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_fontselect_dropdown[row]'>";
			foreach($items_fontselect as $item_fontselect) {
				$selected_fontselect = ($options_fontselect['row']==$item_fontselect) ? 'selected="selected"' : '';
				echo "<option value='$item_fontselect' $selected_fontselect>$item_fontselect</option>";
			}
			echo "</select>";
 }
 
 function jwl_fontsizeselect_callback_function() {
 	echo '<input name="jwl_fontsizeselect_field_id" id="fontsize" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_fontsizeselect_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/fontsizeselect.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/fontsize.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_fontsizeselect = get_option('jwl_fontsizeselect_dropdown');
			$items_fontsizeselect = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_fontsizeselect_dropdown[row]'>";
			foreach($items_fontsizeselect as $item_fontsizeselect) {
				$selected_fontsizeselect = ($options_fontsizeselect['row']==$item_fontsizeselect) ? 'selected="selected"' : '';
				echo "<option value='$item_fontsizeselect' $selected_fontsizeselect>$item_fontsizeselect</option>";
			}
			echo "</select>";
 }
 
 function jwl_cut_callback_function() {
 	echo '<input name="jwl_cut_field_id" id="cut" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_cut_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/cut.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/cut.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_cut = get_option('jwl_cut_dropdown');
			$items_cut = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_cut_dropdown[row]'>";
			foreach($items_cut as $item_cut) {
				$selected_cut = ($options_cut['row']==$item_cut) ? 'selected="selected"' : '';
				echo "<option value='$item_cut' $selected_cut>$item_cut</option>";
			}
			echo "</select>";
 }
 
 function jwl_copy_callback_function() {
 	echo '<input name="jwl_copy_field_id" id="copy" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_copy_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/copy.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/copy.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_copy = get_option('jwl_copy_dropdown');
			$items_copy = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_copy_dropdown[row]'>";
			foreach($items_copy as $item_copy) {
				$selected_copy = ($options_copy['row']==$item_copy) ? 'selected="selected"' : '';
				echo "<option value='$item_copy' $selected_copy>$item_copy</option>";
			}
			echo "</select>";
 }
 
 function jwl_paste_callback_function() {
 	echo '<input name="jwl_paste_field_id" id="paste" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_paste_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/paste.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/paste.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_paste = get_option('jwl_paste_dropdown');
			$items_paste = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_paste_dropdown[row]'>";
			foreach($items_paste as $item_paste) {
				$selected_paste = ($options_paste['row']==$item_paste) ? 'selected="selected"' : '';
				echo "<option value='$item_paste' $selected_paste>$item_paste</option>";
			}
			echo "</select>";
 }
 
 function jwl_backcolorpicker_callback_function() {
 	echo '<input name="jwl_backcolorpicker_field_id" id="backcolorpicker" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_backcolorpicker_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/backcolorpicker.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/bg.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_backcolorpicker = get_option('jwl_backcolorpicker_dropdown');
			$items_backcolorpicker = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_backcolorpicker_dropdown[row]'>";
			foreach($items_backcolorpicker as $item_backcolorpicker) {
				$selected_backcolorpicker = ($options_backcolorpicker['row']==$item_backcolorpicker) ? 'selected="selected"' : '';
				echo "<option value='$item_backcolorpicker' $selected_backcolorpicker>$item_backcolorpicker</option>";
			}
			echo "</select>";
 }
 
 function jwl_forecolorpicker_callback_function() {
 	echo '<input name="jwl_forecolorpicker_field_id" id="forecolorpicker" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_forecolorpicker_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/forecolorpicker.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/fg.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_forecolorpicker = get_option('jwl_forecolorpicker_dropdown');
			$items_forecolorpicker = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_forecolorpicker_dropdown[row]'>";
			foreach($items_forecolorpicker as $item_forecolorpicker) {
				$selected_forecolorpicker = ($options_forecolorpicker['row']==$item_forecolorpicker) ? 'selected="selected"' : '';
				echo "<option value='$item_forecolorpicker' $selected_forecolorpicker>$item_forecolorpicker</option>";
			}
			echo "</select>";
 }
 
 function jwl_advhr_callback_function() {
 	echo '<input name="jwl_advhr_field_id" id="hr" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_advhr_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/hr.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/hr.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_advhr = get_option('jwl_advhr_dropdown');
			$items_advhr = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_advhr_dropdown[row]'>";
			foreach($items_advhr as $item_advhr) {
				$selected_advhr = ($options_advhr['row']==$item_advhr) ? 'selected="selected"' : '';
				echo "<option value='$item_advhr' $selected_advhr>$item_advhr</option>";
			}
			echo "</select>";
 }
 
 function jwl_visualaid_callback_function() {
 	echo '<input name="jwl_visualaid_field_id" id="visualaid" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_visualaid_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/visualaid.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/visual.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_visualaid = get_option('jwl_visualaid_dropdown');
			$items_visualaid = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_visualaid_dropdown[row]'>";
			foreach($items_visualaid as $item_visualaid) {
				$selected_visualaid = ($options_visualaid['row']==$item_visualaid) ? 'selected="selected"' : '';
				echo "<option value='$item_visualaid' $selected_visualaid>$item_visualaid</option>";
			}
			echo "</select>";
 }
 
 function jwl_anchor_callback_function() {
 	echo '<input name="jwl_anchor_field_id" id="anchor" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_anchor_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/anchor.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/anchor.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_anchor = get_option('jwl_anchor_dropdown');
			$items_anchor = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_anchor_dropdown[row]'>";
			foreach($items_anchor as $item_anchor) {
				$selected_anchor = ($options_anchor['row']==$item_anchor) ? 'selected="selected"' : '';
				echo "<option value='$item_anchor' $selected_anchor>$item_anchor</option>";
			}
			echo "</select>";
 }
 
 function jwl_sub_callback_function() {
 	echo '<input name="jwl_sub_field_id" id="sub" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_sub_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/sub.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/sub.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_sub = get_option('jwl_sub_dropdown');
			$items_sub = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_sub_dropdown[row]'>";
			foreach($items_sub as $item_sub) {
				$selected_sub = ($options_sub['row']==$item_sub) ? 'selected="selected"' : '';
				echo "<option value='$item_sub' $selected_sub>$item_sub</option>";
			}
			echo "</select>";
 }
 
 function jwl_sup_callback_function() {
 	echo '<input name="jwl_sup_field_id" id="sup" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_sup_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/sup.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/sup.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_sup = get_option('jwl_sup_dropdown');
			$items_sup = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_sup_dropdown[row]'>";
			foreach($items_sup as $item_sup) {
				$selected_sup = ($options_sup['row']==$item_sup) ? 'selected="selected"' : '';
				echo "<option value='$item_sup' $selected_sup>$item_sup</option>";
			}
			echo "</select>";
 }
 
 function jwl_search_callback_function() {
 	echo '<input name="jwl_search_field_id" id="search" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_search_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/search.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/search.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_search = get_option('jwl_search_dropdown');
			$items_search = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_search_dropdown[row]'>";
			foreach($items_search as $item_search) {
				$selected_search = ($options_search['row']==$item_search) ? 'selected="selected"' : '';
				echo "<option value='$item_search' $selected_search>$item_search</option>";
			}
			echo "</select>";
 }
 
 function jwl_replace_callback_function() {
 	echo '<input name="jwl_replace_field_id" id="replace" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_replace_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/replace.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/replace.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_replace = get_option('jwl_replace_dropdown');
			$items_replace = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_replace_dropdown[row]'>";
			foreach($items_replace as $item_replace) {
				$selected_replace = ($options_replace['row']==$item_replace) ? 'selected="selected"' : '';
				echo "<option value='$item_replace' $selected_replace>$item_replace</option>";
			}
			echo "</select>";
 }
  
 function jwl_datetime_callback_function() {
 	echo '<input name="jwl_datetime_field_id" id="datetime" type="checkbox" value="1" class="one" ' . checked( 1, get_option('jwl_datetime_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/datetime.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:32px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/datetime.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_datetime = get_option('jwl_datetime_dropdown');
			$items_datetime = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_datetime_dropdown[row]'>";
			foreach($items_datetime as $item_datetime) {
				$selected_datetime = ($options_datetime['row']==$item_datetime) ? 'selected="selected"' : '';
				echo "<option value='$item_datetime' $selected_datetime>$item_datetime</option>";
			}
			echo "</select>";
 }
 
// Begin Callback functions for each individual setting registered in code above.
// Callback Functions for Row 4 Buttons
 
 function jwl_styleselect_callback_function() {
 	echo '<input name="jwl_styleselect_field_id" id="styleselect" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_styleselect_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/styleselect.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/styleselect.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_styleselect = get_option('jwl_styleselect_dropdown');
			$items_styleselect = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_styleselect_dropdown[row]'>";
			foreach($items_styleselect as $item_styleselect) {
				$selected_styleselect = ($options_styleselect['row']==$item_styleselect) ? 'selected="selected"' : '';
				echo "<option value='$item_styleselect' $selected_styleselect>$item_styleselect</option>";
			}
			echo "</select>";
 }
 
 function jwl_tableDropdown_callback_function() {
 	echo '<input name="jwl_tableDropdown_field_id" id="tableDropdown" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_tableDropdown_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/tableDropdown.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:67px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/tableDropdown.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_tableDropdown = get_option('jwl_tableDropdown_dropdown');
			$items_tableDropdown = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_tableDropdown_dropdown[row]'>";
			foreach($items_tableDropdown as $item_tableDropdown) {
				$selected_tableDropdown = ($options_tableDropdown['row']==$item_tableDropdown) ? 'selected="selected"' : '';
				echo "<option value='$item_tableDropdown' $selected_tableDropdown>$item_tableDropdown</option>";
			}
			echo "</select>";
 }
 
 function jwl_emotions_callback_function() {
 	echo '<input name="jwl_emotions_field_id" id="emotions" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_emotions_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/emotions.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/emotions.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_emotions = get_option('jwl_emotions_dropdown');
			$items_emotions = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_emotions_dropdown[row]'>";
			foreach($items_emotions as $item_emotions) {
				$selected_emotions = ($options_emotions['row']==$item_emotions) ? 'selected="selected"' : '';
				echo "<option value='$item_emotions' $selected_emotions>$item_emotions</option>";
			}
			echo "</select>";
 }
 
 function jwl_image_callback_function() {
 	echo '<input name="jwl_image_field_id" id="image" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_image_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/image.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/image.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_image = get_option('jwl_image_dropdown');
			$items_image = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_image_dropdown[row]'>";
			foreach($items_image as $item_image) {
				$selected_image = ($options_image['row']==$item_image) ? 'selected="selected"' : '';
				echo "<option value='$item_image' $selected_image>$item_image</option>";
			}
			echo "</select>";
 }
 
 function jwl_preview_callback_function() {
 	echo '<input name="jwl_preview_field_id" id="preview" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_preview_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/preview.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/preview.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_preview = get_option('jwl_preview_dropdown');
			$items_preview = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_preview_dropdown[row]'>";
			foreach($items_preview as $item_preview) {
				$selected_preview = ($options_preview['row']==$item_preview) ? 'selected="selected"' : '';
				echo "<option value='$item_preview' $selected_preview>$item_preview</option>";
			}
			echo "</select>";
 }
 
 function jwl_cite_callback_function() {
 	echo '<input name="jwl_cite_field_id" id="cite" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_cite_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/cite.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/cite.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_cite = get_option('jwl_cite_dropdown');
			$items_cite = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_cite_dropdown[row]'>";
			foreach($items_cite as $item_cite) {
				$selected_cite = ($options_cite['row']==$item_cite) ? 'selected="selected"' : '';
				echo "<option value='$item_cite' $selected_cite>$item_cite</option>";
			}
			echo "</select>";
 }
 
 function jwl_abbr_callback_function() {
 	echo '<input name="jwl_abbr_field_id" id="abbr" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_abbr_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/abbr.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/abbr.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_abbr = get_option('jwl_abbr_dropdown');
			$items_abbr = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_abbr_dropdown[row]'>";
			foreach($items_abbr as $item_abbr) {
				$selected_abbr = ($options_abbr['row']==$item_abbr) ? 'selected="selected"' : '';
				echo "<option value='$item_abbr' $selected_abbr>$item_abbr</option>";
			}
			echo "</select>";
 }
 
 function jwl_acronym_callback_function() {
 	echo '<input name="jwl_acronym_field_id" id="acronym" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_acronym_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/acronym.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/acronym.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_acronym = get_option('jwl_acronym_dropdown');
			$items_acronym = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_acronym_dropdown[row]'>";
			foreach($items_acronym as $item_acronym) {
				$selected_acronym = ($options_acronym['row']==$item_acronym) ? 'selected="selected"' : '';
				echo "<option value='$item_acronym' $selected_acronym>$item_acronym</option>";
			}
			echo "</select>";
 }
 
 function jwl_del_callback_function() {
 	echo '<input name="jwl_del_field_id" id="del" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_del_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/del.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/del.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_del = get_option('jwl_del_dropdown');
			$items_del = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_del_dropdown[row]'>";
			foreach($items_del as $item_del) {
				$selected_del = ($options_del['row']==$item_del) ? 'selected="selected"' : '';
				echo "<option value='$item_del' $selected_del>$item_del</option>";
			}
			echo "</select>";
 }
 
 function jwl_ins_callback_function() {
 	echo '<input name="jwl_ins_field_id" id="ins" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_ins_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/ins.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/ins.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_ins = get_option('jwl_ins_dropdown');
			$items_ins = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_ins_dropdown[row]'>";
			foreach($items_ins as $item_ins) {
				$selected_ins = ($options_ins['row']==$item_ins) ? 'selected="selected"' : '';
				echo "<option value='$item_ins' $selected_ins>$item_ins</option>";
			}
			echo "</select>";
 }
 
 function jwl_attribs_callback_function() {
 	echo '<input name="jwl_attribs_field_id" id="attribs" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_attribs_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/attribs.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/attrib.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_attribs = get_option('jwl_attribs_dropdown');
			$items_attribs = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_attribs_dropdown[row]'>";
			foreach($items_attribs as $item_attribs) {
				$selected_attribs = ($options_attribs['row']==$item_attribs) ? 'selected="selected"' : '';
				echo "<option value='$item_attribs' $selected_attribs>$item_attribs</option>";
			}
			echo "</select>";
 }
 
 function jwl_styleprops_callback_function() {
 	echo '<input name="jwl_styleprops_field_id" id="styleprops" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_styleprops_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/styleprops.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/styleprops.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_styleprops = get_option('jwl_styleprops_dropdown');
			$items_styleprops = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_styleprops_dropdown[row]'>";
			foreach($items_styleprops as $item_styleprops) {
				$selected_styleprops = ($options_styleprops['row']==$item_styleprops) ? 'selected="selected"' : '';
				echo "<option value='$item_styleprops' $selected_styleprops>$item_styleprops</option>";
			}
			echo "</select>";
 }
 
 function jwl_code_callback_function() {
 	echo '<input name="jwl_code_field_id" id="code" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_code_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/code.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/code.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_code = get_option('jwl_code_dropdown');
			$items_code = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_code_dropdown[row]'>";
			foreach($items_code as $item_code) {
				$selected_code = ($options_code['row']==$item_code) ? 'selected="selected"' : '';
				echo "<option value='$item_code' $selected_code>$item_code</option>";
			}
			echo "</select>";
 }
 
 function jwl_codemagic_callback_function() {
 	echo '<input name="jwl_codemagic_field_id" id="codemagic" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_codemagic_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/codemagic.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/codemagic.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_codemagic = get_option('jwl_codemagic_dropdown');
			$items_codemagic = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_codemagic_dropdown[row]'>";
			foreach($items_codemagic as $item_codemagic) {
				$selected_codemagic = ($options_codemagic['row']==$item_codemagic) ? 'selected="selected"' : '';
				echo "<option value='$item_codemagic' $selected_codemagic>$item_codemagic</option>";
			}
			echo "</select>";
 }
 
 function jwl_media_callback_function() {
 	echo '<input name="jwl_media_field_id" id="media" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_media_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/media.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/media.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_media = get_option('jwl_media_dropdown');
			$items_media = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_media_dropdown[row]'>";
			foreach($items_media as $item_media) {
				$selected_media = ($options_media['row']==$item_media) ? 'selected="selected"' : '';
				echo "<option value='$item_media' $selected_media>$item_media</option>";
			}
			echo "</select>";
 }
 
 function jwl_youtube_callback_function() {
 	echo '<input name="jwl_youtube_field_id" id="youtube" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_youtube_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/youtube.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/youtube.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_youtube = get_option('jwl_youtube_dropdown');
			$items_youtube = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_youtube_dropdown[row]'>";
			foreach($items_youtube as $item_youtube) {
				$selected_youtube = ($options_youtube['row']==$item_youtube) ? 'selected="selected"' : '';
				echo "<option value='$item_youtube' $selected_youtube>$item_youtube</option>";
			}
			echo "</select>";
 }
 
 function jwl_imgmap_callback_function() {
 	echo '<input name="jwl_imgmap_field_id" id="imgmap" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_imgmap_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/imgmap.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/imgmap.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_imgmap = get_option('jwl_imgmap_dropdown');
			$items_imgmap = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_imgmap_dropdown[row]'>";
			foreach($items_imgmap as $item_imgmap) {
				$selected_imgmap = ($options_imgmap['row']==$item_imgmap) ? 'selected="selected"' : '';
				echo "<option value='$item_imgmap' $selected_imgmap>$item_imgmap</option>";
			}
			echo "</select>";
 }
 
 function jwl_visualchars_callback_function() {
 	echo '<input name="jwl_visualchars_field_id" id="visualchars" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_visualchars_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/visualchars.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/visualchars.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_visualchars = get_option('jwl_visualchars_dropdown');
			$items_visualchars = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_visualchars_dropdown[row]'>";
			foreach($items_visualchars as $item_visualchars) {
				$selected_visualchars = ($options_visualchars['row']==$item_visualchars) ? 'selected="selected"' : '';
				echo "<option value='$item_visualchars' $selected_visualchars>$item_visualchars</option>";
			}
			echo "</select>";
 }
 
 function jwl_print_callback_function() {
 	echo '<input name="jwl_print_field_id" id="print" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_print_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/print.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:66px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/print.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_print = get_option('jwl_print_dropdown');
			$items_print = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_print_dropdown[row]'>";
			foreach($items_print as $item_print) {
				$selected_print = ($options_print['row']==$item_print) ? 'selected="selected"' : '';
				echo "<option value='$item_print' $selected_print>$item_print</option>";
			}
			echo "</select>";
 }
 
 function jwl_shortcodes_callback_function() {
 	echo '<input name="jwl_shortcodes_field_id" id="shortcodes" type="checkbox" value="1" class="two" ' . checked( 1, get_option('jwl_shortcodes_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/shortcodes.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/shortcodes.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
			$options_shortcodes = get_option('jwl_shortcodes_dropdown');
			$items_shortcodes = array("Row 1", "Row 2", "Row 3", "Row 4");
			echo "<select id='row' style='width:80px;margin-left:27px;' name='jwl_shortcodes_dropdown[row]'>";
			foreach($items_shortcodes as $item_shortcodes) {
				$selected_shortcodes = ($options_shortcodes['row']==$item_shortcodes) ? 'selected="selected"' : '';
				echo "<option value='$item_shortcodes' $selected_shortcodes>$item_shortcodes</option>";
			}
			echo "</select>";
 }
 
 // Callback functions for miscellaneous options and features
 // Function and Settings for Tinymce editor color changes
 
 function jwl_tinycolor_css_callback_function() {
	$options = get_option('jwl_tinycolor_css_field_id');
	$items = array("Default", "Pink", "Green", "Dark&Green", "Dark&Pink", "Rainbow", "Steel");
	echo "<select id='tinycolor' name='jwl_tinycolor_css_field_id[tinycolor]'>";
	foreach($items as $item) {
		$selected = ($options['tinycolor']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/tinycolor.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><span style="float:right;"><?php _e('Don\'t miss the <a target="_blank" href="http://www.plugins.joshlobe.com/wp-admin-colors/">WP Admin Colors</a> addon.','jwl-ultimate-tinymce'); ?></span><?php 
 }
 
 function change_mce_colors() {
   $options2 = get_option('jwl_tinycolor_css_field_id');
   $current_option = strtolower($options2['tinycolor']);
   $colorurl = plugin_dir_url( __FILE__ ) . 'css/change_mce_'.$current_option.'.css';  // Color Options
   wp_register_style('tiny_color_mce', $colorurl, '', 1.0, 'screen');
   wp_enqueue_style('tiny_color_mce');
 }
 add_action('admin_head', 'change_mce_colors');
 
 function jwl_tinymce_nextpage_callback_function() {
 	echo '<input name="jwl_tinymce_nextpage_field_id" id="tinymce_nextpage" type="checkbox" value="1" class="three" ' . checked( 1, get_option('jwl_tinymce_nextpage_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/nextpage.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
 }
 
 function jwl_postid_callback_function() {
 	echo '<input name="jwl_postid_field_id" id="postid" type="checkbox" value="1" class="three" ' . checked( 1, get_option('jwl_postid_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/postid.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
 }
 
 function jwl_shortcode_callback_function() {
 	echo '<input name="jwl_shortcode_field_id" id="shortcode" type="checkbox" value="1" class="three" ' . checked( 1, get_option('jwl_shortcode_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/widgetshortcode.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
 }
 
 function jwl_php_widget_callback_function() {
 	echo '<input name="jwl_php_widget_field_id" id="media" type="checkbox" value="1" class="three" ' . checked( 1, get_option('jwl_php_widget_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/php.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
 }
 
 function jwl_linebreak_callback_function() {
 	echo '<input name="jwl_linebreak_field_id" id="linebreak" type="checkbox" value="1" class="three" ' . checked( 1, get_option('jwl_linebreak_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/linebreak.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><span style="padding-left:10px;"><?php _e('Simply use the <b>[break]</b> shortcode','jwl-ultimate-tinymce');
 }
 
 function jwl_columns_callback_function() {
 	echo '<input name="jwl_columns_field_id" id="columns" type="checkbox" value="1" class="three" ' . checked( 1, get_option('jwl_columns_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/columns.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><span style="padding-left:10px;"><?php _e('Ex. <b>[one_half]</b>This is the left column.<b>[/one_half]</b> <b>[one_half_last]</b>This is the right column.<b>[/one_half_last]</b>','jwl-ultimate-tinymce');
 }
 
 function jwl_defaults_callback_function() {
 	echo '<input name="jwl_defaults_field_id" id="defaults" type="checkbox" value="1" class="four" ' . checked( 1, get_option('jwl_defaults_field_id'), false ) . ' /> ';
	?><img src="<?php echo plugin_dir_url( __FILE__ ) ?>advlink/advlink.png" style="margin-left:10px;margin-bottom:-5px;" /><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/advlink.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
 }
 
 function jwl_div_callback_function() {
 	echo '<input name="jwl_div_field_id" id="div" type="checkbox" value="1" class="four" ' . checked( 1, get_option('jwl_div_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/divclear.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
 }
 
 function jwl_autop_callback_function() {
 	echo '<input name="jwl_autop_field_id" id="autop" type="checkbox" value="1" class="four" ' . checked( 1, get_option('jwl_autop_field_id'), false ) . ' /> ';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/autop.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><span style="margin-left:15px;"><?php _e('(Disable wpautop) - <b>Read the help file first</b>.','jwl-ultimate-tinymce'); ?></span><?php 
 }
 
 function jwl_signoff_callback_function() {
 	echo '<textarea name="jwl_signoff_field_id" value="" rows="15" class="long-text" style="width:400px; height:100px;">';
	echo get_option('jwl_signoff_field_id');
	echo '</textarea>';
	?><span style="margin-left:10px;"><a href="javascript:popcontact('<?php echo plugin_dir_url( __FILE__ ) ?>js/popup-help/signoff.php')"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/popup-help.png" style="margin-bottom:-5px;" title="Click for Help" /></a></span><?php
	_e('<br />Insert the above code using the <b>[signoff]</b> shortcode within your post.','jwl-ultimate-tinymce');
 } 
 
// Functions for Admin Panel Options
function jwl_dashboard_widget_callback_function() {
	echo '<input name="jwl_dashboard_widget" id="dashboard" type="checkbox" value="1" class="five" ' . checked( 1, get_option('jwl_dashboard_widget'), false ) . ' /> ';
}
function jwl_admin_bar_link_callback_function() {
	echo '<input name="jwl_admin_bar_link" id="adminbar" type="checkbox" value="1" class="five" ' . checked( 1, get_option('jwl_admin_bar_link'), false ) . ' /> ';
}

?>