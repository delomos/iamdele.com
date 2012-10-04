<?php
/**
 * @package Ultimate TinyMCE
 * @version 1.8
 */
/*
Plugin Name: Ultimate TinyMCE
Plugin URI: http://www.joshlobe.com/2011/10/ultimate-tinymce/
Description: Beef up your visual tinymce editor with a plethora of advanced options.
Author: Josh Lobe
Version: 1.8
Author URI: http://joshlobe.com

*/
/*  Copyright 2011  Josh Lobe  (email : joshlobe@joshlobe.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details and information.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include ('includes/defaults.php');
include ('includes/uninstall.php');
include ('options_functions.php');
include ('options_callback_functions.php');
include ('admin_functions.php');	


//  Add settings link to plugins page menu
//  This can be duplicated to add multiple links
function add_ultimatetinymce_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
 
		if ($file == $this_plugin){
		$settings_link = '<a href="admin.php?page=ultimate-tinymce">'.__("Settings",'jwl-ultimate-tinymce').'</a>';
		$settings_link2 = '<a href="http://forum.joshlobe.com/member.php?action=register&referrer=1">'.__("Support Forum",'jwl-ultimate-tinymce').'</a>';
		array_unshift($links, $settings_link, $settings_link2);
		}
	return $links;
}
add_filter('plugin_action_links', 'add_ultimatetinymce_settings_link', 10, 2 );

// Donate link on manage plugin page
function jwl_execphp_donate_link($links, $file) { if ($file == plugin_basename(__FILE__)) { $donate_link = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=A9E5VNRBMVBCS" target="_blank">Donate</a>'; $links[] = $donate_link; } return $links; } add_filter('plugin_row_meta', 'jwl_execphp_donate_link', 10, 2);



/*
 * Here we are generating the admin options page.
 * This will allow us to include all scripts and code to mimic the main dashboard admin page.
*/
// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

define('JWL_ADMIN_PAGE_NAME', 'ultimate-tinymce');

//class that reperesents the plugins complete admin options page.
class jwl_metabox_admin {

		//constructor of class, PHP4 compatible construction for backward compatibility
		function jwl_metabox_admin() {
			//add filter for WordPress 2.8 changed backend box system !
			add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
			//register callback for admin menu  setup
			add_action('admin_menu', array(&$this, 'on_admin_menu')); 
			//register the callback been used if options of page been submitted and needs to be processed
			add_action('admin_post_save_ultimate-tinymce-general', array(&$this, 'on_save_changes'));
		}
		
		//for WordPress 2.8 we have to tell, that we support 2 columns !
		function on_screen_layout_columns($columns, $screen) {
			if ($screen == $this->pagehook) {
				$columns[$this->pagehook] = 2;
			}
			return $columns;
		}
		
		//extend the admin menu
		function on_admin_menu() {
			//add our own option page, you can also add it to different sections or use your own one
			$this->pagehook = add_options_page('Ultimate TinyMCE Plugin Page',  __('Ultimate TinyMCE','jwl-ultimate-tinymce'), 'manage_options', JWL_ADMIN_PAGE_NAME, array(&$this, 'jwl_options_page'));
			//register  callback gets call prior your own page gets rendered
			add_action('load-'.$this->pagehook, array(&$this, 'jwl_on_load_page'));
			add_action("load-{$this->pagehook}",array(&$this,'jwl_help_screen'));
			add_action('admin_print_styles-'.$this->pagehook, array(&$this, 'jwl_admin_register_head_styles'));
			add_action('admin_print_scripts-'.$this->pagehook, array(&$this, 'jwl_admin_register_head_scripts'));

		}
		// Register our styles only for admin settings page
		function jwl_admin_register_head_styles() {
			/** Register */
    		wp_register_style('admin-panel-css', plugins_url('css/admin_panel.css', __FILE__), array(), '1.0.0', 'all');
			/** Enqueue */
    		wp_enqueue_style('admin-panel-css');
			echo "<link href='http://fonts.googleapis.com/css?family=Unlock' rel='stylesheet' type='text/css'>"; // Added for title font
		}
		// Register our scripts only for admin settings page
		function jwl_admin_register_head_scripts() {
			$url2 = plugin_dir_url( __FILE__ ) . 'js/pop-up.js';  // Added for popup help javascript
			echo "<script language='JavaScript' type='text/javascript' src='$url2'></script>\n";  // Added for popup help javascript
		}
		// Creates the help tab at the top right of the admin settings page
		function jwl_help_screen() {
			/** 
			 * Create the WP_Screen object against your admin page handle
			 * This ensures we're working with the right admin page
			 */
			$this->admin_screen = WP_Screen::get($this->pagehook);
			// Content specified inline
			$this->admin_screen->add_help_tab( array( 'title' => __('Help Documentation','jwl-ultimate-tinymce'), 'id' => 'help_tab', 'content' => '<div class="help_wrapper"><p>'.__('<ul><li class="help_tab_list_image">The best resource for expedited help is my <a target="_blank" href="http://www.forum.joshlobe.com/">Support Forum</a>.</li><li class="help_tab_list_image">You can also visit the <a target="_blank" href="http://www.joshlobe.com/2011/10/ultimate-tinymce/">Plugin Page</a> to read user comments.</ul>','jwl-ultimate-tinymce').'</p></div>', 'callback' => false ));
			$this->admin_screen->add_help_tab( array( 'title' => __('Settings Page Tips','jwl-ultimate-tinymce'), 'id' => 'help_tab2', 'content' => '<div class="help_wrapper"><p>'.__('Here are some important items to remember regarding the new settings page.<br /><ul><li class="help_tab_list_image">Each option has a dedicated help icon.  Clicking the help icon (blue question mark) for a specific option will open a new window with a unique help file.</li><li class="help_tab_list_image">Boxes can be opened/closed and sorted by clicking and dragging the box headers.  Boxes can also be enabled/disabled via the "Screen Options" tab in the upper-right corner.</li><li class="help_tab_list_image">Set your screen layout to two columns (via Screen Options) for best results.</li><li class="help_tab_list_image">The "Row Selection" button allows you to choose which row of the visual editor the button will appear.</ul>','jwl-ultimate-tinymce').'</p></div>', 'callback' => false ));
			/**
			 * Content generated by callback
			 * The callback fires when tab is rendered - args: WP_Screen object, current tab
			 */
			//$this->admin_screen->add_help_tab(
				//array( 'title' => 'Info on this Page', 'id' => 'page_info', 'content' => '', 'callback' => create_function('','echo "<p>This is my generated content.</p>";' )));
			$this->admin_screen->set_help_sidebar( '<p>'.__('Ultimate Tinymce Help<br /><br /><a target="_blank" href="http://www.forum.joshlobe.com/">Support Forum</a>','jwl-ultimate-tinymce').'</p>' );
			//$this->admin_screen->add_option( 'per_page', array( 'label' => 'Entries per page', 'default' => 20, 'option' => 'edit_per_page' ));
			$this->admin_screen->add_option( 'layout_columns', array( 'default' => 3, 'max' => 5 ));
			// This option will NOT show up
			//$this->admin_screen->add_option( 'invisible_option', array( 'label'	=> 'I am a custom option', 'default' => 'wow', 'option' => 'my_option_id' ));
			/**
			 * But old-style metaboxes still work for creating custom checkboxes in the option panel
			 * This is a little hack-y, but it works
			 */
			//add_meta_box( 'jwl_help_meta_id', 'Help Metabox', array(&$this,'create_my_metabox'), $this->admin_page );
		}
		
