<div class="wrap">
	<h2><?php echo _e('WP SOCIAL TOOLBAR PRO','WPSOCIALTOOLBARPRO'); ?></h2>

	<script type="text/javascript" src="<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>js/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>js/colorpicker.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function(){
	var fanpage=$('#facebook_option_select').attr('value');
	if(fanpage=='true') { $('.fanapage_input_box').show(); }
	else  { $('.fanapage_input_box').hide(); }
	$('#WPSocialBackground,#WPSocialBorder,#WPSocialtwitterbg,#WPSocialfontcolor,#WPSociallinkcolor,#WPSocialhoverbg').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	var val=$('#wpst_whole_website').attr('value');
	if(val=='true')
	{  $('#wpst_page_options').hide(); }
	$('#facebook_option_select').change(function(){
		var val1=$('#facebook_option_select').attr('value');
		if(val1=="true")
		{ $('.fanapage_input_box').show(); }
		else  { $('.fanapage_input_box').hide(); }	
	});
	$('#wpst_whole_website').change(function(){
		var val1=$('#wpst_whole_website').attr('value');
		if(val1=="true")  { $('#wpst_page_options').fadeOut(2000); }
		else  { $('#wpst_page_options').fadeIn(2000); }
	});
	});
	</script>
	<link rel="stylesheet" href="<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>/css/colorpicker.css" type="text/css" />
	
	<?php
	if(isset($_POST['DDWpSTProOptions']))
	{
		echo '<div class="updated fade" id="message"><p>';
		_e('Wordpress Social Toolbar Settings <strong>Updated</strong>');
		echo '</p></div>';
		unset($_POST['update']);
		update_option('DDWpSTProOptions', $_POST['DDWpSTProOptions']);
	}
	?>


	<table cellspacing="5" cellpadding="5" border="0" width="100%">
	<tr>
	<td width="70%" valign="top">
	<div class="maxi_left">
	<?php
	$options=get_option('DDWpSTProOptions');
	$form_url=admin_url().'admin.php?page=wp-social-toolbar-pro/wp-social-toolbar-pro.php';
	?>
		<form name="maxilink_settings_form" id="maxilink_settings_form" method="POST" action="<?php echo $form_url;?>">
		<table cellspacing="5" cellpadding="5" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col" colspan="2"><?php _e('General Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			<tr>
			<td><?php _e('ToolBar Position: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td>
			<select name="DDWpSTProOptions[position]" style="width:120px;">
			<option value="bottom" <?php selected('bottom', $options['position']); ?>><?php _e('Bottom','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="top" <?php selected('top', $options['position']); ?>><?php _e('Top','WPSOCIALTOOLBARPRO'); ?></option>
			</select> <span style="color:#666;"><small><?php _e('Select ToolBar Position. ','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td><?php _e('Icon Image Size: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td>
			<select name="DDWpSTProOptions[icon_size]" style="width:120px;">
			<option value="normal" <?php selected('normal', $options['icon_size']); ?>><?php _e('Normal 40px','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="small" <?php selected('small', $options['icon_size']); ?>><?php _e('Small 30px','WPSOCIALTOOLBARPRO'); ?></option>
			</select> <span style="color:#666;"><small><?php _e('Select Image Icon Size. ','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td><?php _e('Background Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text" id="WPSocialBackground" name="DDWpSTProOptions[background_color]" value="<?php echo $options['background_color']; ?>" size="15" /> <span style="color:#666;"><small><?php _e('Select Background Color','WPSOCIALTOOLBARPRO'); ?></small></span></td>
			</tr>

			<tr>
			<td><?php _e('Border Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text" id="WPSocialBorder" name="DDWpSTProOptions[border_color]" value="<?php echo $options['border_color']; ?>" size="15" />
			<span style="color:#666;"><small><?php _e('Select Border Color','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td><?php _e('Recent Tweet Background: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text" id="WPSocialtwitterbg" name="DDWpSTProOptions[twitter_background]" value="<?php echo $options['twitter_background']; ?>" size="15" />
			<span style="color:#666;"><small><?php _e('Select Recent Tweet Background Color','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td><?php _e('Social Icon Hover Background: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text" id="WPSocialhoverbg" name="DDWpSTProOptions[hover_background]" value="<?php echo $options['hover_background']; ?>" size="15" />
			<span style="color:#666;"><small><?php _e('Select Icon Hover Color','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td><?php _e('Icon Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td>
			<select name="DDWpSTProOptions[icon_type]" id="maxi_position" style="width:120px;">
			<option value="white" <?php selected('white', $options['icon_type']); ?>><?php _e('White','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="black" <?php selected('black', $options['icon_type']); ?>><?php _e('Black','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="gray" <?php selected('gray', $options['icon_type']); ?>><?php _e('Gray','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="blue" <?php selected('blue', $options['icon_type']); ?>><?php _e('Blue','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="green" <?php selected('green', $options['icon_type']); ?>><?php _e('Green','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="red" <?php selected('red', $options['icon_type']); ?>><?php _e('Red','WPSOCIALTOOLBARPRO'); ?></option>
			</select> <span style="color:#666;"><small><?php _e('Select Social Icon Color','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td><?php _e('Hide / Show Icon Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td>
			<select name="DDWpSTProOptions[button_color]" id="maxi_position" style="width:120px;">
			<option value="white" <?php selected('white', $options['button_color']); ?>><?php _e('White','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="black" <?php selected('black', $options['button_color']); ?>><?php _e('Black','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="gray" <?php selected('gray', $options['button_color']); ?>><?php _e('Gray','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="blue" <?php selected('blue', $options['button_color']); ?>><?php _e('Blue','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="green" <?php selected('green', $options['button_color']); ?>><?php _e('Green','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="red" <?php selected('red', $options['button_color']); ?>><?php _e('Red','WPSOCIALTOOLBARPRO'); ?></option>
			</select> <span style="color:#666;"><small><?php _e('Select Hide / Show Icon Color','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			
			<tr><td colspan="2">
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
		</table>
		<br />
		<table cellspacing="5" cellpadding="5" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col" colspan="2"><?php _e('Recent Tweet Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			<tr>
			<td>
			<?php _e("Show Recent Tweet", 'WPSOCIALTOOLBARPRO'); ?>:
			</td>
			<td>
			<select name="DDWpSTProOptions[show_tweeter]" style="width:100px;">
			<option value="yes" <?php selected('yes', $options['show_tweeter']); ?>><?php _e('Yes','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="no" <?php selected('no', $options['show_tweeter']); ?>><?php _e('No','WPSOCIALTOOLBARPRO'); ?></option>
			</select>
			</td>
			</tr>
			<tr>
			<td><?php _e('Twitter Bird Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td>
			<select name="DDWpSTProOptions[bird_color]" id="maxi_position" style="width:120px;">
			<option value="white" <?php selected('white', $options['bird_color']); ?>><?php _e('White','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="black" <?php selected('black', $options['bird_color']); ?>><?php _e('Black','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="gray" <?php selected('gray', $options['bird_color']); ?>><?php _e('Gray','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="blue" <?php selected('blue', $options['bird_color']); ?>><?php _e('Blue','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="green" <?php selected('green', $options['bird_color']); ?>><?php _e('Green','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="red" <?php selected('red', $options['bird_color']); ?>><?php _e('Red','WPSOCIALTOOLBARPRO'); ?></option>
			</select> <span style="color:#666;"><small><?php _e('Select Twitter Bird Color','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td>
			<?php _e("Font Family", 'WPSOCIALTOOLBARPRO'); ?>:
			</td>
			<td><select name="DDWpSTProOptions[font_family]"><option value="'Trebuchet MS', Helvetica, sans-serif" <?php selected("'Trebuchet MS', Helvetica, sans-serif", stripslashes($options['font_family'])); ?>>'Trebuchet MS', Helvetica, sans-serif</option><option value="Arial, Helvetica, sans-serif" <?php selected('Arial, Helvetica, sans-serif', stripslashes($options['font_family'])); ?>>Arial, Helvetica, sans-serif</option><option value="Tahoma, Geneva, sans-serif" <?php selected('Tahoma, Geneva, sans-serif', stripslashes($options['font_family'])); ?>>Tahoma, Geneva, sans-serif</option><option value="Verdana, Geneva, sans-serif" <?php selected('Verdana, Geneva, sans-serif', stripslashes($options['font_family'])); ?>>Verdana, Geneva, sans-serif</option><option value="Georgia, serif" <?php selected('Georgia, serif', stripslashes($options['font_family'])); ?>>Georgia, serif</option><option value="'Arial Black', Gadget, sans-serif" <?php selected("'Arial Black', Gadget, sans-serif", stripslashes($options['font_family'])); ?>>'Arial Black', Gadget, sans-serif</option><option value="'Bookman Old Style', serif" <?php selected("'Bookman Old Style', serif", stripslashes($options['font_family'])); ?>>'Bookman Old Style', serif</option><option value="'Comic Sans MS', cursive" <?php selected("'Comic Sans MS', cursive", stripslashes($options['font_family'])); ?>>'Comic Sans MS', cursive</option><option value="'Courier New', Courier, monospace" <?php selected("'Courier New', Courier, monospace", stripslashes($options['font_family'])); ?>>'Courier New', Courier, monospace</option><option value="Garamond, serif" <?php selected("Garamond, serif", stripslashes($options['font_family'])); ?>>Garamond, serif</option><option value="'Times New Roman', Times, serif" <?php selected("'Times New Roman', Times, serif", stripslashes($options['font_family'])); ?>>'Times New Roman', Times, serif</option><option value="Impact, Charcoal, sans-serif" <?php selected("Impact, Charcoal, sans-serif", stripslashes($options['font_family'])); ?>>Impact, Charcoal, sans-serif</option><option value="'Lucida Console', Monaco, monospace" <?php selected("'Lucida Console', Monaco, monospace", stripslashes($options['font_family'])); ?>>'Lucida Console', Monaco, monospace</option><option value="'MS Sans Serif', Geneva, sans-serif" <?php selected("'MS Sans Serif', Geneva, sans-serif", stripslashes($options['font_family'])); ?>>'MS Sans Serif', Geneva, sans-serif</option></select>
			</td>
			</tr>
			<tr>
			<td><?php _e('Font Size: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text"  name="DDWpSTProOptions[font_size]" value="<?php echo $options['font_size']; ?>" size="30" /> <span style="color:#666;"><small><?php _e('Enter Font Size eg. 12px ','WPSOCIALTOOLBARPRO'); ?></small></span></td>
			</tr>
			<tr>
			<td><?php _e('Font Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text" id="WPSocialfontcolor" name="DDWpSTProOptions[font_color]" value="<?php echo $options['font_color']; ?>" size="30" /></td>
			</tr>
			<tr>
			<td><?php _e('Link Color: ','WPSOCIALTOOLBARPRO'); ?></td>
			<td><input type="text" id="WPSociallinkcolor" name="DDWpSTProOptions[link_color]" value="<?php echo $options['link_color']; ?>" size="30" /></td>
			</tr>
			<tr>
			<td><?php _e('Show Timestamp : ','WPSOCIALTOOLBARPRO'); ?></td>
			<td>
			<select name="DDWpSTProOptions[twitter_timestamp]" style="width:120px;">
			<option value="true" <?php selected('true', $options['twitter_timestamp']); ?>><?php _e('True','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="false" <?php selected('false', $options['twitter_timestamp']); ?>><?php _e('False','WPSOCIALTOOLBARPRO'); ?></option>
			</select> <span style="color:#666;"><small><?php _e('Select True if you want to display twitter timestamp. ','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<span style="color:#666;"><small><?php _e('*Please Note: Recent Tweet feed pulls from the Twitter ID used on the "Social Profiles" settings page.','WPSOCIALTOOLBARPRO'); ?></small></span>

			</td>
			</tr>
			<tr><td colspan="2">
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
		</table>
		<br />
		<table cellspacing="0" cellpadding="0" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col"><?php _e('WP Social Toolbar Display Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			
			<tr>
			<td><?php _e('Display Throughout Entire Website: ','WPSOCIALTOOLBARPRO'); ?>

			<select name="DDWpSTProOptions[whole_website]" id="wpst_whole_website" style="width:100px;"><option value="true" <?php selected('true', $options['whole_website']); ?>>Yes</option><option value="false" <?php selected('false', $options['whole_website']); ?>>No</option></select>			
			</td>
			</tr>

			<tr>
			<td width="100%">
			<br />
			<table cellspacing="0" cellpadding="0" border="0" border="0" class="widefat" id="wpst_page_options">
				<tr>
					<td width="30%">
								<label><?php _e('Display On Home Page: ','WPSOCIALTOOLBARPRO'); ?></label>
								<?php 
									if(isset($options['home_page']))			
									{
										$checked1="checked";
									}
									else
									{
										$checked1="";
									}
								?>
								<input type="checkbox" name="DDWpSTProOptions[home_page]" value="<?php echo $options['home_page']; ?>" size="30" <?php echo $checked1; ?> />
					</td>
					<td width="40%">
								<label><?php _e('Display On Category Archive Pages: ','WPSOCIALTOOLBARPRO'); ?></label>
																<?php 
									if(isset($options['category_archive']))			
									{
										$checked2="checked";
									}
									else
									{
										$checked2="";
									}
								?>
								<input type="checkbox" name="DDWpSTProOptions[category_archive]" value="<?php echo $options['category_archive']; ?>" size="30" <?php echo $checked2; ?> />
					</td>
					<td width="30%">
								<label><?php _e('Display On Blog And Single Post Pages: ','WPSOCIALTOOLBARPRO'); ?></label>
																<?php 
									if(isset($options['blog_single_post']))			
									{
										$checked3="checked";
									}
									else
									{
										$checked3="";
									}
								?>
								<input type="checkbox" name="DDWpSTProOptions[blog_single_post]" value="<?php echo $options['blog_single_post']; ?>" size="30" <?php echo $checked3; ?> />
					</td>
				</tr>
				<tr>
					<td colspan="3"><?php _e('Display On Specific Pages','WPSOCIALTOOLBARPRO'); ?> <input type="text" name="DDWpSTProOptions[specific_pages]" value="<?php echo $options['specific_pages']; ?>" size="60" /><br /><small><?php _e('(Enter (,) comma separated page ids.)','WPSOCIALTOOLBARPRO'); ?></small></td>
				</tr>
			</table>
			<br />
			</td>
			</tr>

			<tr><td>
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
		</table>	
		<br />
		<table cellspacing="0" cellpadding="0" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col"><?php _e('Google +1 Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			<tr>
			<td><?php _e('Display Google +1 Button: ','WPSOCIALTOOLBARPRO'); ?>

			<select name="DDWpSTProOptions[google_plus_one]" style="width:150px;">
			<option value="false" <?php selected('false', $options['google_plus_one']); ?>><?php _e('No','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="true" <?php selected('true', $options['google_plus_one']); ?>><?php _e('Yes','WPSOCIALTOOLBARPRO'); ?></option></select>
			<br />
			<span style="color:#666;"><small><?php _e('Select Yes if you want to add Google +1 button to share.','WPSOCIALTOOLBARPRO'); ?></small></span>			
			</td>
			</tr>
			<tr><td>
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
		</table>
		<br />
		<table cellspacing="0" cellpadding="0" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col"><?php _e('Share Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			<tr>
			<td><?php _e('Share Home Page: ','WPSOCIALTOOLBARPRO'); ?>

			<select name="DDWpSTProOptions[share_home]" style="width:150px;"><option value="true" <?php selected('true', $options['share_home']); ?>><?php _e('Home','WPSOCIALTOOLBARPRO'); ?></option><option value="false" <?php selected('false', $options['share_home']); ?>><?php _e('Individual Page / Post','WPSOCIALTOOLBARPRO'); ?></option></select>
			<br />
			<span style="color:#666;"><small><?php _e('Choose the page URL you want the Tweet and FB Like buttons to share.','WPSOCIALTOOLBARPRO'); ?></small></span>
			
			</td>
			</tr>
			<tr><td>
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
	</table>
	<br />
		<table cellspacing="0" cellpadding="0" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col"><?php _e('Facebook Share Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			<tr>
			<td><?php _e('Want to Share Fanpage ? : ','WPSOCIALTOOLBARPRO'); ?>

			<select name="DDWpSTProOptions[facebook_setting]" style="width:150px;" id="facebook_option_select"><option value="false" <?php selected('false', $options['facebook_setting']); ?>><?php _e('False','WPSOCIALTOOLBARPRO'); ?></option>
			<option value="true" <?php selected('true', $options['facebook_setting']); ?>><?php _e('True','WPSOCIALTOOLBARPRO'); ?></option>
			</select>
			<br />
			<div class="fanapage_input_box">
			<input type="text" name="DDWpSTProOptions[fan_page]" style="width:300px;" value="<?php echo $options['fan_page']; ?>" />
			<br />
			<span style="color:#666;"><small><?php _e('Enter your Facebook Fan Page URL.','WPSOCIALTOOLBARPRO'); ?></small></span>
			</div>
			</td>
			</tr>
			<tr><td>
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
	</table>
		<br />
		<table cellspacing="0" cellpadding="0" class="widefat" width="400">
			<thead>
			<tr>
			<th scope="col"><?php _e('Social Toolbar Pro Settings','WPSOCIALTOOLBARPRO'); ?>
			</th>
			</tr>
			</thead>
			<tr>
			<td><?php _e('Show Social Toolbar Pro Logo: ','WPSOCIALTOOLBARPRO'); ?>

			<select name="DDWpSTProOptions[daddydesign_logo]" style="width:150px;"><option value="true" <?php selected('true', $options['daddydesign_logo']); ?>><?php _e('True','WPSOCIALTOOLBARPRO'); ?></option><option value="false" <?php selected('false', $options['daddydesign_logo']); ?>><?php _e('False','WPSOCIALTOOLBARPRO'); ?></option></select>
			<br />
			<span style="color:#666;"><small><?php _e('Show socialtoolbarpro.com Logo Or Not.','WPSOCIALTOOLBARPRO'); ?></small></span>
			</td>
			</tr>
			<tr><td>
			<input type="hidden" name="DDWpSTProOptions[update]" value="UPDATED" />
            <input type="submit" class="button-primary" value="<?php _e('Save Settings','WPSOCIALTOOLBARPRO') ?>" />
			</td></tr>
	</table>
		</form>
	</div>
	</td>
	<td width="30%" valign="top">
	<div class="maxi_right">
	<?php include_once dirname(__FILE__).'/our_feeds.php'; ?>
	</div>
	</td></tr>
	</table>
</div>