		//will be executed if wordpress core detects this page has to be rendered
		function jwl_on_load_page() {
			//ensure, that the needed javascripts been loaded to allow drag/drop, expand/collapse and hide/show of boxes
			wp_enqueue_script('common');
			wp_enqueue_script('wp-lists');
			wp_enqueue_script('postbox');
		
			//add metaboxes now, all metaboxes registered during load page can be switched off/on at "Screen Options" automatically, nothing special to do therefore
			// Can use 'normal', 'side', or 'additional' when defining metabox positions
			add_meta_box('postbox_resources', __('Additional Resources'), array(&$this, 'postbox_resources'), $this->pagehook, 'side', 'core');
			add_meta_box('postbox_firefox', __('TinyMCE + Firefox = Best Experience'), array(&$this, 'postbox_firefox'), $this->pagehook, 'side', 'core');
			add_meta_box('postbox_vote', __('Please VOTE and click WORKS.'), array(&$this, 'postbox_vote'), $this->pagehook, 'side', 'core');
			add_meta_box('postbox_blog', __('Bloggers!!'), array(&$this, 'postbox_blog'), $this->pagehook, 'side', 'core');
			add_meta_box('postbox_feedback', __('Feedback'), array(&$this, 'postbox_feedback'), $this->pagehook, 'side', 'core');
			add_meta_box('postbox_poll', __('Plugin Poll'), array(&$this, 'postbox_poll'), $this->pagehook, 'side', 'core');
			
			add_meta_box('jwl_metabox1', __('Buttons Group 1'), array(&$this, 'buttons_group_1'), $this->pagehook, 'normal', 'core');
			add_meta_box('jwl_metabox2', __('Buttons Group 2'), array(&$this, 'buttons_group_2'), $this->pagehook, 'normal', 'core');
			add_meta_box('jwl_metabox4', __('Miscellaneous Features'), array(&$this, 'buttons_group_3'), $this->pagehook, 'normal', 'core');
			add_meta_box('jwl_metabox5', __('Admin Options'), array(&$this, 'buttons_group_4'), $this->pagehook, 'normal', 'core');
		}
		
		//executed to show the plugins complete admin page
		function jwl_options_page() {
			//we need the global screen column value to beable to have a sidebar in WordPress 2.8
			global $screen_layout_columns;
			//add a 3rd content box now for demonstration purpose, boxes added at start of page rendering can't be switched on/off, 
			//may be needed to ensure that a special box is always available
			//add_meta_box('postbox_addons', 'Plugin Addons', array(&$this, 'postbox_addons'), $this->pagehook, 'side', 'core');
			//define some data can be given to each metabox during rendering
			$data = array('My Data 1', 'My Data 2', 'Available Data 1');
			?>
			<div id="ultimate-tinymce-general" class="wrap">
			<?php //screen_icon('options-general'); ?>
            <span style="margin-top:10px;"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/settings.png" title="Ultimate Tinymce Settings Page" style="margin-top:10px;margin-bottom:-10px;"/><span style="margin-left:20px;color:#FAC46D;font-size:32px;font-family:'Unlock', cursive;"><?php _e('Ultimate Tinymce ','jwl-ultimate-tinymce'); ?></span><span style="color:#5F95EF;font-size:22px;font-family:'Unlock', cursive;"><?php _e('Admin Settings Page','jwl-ultimate-tinymce'); ?></span></span>
				<form action="admin-post.php" method="post">
				<?php wp_nonce_field('ultimate-tinymce-general'); ?>
				<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
				<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
				<input type="hidden" name="action" value="save_ultimate-tinymce_general" />
				</form>
                
                 
                
    <div id="container">  
        <ul class="menu">  
            <li id="news" class="active"><?php _e('Plugin Addons','jwl-ultimate-tinymce'); ?></li>  
            <li id="tutorials"><?php _e('Donations','jwl-ultimate-tinymce'); ?></li>  
            <li id="spread"><?php _e('Spread the Word','jwl-ultimate-tinymce'); ?></li> 
            <li id="tips"><?php _e('Admin Tips','jwl-ultimate-tinymce'); ?></li>
            <li id="defaults"><?php _e('Default Settings','jwl-ultimate-tinymce'); ?></li>
            <li id="links"><?php _e('Uninstall Plugin','jwl-ultimate-tinymce'); ?></li>  
        </ul>  
        <span class="clear"></span>  
        <div class="content news"> 
            <div class="main_help_wrapper"><span class="content_title"><?php _e('Plugin Addons:','jwl-ultimate-tinymce'); ?></span><br /><br />
                    <span style="margin-left:10px;"><?php _e('These addons provide additional features for Ultimate TinyMCE.  Click the title to view the download page.','jwl-ultimate-tinymce');
					?></span><br />
					<div id="clickme2" class="content_wrapper_addons"><?php
					_e('<a target="_blank" title="Easily Integrate Google Webfonts into your Website." href="http://www.plugins.joshlobe.com/ultimate-tinymce-google-webfonts/"><span style="font-family:\'Unlock\', cursive;">Google Webfonts</span></a>','jwl-ultimate-tinymce'); ?> <span class="span_hover"><?php _e('(Toggle)','jwl-ultimate-tinymce'); ?></span>
                    <div id="me2" style="display:none;margin-top:10px;"><?php
					if (is_plugin_active('ultimate_tinymce_google_webfonts_addon/main.php')) {
					_e('<span style="color:green;">Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/check.png" class="activation_icons" title="This addon has been installed and activated successfully." /> <?php
					} else {
					_e('<span style="color:red;">Not Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/warning.png" class="activation_icons" title="This addon has NOT been activated." /><br /><br /><span class="plugin_addons"> <?php _e('Choose any combination of Google Webfonts, and add them to the font dropdown selector.<br /><br />Fonts are rendered on both the editor screen, and to all front-end viewers.','jwl-ultimate-tinymce'); ?> <br /><br /><center><img style="border:1px solid #666" src="<?php echo plugin_dir_url( __FILE__ ) ?>img/admin_webfonts.png" title="Ultimate Tinymce Google Webfonts" /></center></span> <?php
					}
					?></div></div>
                    
					<div id="clickme3" class="content_wrapper_addons"><?php
					_e('<a target="_blank" title="Easily add custom styles to your content." href="http://www.plugins.joshlobe.com/ultimate-tinymce-custom-styles/"><span style="font-family:\'Unlock\', cursive;">Custom Styles</span></a>','jwl-ultimate-tinymce'); ?> <span class="span_hover"><?php _e('(Toggle)','jwl-ultimate-tinymce'); ?></span>
                    <div id="me3" style="display:none;margin-top:10px;"><?php
					if (is_plugin_active('ultimate_tinymce_custom_styles_addon/main.php')) {
					_e('<span style="color:green;">Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/check.png" class="activation_icons" title="This addon has been installed and activated successfully." /> <?php
					} else {
					_e('<span style="color:red;">Not Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/warning.png" class="activation_icons" title="This addon has NOT been activated." /><br /><br /><span class="plugin_addons"> <?php _e('Define unlimited custom styles, and add them to the styleselect dropdown list.<br /><br />Styles are rendered in both the editor screen and the front end of the website.','jwl-ultimate-tinymce'); ?> <br /><br /><center><img style="border:1px solid #666" src="<?php echo plugin_dir_url( __FILE__ ) ?>img/admin_styles.png" title="Ultimate Tinymce Custom Styles" /></center></span> <?php
					}
					?>    
                    </div></div>
                    
                    <div id="clickme4" class="content_wrapper_addons"><?php
					_e('<a target="_blank" title="Add a list of over 80 predefined styles to your editor." href="http://www.plugins.joshlobe.com/predefined-custom-styles/"><span style="font-family:\'Unlock\', cursive;">Pre-Defined Styles</span></a>','jwl-ultimate-tinymce'); ?> <span class="span_hover"><?php _e('(Toggle)','jwl-ultimate-tinymce'); ?></span>
                    <div id="me4" style="display:none;margin-top:10px;"><?php
					if (is_plugin_active('ultimate_tinymce_predefined_styles/main.php')) {
					_e('<span style="color:green;">Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/check.png" class="activation_icons" title="This addon has been installed and activated successfully." /> <?php
					} else {
					_e('<span style="color:red;">Not Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/warning.png" class="activation_icons" title="This addon has NOT been activated." /><br /><br /><span class="plugin_addons"> <?php _e('A collection of my custom styles.  No need to create your own.<br /><br />Install this plugin and have instant access to over 80 custom styles (and growing).','jwl-ultimate-tinymce'); ?> </span> <?php
					}
					?>    
                    </div>
                    </div>
                    
                    <div id="clickme5" class="content_wrapper_addons"><?php
					_e('<a target="_blank" title="Apply six unique color settings to your admin panel." href="http://www.plugins.joshlobe.com/wp-admin-colors/"><span style="font-family:\'Unlock\', cursive;">WP Admin Colors</span></a>','jwl-ultimate-tinymce'); ?> <span class="span_hover"><?php _e('(Toggle)','jwl-ultimate-tinymce'); ?></span>
                    <div id="me5" style="display:none;margin-top:10px;"><?php
					if (is_plugin_active('wp-admin-colors/main.php')) {
					_e('<span style="color:green;">Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/check.png" class="activation_icons" title="This addon has been installed and activated successfully." /> <?php
					} else {
					_e('<span style="color:red;">Not Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/warning.png" class="activation_icons" title="This addon has NOT been activated." /><br /><br /><span class="plugin_addons"> <?php _e('Here is a compliment to the color selection for the tinymce editor. This addon will provide a choice of six unique stylesheets to apply to the entire admin panel dashboard.','jwl-ultimate-tinymce'); ?> </span> <?php
					}
					?>    
                    </div>
                    </div>
                    <br />
                    <div style="clear:both"></div>
                    <br />
                    <div id="clickme" class="content_wrapper_addons" style="margin-top:-10px;"><?php
					_e('<a target="_blank" title="Take powerful control over the visual tinymce editor." href="http://www.plugins.joshlobe.com/ultimate-tinymce-advanced-configuration/"><span style="font-family:\'Unlock\', cursive;">Advanced Configuration</span></a>','jwl-ultimate-tinymce'); ?> <span class="span_hover"><?php _e('(Toggle)','jwl-ultimate-tinymce'); ?></span>
                    <div id="me" style="display:none;margin-top:10px;"><?php
					if (is_plugin_active('ultimate-tinymce-advanced-configuration/main.php')) {
					_e('<span style="color:green;">Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/check.png" class="activation_icons" title="This addon has been installed and activated successfully." /> <?php
					} else {
					_e('<span style="color:red;">Not Activated</span>','jwl-ultimate-tinymce');
					?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/warning.png" class="activation_icons" title="This addon has NOT been activated." /><br /><br /><span class="plugin_addons"> <?php _e('Take advanced control over your visual tinymce editor.  Control settings such as button placement, font sizes, date and time formats, and more.','jwl-ultimate-tinymce'); ?> </span> <?php
					}
					?>    
                    </div>
                    </div>
                    
             </div>
        </div>
        
        <div class="content tutorials">
        	<div class="main_help_wrapper">
            <span class="content_title">
			<?php _e('Donations:','jwl-ultimate-tinymce'); ?></span><br /><br />
            	<div class="content_wrapper_tips">
                <span class="content_wrapper_title"><?php _e('Support the Developer','jwl-ultimate-tinymce'); ?></span><br />
				<?php _e('Developing this awesome plugin took a lot of effort and time; months and months of continuous voluntary unpaid work.','jwl-ultimate-tinymce'); ?>
                <br /><br /><center>
                     <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                     <input type="hidden" name="cmd" value="_s-xclick">
                     <input type="hidden" name="hosted_button_id" value="A9E5VNRBMVBCS">
                     <input type="image" src="<?php echo plugin_dir_url( __FILE__ ) ?>img/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                     <img alt="PayPal - The safer, easier way to pay online!" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                     </form>
                </center><br />
                <?php _e('If you like this plugin or if you are using it for commercial websites, please consider a donation to the author to help support future updates and development.','jwl-ultimate-tinymce'); ?>
            </div>
        
                <div class="content_wrapper_tips">
                <?php _e('<span class="content_wrapper_title">Main uses of Donations</span><ul class="help_tab_list_image"><li>Web Hosting Fees</li><li>Cable Internet Fees</li><li>Time/Value Reimbursement</li><li>Motivation for Continuous Improvements</li><li>Sunday Father-Daughter Day</li></ul>','jwl-ultimate-tinymce'); ?>
                </div>
                
                <div class="content_wrapper_tips">
                <span class="content_wrapper_title"><?php _e('Donate Securely via Paypal','jwl-ultimate-tinymce'); ?></span><br />
                	<center><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                     <input type="hidden" name="cmd" value="_s-xclick">
                     <input type="hidden" name="hosted_button_id" value="A9E5VNRBMVBCS">
                     <input type="image" src="<?php echo plugin_dir_url( __FILE__ ) ?>img/paypal.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="margin-top:30px;">
                     <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                     </form>
                     </center>
                </div>
        	</div>
        </div>  
        
        <div class="content spread">
        	<div class="main_help_wrapper">
            <span class="content_title">
			<?php _e('Spread the Word:','jwl-ultimate-tinymce'); ?></span><br /><br />
            	<div class="content_wrapper_tips">
                <span class="content_wrapper_title">
                <?php _e('Blog about this Plugin','jwl-ultimate-tinymce'); ?>
                </span><br />
                	<div class="blog_image">
                    <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/blog.png" />
                    </div>
                    <div style="float:left;width:67%;">
                <?php _e('<ul class="help_tab_list_image"><li>Do you like this plugin, and use it regularly on your site?</li><li>Why not write a brief article recommending it to your readers and other wordpress blogger buddies?</li><li>Include a link to the plugin download page to make it easy for your readers to access.</li></ul>','jwl-ultimate-tinymce'); ?>
                	</div>
                </div>
                <div class="content_wrapper_tips">
                <span class="content_wrapper_title">
                <?php _e('Vote and Click Works','jwl-ultimate-tinymce'); ?>
                </span><br />
                	<div class="vote_image">
                    <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/works.png" />
                    </div>
                    <div style="float:left;width:60%;">
                <?php _e('Please take a few moments to visit the plugin download page to vote and click "Works".  You must have an account on wordpress to rate and vote. Signing up is quick and easy.<br /><br />Also, each time a new plugin update is available, it resets the "Works" count.  So, please do this each time you update the plugin.<br /><br /><a target="_blank" href="http://wordpress.org/extend/plugins/ultimate-tinymce/">Ultimate Tinymce Wordpress Page</a>','jwl-ultimate-tinymce'); ?>
                	</div>
                </div>
                <div class="content_wrapper_tips">
                <span class="content_wrapper_title">
                <?php _e('Twitter & Facebook','jwl-ultimate-tinymce'); ?>
                </span><br />
                	<div style="float:left;width:100%;margin-top:20px;">
                    <center>
                    <a target="_blank" href="https://twitter.com/"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/twitter.png" /></a><br />
                    <a target="_blank" href="https://www.facebook.com/"><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/facebook.png" /></a>
                    </center>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content tips"> 
        	<div class="main_help_wrapper"><span class="content_title"><?php _e('Tips and Tricks for the Admin Panel', 'jwl-ultimate-tinymce'); ?></span><br /><br />
            	<div class="content_wrapper_tips">
            	<?php _e('<span class="content_wrapper_title">Screen Options:</span><ul class="help_tab_list_image"><li>Click the "Screen Options" tab in the upper-right corner to enable further customization.</li><li>Set the Screen Columns to "2" for best results.</li><li>Decide which Meta-Boxes to show or hide.</li><li>Selections are saved in the database.</li></ul>','jwl-ultimate-tinymce'); ?>
                </div>
                <div class="content_wrapper_tips">
            	<?php _e('<span class="content_wrapper_title">Meta Boxes:</span><ul class="help_tab_list_image"><li>Each Meta-Box can be clicked to collapse/expand the contents of the box.</li><li>Boxes can be sorted by clicking and dragging the title area to a new location.</li><li>Open/Closed status and sorting arrangement are saved in the database.  So each time the page is visited; the last chosen layout remains.</li></ul>','jwl-ultimate-tinymce'); ?>
                </div>
                <div class="content_wrapper_tips">
            	<?php _e('<span class="content_wrapper_title">Button Row Selection:</span><ul class="help_tab_list_image"><li>Each button from this plugin can be assigned to one of the four rows of the editor.</li><li>For suggested best results, set all buttons used in "Group One Buttons" to Row 3 and set all buttons used in "Group Two Buttons" to Row 4.  <em>This is only recommended, and not mandatory.</em></li><li>If the buttons scroll off the editor screen, come back here and select a different row for those buttons.</li></ul>','jwl-ultimate-tinymce'); ?>
                </div>
            </div>
        </div>
        
        <div class="content defaults"> 
          <div class="main_help_wrapper"><span class="content_title"><?php _e('Load developers suggested settings.', 'jwl-ultimate-tinymce'); ?></span><br /><br />
                <div class="content_wrapper_tips" style="width:60%;">
                <?php jwl_ultimate_tinymce_load_defaults(); ?>
                </div>
          </div>
        </div>
        
        <div class="content links"> 
        	<div class="main_help_wrapper"><span class="content_title"><?php _e('Uninstall Plugin & Delete Database Entries:', 'jwl-ultimate-tinymce'); ?></span><br /><br />
            	<div class="content_wrapper_tips">
            	<?php jwl_ultimate_tinymce_form_uninstall(); ?>
                </div>
                <div class="content_wrapper_tips" style="height:349px;">
                <center><img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/uninstall1.png" style="margin-top:120px;" /></center>
                </div>
            </div>
        </div>  
    </div>  
                    
			
    <div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
        <div id="side-info-column" class="inner-sidebar">                        
            <?php do_meta_boxes($this->pagehook, 'side', $data); ?>
        </div>
        <div id="post-body" class="has-sidebar">
            <div id="post-body-content" class="has-sidebar-content">
                <?php do_meta_boxes($this->pagehook, 'normal', $data); ?>
                <?php //do_meta_boxes($this->pagehook, 'additional', $data); ?>
            </div>
        </div>
        <br class="clear"/>			
   </div>	
   
</div>
	<script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready( function($) { $('.if-js-closed').removeClass('if-js-closed').addClass('closed'); postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>'); });
        //]]>
    </script>
    <script type="text/javascript"> jQuery(document).ready( function($) { $("#allsts").click(function() { $(".one").attr('checked', true); }); $("#nosts").click(function() { $(".one").attr('checked', false); }); $('.one' ).each( function() { var isitchecked = this.checked; }); });
    </script>
    <script type="text/javascript"> jQuery(document).ready( function($) { $("#allsts2").click(function() { $(".two").attr('checked', true); }); $("#nosts2").click(function() { $(".two").attr('checked', false); }); $('.two' ).each( function() { var isitchecked = this.checked; }); });
    </script>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript"> $(document).ready(function() { $('#clickme').click(function() { $('#me').animate({ height: 'toggle' }, 300 ); }); }); </script>
    <script type="text/javascript"> $(document).ready(function() { $('#clickme2').click(function() { $('#me2').animate({ height: 'toggle' }, 300 ); }); }); </script>
    <script type="text/javascript"> $(document).ready(function() { $('#clickme3').click(function() { $('#me3').animate({ height: 'toggle' }, 300 ); }); }); </script>
    <script type="text/javascript"> $(document).ready(function() { $('#clickme4').click(function() { $('#me4').animate({ height: 'toggle' }, 300 ); }); }); </script>
    <script type="text/javascript"> $(document).ready(function() { $('#clickme5').click(function() { $('#me5').animate({ height: 'toggle' }, 300 ); }); }); </script>
    <script type="text/javascript" src="tabs.js"></script>
            <script type="text/javascript">
			$(document).ready(function(){  
    $(".menu > li").click(function(e){  
        switch(e.target.id){  
            case "news":  
                //change status &amp;amp;amp; style menu  
                $("#news").addClass("active");  
                $("#tutorials").removeClass("active");  
				$("#spread").removeClass("active");
				$("#tips").removeClass("active");
				$("#defaults").removeClass("active");
                $("#links").removeClass("active");  
                //display selected division, hide others  
                $("div.news").fadeIn();  
                $("div.tutorials").css("display", "none"); 
				$("div.spread").css("display", "none"); 
				$("div.tips").css("display", "none");
				$("div.defaults").css("display", "none");
                $("div.links").css("display", "none");  
            break;  
            case "tutorials":  
                //change status &amp;amp;amp; style menu  
                $("#news").removeClass("active");  
                $("#tutorials").addClass("active"); 
				$("#spread").removeClass("active"); 
				$("#tips").removeClass("active");
				$("#defaults").removeClass("active");
                $("#links").removeClass("active");  
                //display selected division, hide others  
                $("div.tutorials").fadeIn();  
                $("div.news").css("display", "none"); 
				$("div.spread").css("display", "none"); 
				$("div.tips").css("display", "none");
				$("div.defaults").css("display", "none");
                $("div.links").css("display", "none");  
            break; 
			case "spread":  
                //change status &amp;amp;amp; style menu  
                $("#news").removeClass("active");  
                $("#tutorials").removeClass("active");  
				$("#spread").addClass("active");
				$("#tips").removeClass("active");
				$("#defaults").removeClass("active");
                $("#links").removeClass("active");  
                //display selected division, hide others  
                $("div.spread").fadeIn();  
				$("div.tips").css("display", "none");
                $("div.news").css("display", "none");  
                $("div.tutorials").css("display", "none");  
				$("div.links").css("display", "none");
				$("div.defaults").css("display", "none");
            break; 
			case "tips":  
                //change status &amp;amp;amp; style menu  
                $("#news").removeClass("active");  
                $("#tutorials").removeClass("active");  
				$("#spread").removeClass("active");  
				$("#tips").addClass("active");
				$("#defaults").removeClass("active");
                $("#links").removeClass("active");  
                //display selected division, hide others  
				$("div.tips").fadeIn();
                $("div.spread").css("display", "none"); 
                $("div.news").css("display", "none");  
                $("div.tutorials").css("display", "none");  
				$("div.links").css("display", "none");
				$("div.defaults").css("display", "none");
            break; 
			case "defaults":  
                //change status &amp;amp;amp; style menu  
                $("#news").removeClass("active");  
                $("#tutorials").removeClass("active");  
				$("#spread").removeClass("active");  
				$("#defaults").addClass("active");
				$("#tips").removeClass("active");  
                $("#links").removeClass("active");  
                //display selected division, hide others  
				$("div.defaults").fadeIn();
				$("div.tips").css("display", "none");
                $("div.spread").css("display", "none"); 
                $("div.news").css("display", "none");  
                $("div.tutorials").css("display", "none");  
				$("div.links").css("display", "none");
            break; 
            case "links":  
                //change status &amp;amp;amp; style menu  
                $("#news").removeClass("active");  
                $("#tutorials").removeClass("active");  
				$("#spread").removeClass("active");
				$("#tips").removeClass("active");
				$("#defaults").removeClass("active");
                $("#links").addClass("active");  
                //display selected division, hide others  
                $("div.links").fadeIn();  
                $("div.news").css("display", "none");  
                $("div.tutorials").css("display", "none");  
				$("div.spread").css("display", "none");
				$("div.tips").css("display", "none");
				$("div.defaults").css("display", "none");
            break;  
        }  
        //alert(e.target.id);  
        return false;  
    });  
});  
</script>
			
			<?php
		}
		
		// Executed if the post arrives initiated by pressing the submit button of form
		function on_save_changes() {
			//user permission check
			if ( !current_user_can('manage_options') )
				wp_die( __('Cheatin&#8217; uh?') );			
			//cross check the given referer
			check_admin_referer('ultimate-tinymce-general');
		
			//process here your on $_POST validation and / or option saving
		
			//lets redirect the post request into get request (you may add additional params at the url, if you need to show save results
			wp_redirect($_POST['_wp_http_referer']);		
		}
		
		// Below you will find for each registered metabox the callback method, that produces the content inside the boxes
		function buttons_group_1($data) {
			sort($data);
			?><form action="options.php" method="post" name="jwl_main_options"><?php
			do_settings_sections('ultimate-tinymce1');
			settings_fields('jwl_options_group'); ?>
			<span style="padding-left:10px;"><input type="button" id="allsts" value="Check All"><input type="button" id="nosts" value="UnCheck All"><span style="margin-left:130px;"><input class="button-primary" type="submit" name="Save" style="padding-left:40px;padding-right:40px;" value="<?php _e('Update Options','jwl-ultimate-tinymce'); ?>" id="submitbutton" /></span></span>
			<?php
		}
		function buttons_group_2($data) {
			sort($data);
			do_settings_sections('ultimate-tinymce2');
			settings_fields('jwl_options_group'); ?>
			<span style="padding-left:10px;"><input type="button" id="allsts2" value="Check All"><input type="button" id="nosts2" value="UnCheck All"><span style="margin-left:130px;"><input class="button-primary" type="submit" name="Save" style="padding-left:40px;padding-right:40px;" value="<?php _e('Update Options','jwl-ultimate-tinymce'); ?>" id="submitbutton" /></span></span>
			<?php
		}
		function buttons_group_3($data) {
			sort($data);
			do_settings_sections('ultimate-tinymce3');
			settings_fields('jwl_options_group');
			?>
			<center><input class="button-primary" type="submit" name="Save" style="padding-left:40px;padding-right:40px;" value="<?php _e('Update Options','jwl-ultimate-tinymce'); ?>" id="submitbutton" /></center>
			<?php
		}
		function buttons_group_4($data) {
			sort($data);
			do_settings_sections('ultimate-tinymce4');
			settings_fields('jwl_options_group');
			?>
			<center><input class="button-primary" type="submit" name="Save" style="padding-left:40px;padding-right:40px;" value="<?php _e('Update Options','jwl-ultimate-tinymce'); ?>" id="submitbutton" /></center>
			</form>
			<?php
		}
		function postbox_resources($data) {
			sort($data);
			?>
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/support.png" style="margin-bottom: -8px;" />
			<a href="http://forum.joshlobe.com/member.php?action=register&referrer=1" target="_blank"><?php _e('Get help from the Support Forum.','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/screencast.png" style="margin-bottom: -8px;" />
			<a href="http://www.youtube.com/watch?v=fM3CUo9MxMc" target="_blank"><?php _e('Screencast part one','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/screencast.png" style="margin-bottom: -8px;" />
			<a href="http://www.youtube.com/watch?v=5raIBxGP17g" target="_blank"><?php _e('Screencast part two','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/help.png" style="margin-bottom: -8px;" />
			<a href="http://www.joshlobe.com/2011/10/ultimate-tinymce/" target="_blank"><?php _e('Get help from my personal blog.','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/thread.png" style="margin-bottom: -8px;" />
			<a href="http://wordpress.org/tags/ultimate-tinymce?forum_id=10#postform" target="_blank"><?php _e('Post a thread in the Wordpress Forums.','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/email.png" style="margin-bottom: -8px;" />
			<a href="http://www.joshlobe.com/contact-me/" target="_blank"><?php _e('Email me directly using my contact form.','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/rss.png" style="margin-bottom: -8px;" />
			<a href="http://www.joshlobe.com/feed/" target="_blank"><?php _e('Subscribe to my RSS Feed.','jwl-ultimate-tinymce'); ?></a><br /><br />
			<img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/follow.png" style="margin-bottom: -8px;" />
			<?php _e('Follow me on ','jwl-ultimate-tinymce'); ?><a target="_blank" href="http://www.facebook.com/joshlobe"><?php _e('Facebook','jwl-ultimate-tinymce'); ?></a>    <?php _e(' and ','jwl-ultimate-tinymce'); ?><a target="_blank" href="http://twitter.com/#!/joshlobe"><?php _e('Twitter','jwl-ultimate-tinymce'); ?></a>.<br /> <?php
		}
		function postbox_firefox($data) {
			sort($data);
			_e('In all honesty, the tinymce editor works best with the Mozilla Firefox browser.  If you are not a Firefox user, you might want to consider giving it a try when creating your content.  You can download the free browser by clicking the image below.','jwl-ultimate-tinymce'); ?>
			<br /><br /><center><a target="_blank" href="http://affiliates.mozilla.org/link/banner/6906"><img src="http://affiliates.mozilla.org/media/uploads/banners/download-small-blue-EN.png" alt="Download: Fast, Fun, Awesome" /></a></center>
			<?php
		}
		function postbox_vote($data) {
			sort($data);
			?> <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/vote.png" style="margin-bottom: -8px;" /> <a href="http://wordpress.org/extend/plugins/ultimate-tinymce/" target="_blank"><?php _e('Click Here to Vote and click "Works"...','jwl-ultimate-tinymce'); ?></a><br /><br /><?php _e('Voting helps my plugin get more exposure and higher rankings on the searches.<br /><br />Clicking "Works" on the Wordpress plugin download page shows others that Ultimate TinyMCE is stable, and encourages their download.','jwl-ultimate-tinymce'); ?><br /><br /><?php _e('Please help spread this wonderful plugin by showing your support.  Thank you!','jwl-ultimate-tinymce');
		}
		function postbox_blog($data) {
		($data);
			sort($data);
			_e('Like this plugin?  Blog about it on your website, link to my plugin page on my website <a target="_blank" href="http://www.joshlobe.com/2011/10/ultimate-tinymce/">HERE</a>, and I will add your website link here.','jwl-ultimate-tinymce'); _e('<br /><br /><strong>Special Thanks to these bloggers:</strong><br /><ul><li><a href="http://www.buzzing-t.nl/" target="_blank">Buzzing-t.nl</a></li><li><a href="http://onewhole.eu/" target="_blank">Onewhole.eu</a></li><li><a href="http://www.vanytastisch.ch/" target="_blank">Vanytastisch.ch</a></li><li><a href="http://animereviews.co" target="_blank">Animereviews.co</a></li><li><a href="http://blogigs.com/how-to-make-a-attractive-blog-post/" target="_blank">Blogigs</a></li><li><a href="http://www.untetheredincome.com/articles/wordpress/best-wordpress-plugins-2012/" target="_blank">Untethered Income</a></li><li><a href="http://www.bowierocks.com" target="_blank">BowieRocks</a></li></ul>', 'jwl-ultimate-tinymce');
		}
		function postbox_feedback($data) {
			sort($data);
			_e('Please take a moment to complete the short feedback form below.  Your input is greatly appreciated.  All input fields are optional.','jwl-ultimate-tinymce'); ?><br /><br />
					<div style="border:1px solid #999999;padding:5px;"><!-- Begin Freedback Form -->
		<!-- DO NOT EDIT YOUR FORM HERE, PLEASE LOG IN AND EDIT AT FREEDBACK.COM -->
		<form enctype="multipart/form-data" method="post" action="http://www.freedback.com/mail.php" accept-charset="UTF-8">
		<div>
			<input type="hidden" name="acctid" id="acctid" value="8a44jw4rc6tihuqh" />
			<input type="hidden" name="formid" id="formid" value="1035543" />
		</div>
		<table cellspacing="2" cellpadding="2" border="0">
			<tr><td valign="top"><strong>Name: (Optional)</strong></td></tr>
			<tr><td valign="top"><input type="text" name="name" id="name" size="40" value="" /></td></tr>
			<tr><td valign="top"><strong>Email Address: (Optional)</strong></td></tr>
			<tr><td valign="top"><input type="text" name="email" id="email" size="40" value="" /></td></tr>
			<tr><td valign="top"><strong>Would you recommend this plugin to a friend?</strong></td></tr>
			<tr><td valign="top">
					<select name="field-45f3fdce1a0bc05" id="field-45f3fdce1a0bc05">
						<option value=""></option><option value="Most Definitely">Most Definitely</option><option value="Probably">Probably</option><option value="Maybe">Maybe</option><option value="Probably Not">Probably Not</option><option value="Definitely Not??">Definitely Not</option>
					</select>
			</td></tr>
			<tr><td valign="top"><strong>How would you rate this plugin?</strong></td></tr>
			<tr><td valign="top">
					<select name="field-d8c8cf7b3175e69" id="field-d8c8cf7b3175e69">
						<option value=""></option><option value="5 Stars">5 Stars</option><option value="4 Stars">4 Stars</option><option value="3 Stars">3 Stars</option><option value="2 Stars">2 Stars</option><option value="1 Star">1 Star</option><option value="0 Stars">0 Stars</option>
					</select>
			</td></tr>
			<tr><td valign="top"><strong>Do you find the new &quot;Help&quot; popups useful?</strong></td></tr>
			<tr><td valign="top">
					<select name="field-dbfb7a0c6afa91c" id="field-dbfb7a0c6afa91c">
						<option value=""></option><option value="Absolutely">Absolutely</option><option value="A Little">A Little</option><option value="Not Really">Not Really</option>
					</select>
			</td></tr>
			<tr><td valign="top"><strong>Have you rated this plugin and clicked &quot;Works&quot; on the <a target="_blank" href="http://wordpress.org/extend/plugins/ultimate-tinymce/">wordpress plugin download page</a>?</strong></td></tr>
			<tr><td valign="top">
					<select name="field-05f800de9d39cb5" id="field-05f800de9d39cb5">
						<option value=""></option><option value="I Already have.">I Already have.</option><option value="Doing it now.">Doing it now.</option><option value="No Way.">No Way.</option><option value="What&#39;s That?">What&#39;s That?</option>
					</select>
			</td></tr>
			<tr><td valign="top"><strong>Have you looked at any of these?  (Check all that apply)</strong></td></tr>
			<tr><td valign="top">
					<input type="checkbox" name="field-2a733a58a89d340[]" id="field-2a733a58a89d340_0" value="Support Forum" /> Support Forum<br/>
					<input type="checkbox" name="field-2a733a58a89d340[]" id="field-2a733a58a89d340_1" value="Microsoft Word Help Document" /> Microsoft Word Help Document<br/>
					<input type="checkbox" name="field-2a733a58a89d340[]" id="field-2a733a58a89d340_2" value="&quot;Help&quot; Popups" /> &quot;Help&quot; Popups<br/>
			</td></tr>
			<tr><td valign="top"><strong>Please feel free to leave any additional feedback here...</strong></td></tr>
			<tr><td valign="top"><center><textarea name="field-b0cb8c2a6a616ee" id="field-b0cb8c2a6a616ee" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" rows="6" cols="35">Type your feedback here...</textarea></center></td></tr>
			<tr><td colspan="2" align="center"><input type="submit" value=" Submit Form " /></td></tr>
		</table>
		</form>
		<br><center><font face="Arial, Helvetica" size="1"><b>Put a <a href="http://www.freedback.com">website form</a> like this on your site.</b></font><br /><br /><strong>Please click the "Continue" text on the next page after submission to return to this page.</strong></center></div> <?php
		}
		function postbox_poll($data) {
			sort($data);
			_e('New Plugin Features...','jwl-ultimate-tinymce'); ?><br /><br /><?php _e('There are a few features I have been wanting to implement; but have found they are going to require more work than I originally anticipated.<br /><br />In the meantime, I\'d like to take a poll of which features you consider to be of a higher priority.  Please vote on your favorite requested feature.  You can vote once per day.<br /><br />','jwl-ultimate-tinymce'); ?>
					
					<!-- // Begin Pollhost.com Poll Code // -->
		<div style="border:1px solid black;">
		<form method=post action=http://poll.pollhost.com/vote.cgi><table border=0 width=100% bgcolor=#EEEEEE cellspacing=0 cellpadding=2><tr><td colspan=2><font face="Verdana" size=-1 color="#000000"><b>Which feature would you like to see?</b></font></td></tr><tr><td width=5><input type=radio name=answer value=1></td><td><font face="Verdana" size=-1 color="#000000">Better Tables Control and Usage</font></td></tr><tr><td width=5><input type=radio name=answer value=2></td><td><font face="Verdana" size=-1 color="#000000">Better Cross-Browser Compatibility</font></td></tr><tr><td width=5><input type=radio name=answer value=3></td><td><font face="Verdana" size=-1 color="#000000">More examples in the Help Popups</font></td></tr><tr><td width=5><input type=radio name=answer value=4></td><td><font face="Verdana" size=-1 color="#000000">A Shortcodes Manager</font></td></tr><tr><td width=5><input type=radio name=answer value=5></td><td><font face="Verdana" size=-1 color="#000000">A Custom Styles Manager</font></td></tr><tr><td colspan=2><input type=hidden name=config value="am9zaDQwMQkxMzI2NjkxMDQ5CUVFRUVFRQkwMDAwMDAJVmVyZGFuYQlBc3NvcnRlZA"><center><input type=submit value=Vote>&nbsp;&nbsp;<input type=submit name=view value=View></center></td></tr><tr><td bgcolor=#FFFFFF colspan=2 align=right><font face="Verdana" size=-2 color="#000000"><a href=http://www.pollhost.com/><font color=#000099>Free polls from Pollhost.com</font></a></font></td></tr></table></form>
		</div> <?php
		}
}
$my_jwl_metabox_admin = new jwl_metabox_admin();


?>