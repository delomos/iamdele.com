<?php
/*
		Plugin Name: Wp Social Toolbar Pro
		Version: 1.2
		Description: Wordpress plugin for adding a customizable toolbar with color selection, social network icons, recent tweet and share buttons in footer.
		Author: DaddyDesign
		Tags: footer, toolbar, social networking, social icons, tool bar, share, facebook like, tweet, recent tweet, facebook, twitter, settings, customize, colors,wibiya, social toolbar,google +1,google plusone,plusone,google share
		Author URI: http://www.daddydesign.com
		License: http://socialtoolbarpro.com/social-toolbar-pro-end-user-license-agreement/
	
*/

/* Check Current Wordpress Version */
global $wp_version;	
$plugin_name="Wp Social Toolbar Pro";
$exit_msg=$plugin_name.' requires WordPress 3.0 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (version_compare($wp_version,"2.9","<"))
{
	exit ($exit_msg);
}

/* LOAD PLUGIN LANGUAGE FILES */
load_plugin_textdomain('WPSOCIALTOOLBARPRO',false,'wp-social-toolbar-pro/languages');

/* Define Content URL PATH */
if (!defined('WP_CONTENT_URL')) {
	$content_url=content_url();
	define('WP_CONTENT_URL', $content_url);
}


/* Constants */
define('WP_SOCIAL_TOOLBAR_PRO_PATH',WP_CONTENT_URL.'/plugins/wp-social-toolbar-pro/');


global $WpSTProDefaults,$WpSTProSettings,$WpSTProProProfiles,$WpSTProProfileSettings,$wpstpro_version;

$wpstpro_version=1.0;

$WpSTProSettings=get_option('DDWpSTProOptions');
$WpSTProProfileSettings=get_option('DDWpSTProfiles');
$rss_url='';
$WpSTProProProfiles=array(
'0'=>array('name'=>'RSS','url'=>'','order'=>0,'enable'=>1),
'1'=>array('name'=>'twitter','url'=>'daddydesign','order'=>1,'enable'=>1),
'2'=>array('name'=>'facebook','url'=>'','order'=>2,'enable'=>1),
'3'=>array('name'=>'myspace','url'=>'','order'=>3,'enable'=>1),
'4'=>array('name'=>'LinkedIn','url'=>'','order'=>4,'enable'=>1),
'5'=>array('name'=>'flickr','url'=>'','order'=>5,'enable'=>1),
'6'=>array('name'=>'vimeo','url'=>'','order'=>6,'enable'=>1),
'7'=>array('name'=>'YouTube','url'=>'','order'=>7,'enable'=>1),
'8'=>array('name'=>'apple','url'=>'','order'=>8,'enable'=>1),
'9'=>array('name'=>'bebo','url'=>'','order'=>9,'enable'=>1),
'10'=>array('name'=>'Dribble','url'=>'','order'=>0,'enable'=>0),
'11'=>array('name'=>'foursquare','url'=>'','order'=>11,'enable'=>0),
'12'=>array('name'=>'hi5','url'=>'','order'=>12,'enable'=>0),
'13'=>array('name'=>'iLike','url'=>'','order'=>13,'enable'=>0),
'14'=>array('name'=>'ning','url'=>'','order'=>14,'enable'=>0),
'15'=>array('name'=>'ping','url'=>'','order'=>15,'enable'=>0),
'16'=>array('name'=>'reverbnation','url'=>'','order'=>16,'enable'=>0),
'17'=>array('name'=>'Skype','url'=>'','order'=>17,'enable'=>0),
'18'=>array('name'=>'Lastfm','url'=>'','order'=>18,'enable'=>0),
'19'=>array('name'=>'MeetUp','url'=>'','order'=>19,'enable'=>0),
'20'=>array('name'=>'Orkut','url'=>'','order'=>20,'enable'=>0),
'21'=>array('name'=>'StumbleUpon','url'=>'','order'=>21,'enable'=>0),
'22'=>array('name'=>'Digg','url'=>'','order'=>22,'enable'=>0),
'23'=>array('name'=>'Tumblr','url'=>'','order'=>23,'enable'=>0),
'24'=>array('name'=>'Xing','url'=>'','order'=>24,'enable'=>0),
'25'=>array('name'=>'Beatport','url'=>'','order'=>25,'enable'=>0),
'26'=>array('name'=>'SoundCloud','url'=>'','order'=>26,'enable'=>0),
'27'=>array('name'=>'Spotify','url'=>'','order'=>27,'enable'=>0),
'28'=>array('name'=>'Behance','url'=>'','order'=>28,'enable'=>0),
'29'=>array('name'=>'BlinkList','url'=>'','order'=>29,'enable'=>0),
'30'=>array('name'=>'Current','url'=>'','order'=>30,'enable'=>0),
'31'=>array('name'=>'Delicious','url'=>'','order'=>31,'enable'=>0),
'32'=>array('name'=>'DesignFloat','url'=>'','order'=>32,'enable'=>0),
'33'=>array('name'=>'Designmoo','url'=>'','order'=>33,'enable'=>0),
'34'=>array('name'=>'DeviantArt','url'=>'','order'=>34,'enable'=>0),
'35'=>array('name'=>'Diigo','url'=>'','order'=>35,'enable'=>0),
'36'=>array('name'=>'DZone','url'=>'','order'=>36,'enable'=>0),
'37'=>array('name'=>'Email','url'=>'','order'=>37,'enable'=>0),
'38'=>array('name'=>'Fark','url'=>'','order'=>38,'enable'=>0),
'39'=>array('name'=>'Formspring','url'=>'','order'=>39,'enable'=>0),
'40'=>array('name'=>'FriendFeed','url'=>'','order'=>40,'enable'=>0),
'41'=>array('name'=>'Google+','url'=>'','order'=>41,'enable'=>0),
'42'=>array('name'=>'GrooveShark','url'=>'','order'=>42,'enable'=>0),
'43'=>array('name'=>'Klout','url'=>'','order'=>43,'enable'=>0),
'44'=>array('name'=>'LoveDSGN','url'=>'','order'=>44,'enable'=>0),
'45'=>array('name'=>'MisterWong','url'=>'','order'=>45,'enable'=>0),
'46'=>array('name'=>'Yahoo','url'=>'','order'=>46,'enable'=>0),
'47'=>array('name'=>'Netvouz','url'=>'','order'=>47,'enable'=>0),
'48'=>array('name'=>'Newsvine','url'=>'','order'=>48,'enable'=>0),
'49'=>array('name'=>'PingFM','url'=>'','order'=>49,'enable'=>0),
'50'=>array('name'=>'PlayStationNetwork','url'=>'','order'=>50,'enable'=>0),
'51'=>array('name'=>'Posterous','url'=>'','order'=>51,'enable'=>0),
'52'=>array('name'=>'Reddit','url'=>'','order'=>52,'enable'=>0),
'53'=>array('name'=>'ShareThis','url'=>'','order'=>53,'enable'=>0),
'54'=>array('name'=>'Technorati','url'=>'','order'=>54,'enable'=>0),
'55'=>array('name'=>'Tout','url'=>'','order'=>55,'enable'=>0),
'56'=>array('name'=>'Wanttt','url'=>'','order'=>56,'enable'=>0),
'57'=>array('name'=>'XBoxLive','url'=>'','order'=>57,'enable'=>0),
'58'=>array('name'=>'Yelp','url'=>'','order'=>58,'enable'=>0),
'59'=>array('name'=>'Zootool','url'=>'','order'=>59,'enable'=>0),
'60'=>array('name'=>'Aim','url'=>'','order'=>60,'enable'=>0),
'61'=>array('name'=>'Flout','url'=>'','order'=>61,'enable'=>0),
'62'=>array('name'=>'Forrst','url'=>'','order'=>62,'enable'=>0),
'63'=>array('name'=>'GitHub','url'=>'','order'=>63,'enable'=>0),
'64'=>array('name'=>'Gowalla','url'=>'','order'=>64,'enable'=>0),
'65'=>array('name'=>'Rdio','url'=>'','order'=>65,'enable'=>0)
);

$WpSTProDefaults=array(
'background_color'=>'000000', //Default Background Color
'twitter_background'=>'999999', //Twitter Background Color
'border_color'=>'666666', //Border Color
'icon_type'=>'gray', //Icon Type
'font_family'=>'Arial, Helvetica, sans-serif', //Font Family
'font_size'=>'12px', //Font Size
'font_color'=>'ffffff', //Font Color
'link_color'=>'ffffff', //Link Color
'button_color'=>'white', // Button color
'bird_color'=>'white', //Link Color
'show_tweeter'=>'yes', // Show Tweeter Message
'hover_background'=>'ffffff', // Hover Image Background Color
'rss_url'=>$rss_url, //RSS URL,
'home_page'=>1, //RSS URL,
'category_archive'=>1, //RSS URL,
'blog_single_post'=>'blog_single_post',
'share_home'=>'true',
'google_plus_one'=>'false',
'max_icons'=>14,
'facebook_setting'=>'false',
'fan_page'=>'https://www.facebook.com/wordpressdesign',
'user_role'=>'administrator',
'icon_size'=>'normal',
'position'=>'bottom',
'daddydesign_logo'=>'false',
'twitter_timestamp'=>'true'
);



/*Function to Call when Plugin get activated*/
function DDWpSTPro_activate()
{
	global $WpSTProDefaults,$values,$WpSTProProProfiles;
	$default_settings = get_option('DDWpSTProOptions');
	$default_settings= wp_parse_args($default_settings, $WpSTProDefaults);
	$default_social_settings = get_option('DDWpSTProfiles');
	$default_social_settings= wp_parse_args($default_social_settings, $WpSTProProProfiles);
	add_option('DDWpSTProOptions',$default_settings);
	add_option('DDWpSTProfiles',$default_social_settings);
}

/* Function to Call when Plugin Deactivated */
function DDWpSTPro_deactivate()
{
	//delete_option('DDWpSTProOptions');
	//delete_option('DDWpSTProfiles');
  /* Code needs to be added for deactivate action */
}

register_activation_hook( __FILE__, 'DDWpSTPro_activate' );
register_deactivation_hook( __FILE__, 'DDWpSTPro_deactivate' );

$WpSTProDefaultSettings = get_option('DDWpSTProOptions');
$default_social_settings = get_option('DDWpSTProfiles');


/* Add Administrator Menus */
function DDWpSTPro_admin_menu()
{
	$default_settings = get_option('DDWpSTProOptions');
	$level=$default_settings['user_role'];
	if($level=='' || $level==' ')
	{
		$level='administrator';
	}
	if(current_user_can($level))
	{
	add_menu_page('Social Toolbar Pro', 'Social Toolbar Pro', $level, __FILE__, 'DDWpSTPro_options_page',WP_SOCIAL_TOOLBAR_PRO_PATH.'images/icon.png');
	add_submenu_page(__FILE__, 'Social Profiles', 'Social Profiles', $level, 'DDWpSTPro_social_icons','DDWpSTPro_social_icons');
	}
}
add_action('admin_menu','DDWpSTPro_admin_menu');	

function DDWpSTPro_options_page()
{
	include_once dirname(__FILE__).'/includes/options.php';
}

function DDWpSTPro_social_icons()
{
	include_once dirname(__FILE__).'/includes/social_profiles.php';
}

/* Load Javascript and CSS files */
function DDWpSTPro_print_scripts() {
	$options=get_option('DDWpSTProOptions');
    wp_enqueue_script ('jquery');
	wp_enqueue_script('wpstcorescriptspro',WP_SOCIAL_TOOLBAR_PRO_PATH.'js/corescripts.js',array('jquery'));
	//wp_enqueue_script('twitterwidget','http://platform.twitter.com/widgets.js');
	if($options['position']=='top')
	{
		wp_enqueue_script('wpst_pro_corescripts',WP_SOCIAL_TOOLBAR_PRO_PATH.'js/scripts_top.js',array('jquery'));
		
	}
	else
	{
		wp_enqueue_script('wpst_pro_corescripts',WP_SOCIAL_TOOLBAR_PRO_PATH.'js/scripts.js',array('jquery'));	
	}
	if($options['google_plus_one']=='true')
	{
		wp_enqueue_script('googleplusone','https://apis.google.com/js/plusone.js');		
	}
}
add_action('wp_print_scripts', 'DDWpSTPro_print_scripts');

add_action('wp_head', 'DDWpSTPro_print_style_scripts');

function DDWpSTPro_print_style_scripts()
{
	$options=get_option('DDWpSTProOptions');
	global $WpSTProSettings; 
	if($options['position']=='top')
	{
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>css/wp_social_toolbar_top.css" />
	<?php
	}
	else
	{
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>css/wp_social_toolbar.css" />
	<?php
	}
$background_color=($WpSTProSettings['background_color']!='' ? $WpSTProSettings['background_color'] : '000000' );
$border_color=($WpSTProSettings['border_color']!='' ? $WpSTProSettings['border_color'] : '999999');
$twitter_background=($WpSTProSettings['twitter_background']!='' ? $WpSTProSettings['twitter_background'] : '999999');
$hover_background=($WpSTProSettings['hover_background']!='' ? $WpSTProSettings['hover_background'] : '000000');
$twitter_color=($WpSTProSettings['font_color']!='' ? $WpSTProSettings['font_color'] : 'ffffff' );
$twitter_link=($WpSTProSettings['link_color']!='' ? $WpSTProSettings['link_color'] : 'ffffff');
$font_size=($WpSTProSettings['font_size']!='' ? $WpSTProSettings['font_size'] : '13px');
$font_fam=stripslashes($WpSTProSettings['font_family']);
$font_family=($WpSTProSettings['font_family']!='' ? 'font-family:'.$font_fam.';' : 'Arial');
$bird_color=($WpSTProSettings['bird_color']!='' ? $WpSTProSettings['bird_color'] : 'black');
$icon_size=($WpSTProSettings['icon_size']=='normal' ? '40px' : '30px');
?>
<style type="text/css">
#wps-toolbar-show { background:#<?php echo $border_color; ?> !important; }
#wp-social-toolbar-show-box { border-color:#<?php echo $border_color; ?> !important; }
#wps-toolbar-content #wps-toolbar-top #wps-close-button,.wpcs-border { background:#<?php echo $border_color;?> !important; }
#wps-toolbar-content #wps-toolbar-top #wps-twitter-status { background-color:#<?php echo $twitter_background; ?> !important; <?php echo $font_family;?> color:#<?php echo $twitter_color;?>; font-size:<?php echo $font_size;?>; background-image:url('<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>/images/icons/normal/bird/<?php echo $bird_color;?>.png'); background-repeat:no-repeat; }
#wpsc-social-accounts,#wps-toolbar-bottom { background:#<?php echo $background_color;?> !important; }
#wpsc-social-accounts img:hover,.wpst-credit-pro:hover { background:#<?php echo $hover_background;?>; }
#wp-social-toolbar-show-box,#wps-toolbar-content #wps-toolbar-bottom #wpsc-social-accounts img,#wps-toolbar-content #wps-toolbar-bottom,.wpcs-share-icons { border-color:#<?php echo $border_color;?> !important; }
#wps-toolbar-content #wps-toolbar-top #wps-twitter-status a { color:#<?php echo $twitter_link;?>; }
#wps-toolbar-bottom{ height: <?php echo $icon_size; ?> !important; overflow:hidden !important; }
</style>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo WP_SOCIAL_TOOLBAR_PRO_PATH;?>css/ie.css" />
<![endif]-->
<?php
}


function DDWpSTPro_html_code()
{
	if(DDWpSTPro_display_check())
	{
		DDWpSTPro_display_code();
	}
}

function DDWpSTPro_display_code()
{
	/* Function starts */
	global $WpSTProSettings,$wpst_version;
	$theme_folder=$WpSTProSettings['icon_size'].'/'.$WpSTProSettings['icon_type'];
	$button_color=strtolower($WpSTProSettings['button_color']);
	$bird_color=strtolower($WpSTProSettings['bird_color']);
	$social_icons=get_option('DDWpSTProfiles');
	$social_icons=DDWpSTPro_aasorting($social_icons,"order");
	?>
	<div id="wp-social-toolbar" class="wp-social-toolbar-<?php echo $wpstpro_version; ?>
	<?php echo ' wpst_bar_'.$WpSTProSettings['icon_size'].'_'.$WpSTProSettings['position']; ?>">
			<?php
			if($WpSTProSettings['icon_size']=='normal')
			{
				$style_hw=' width="40" height="40" ';
			}
			else
			{
				$style_hw=' width="30" height="30" ';
			}


			?>
			<?php if($WpSTProSettings['position']=='bottom') : ?>
			<!-- wp social toolbar show box start -->
			<div id="wp-social-toolbar-show-box">
				<div id="wps-toolbar-show">
				<img src="<?php echo plugins_url('images/icons/'.$WpSTProSettings['icon_size'].'/show/'.$button_color.'.png',__FILE__); ?>" class="wpsc_show_button" />
				</div>    
			</div>
			<!-- wp social toolbar show box end -->
			<!-- wp social toolbar border visible on hide starts -->
			<div class="wpcs-border">&nbsp;</div>
			<!-- wp social toolbar border visible on hide ends -->
			<?php endif; ?>

    <div id="wps-toolbar-content">
		<?php if($WpSTProSettings['position']=='bottom'): ?>
		<!-- Top Starts -->
    	<div id="wps-toolbar-top">
        	<div id="wps-close-button">
            	<img src="<?php echo plugins_url('images/icons/'.$WpSTProSettings['icon_size'].'/close/'.$button_color.'.png',__FILE__); ?>" class="wpsc_close_button" />
            </div>
			<?php if($WpSTProSettings['show_tweeter']=='yes') { DDWpSTPro_new_tweets(); } else { echo '<div id="wps-twitter-status-no"></div>'; } ?>
        </div>
		<!-- Top ends -->
		<?php endif; ?>
        <div id="wps-toolbar-bottom">
        	<div id="wpsc-social-accounts">
			<!-- START LOOP -->
			<?php 
			$count=0;
			while (list($key, $value) = each($social_icons)) 
			{	
				if($value['enable']==1)
				{
					$value['name']=strtolower($value['name']);
					if($value['name']=='twitter') { if($value['url']=='' || $value['url']==' ') { $value['url']='daddydesign'; }
					?>
					
					<a href="http://www.twitter.com/<?php echo $value['url']; ?>" title="<?php echo $value['name']; ?>" target="_blank"><img src="<?php echo plugins_url('images/'.$theme_folder.'/'.$value['name'].'.png',__FILE__); ?>" alt="<?php echo $value['name']; ?>" <?php echo $style_hw; ?> /></a>
					<?php
					}
					elseif($value['name']=='skype')
					{
						$value['url']=trim($value['url']);
						?>
					<a href="skype:<?php echo $value['url']; ?>?add" title="<?php echo $value['name']; ?>" target="_blank"><img src="<?php echo plugins_url('images/'.$theme_folder.'/'.$value['name'].'.png',__FILE__); ?>" alt="<?php echo $value['name']; ?>" <?php echo $style_hw; ?> /></a>
						<?php
					}
					elseif($value['name']=='google+')
					{
						$value['url']=trim($value['url']);
						?>
					<a href="<?php echo $value['url']; ?>" title="<?php echo $value['name']; ?>" target="_blank"><img src="<?php echo plugins_url('images/'.$theme_folder.'/googleplus.png',__FILE__); ?>" alt="<?php echo $value['name']; ?>" <?php echo $style_hw; ?> /></a>
						<?php
					}
					else
					{
					?>
					<a href="<?php echo $value['url']; ?>" title="<?php echo $value['name']; ?>" target="_blank"><img src="<?php echo plugins_url('images/'.$theme_folder.'/'.$value['name'].'.png',__FILE__); ?>" alt="<?php echo $value['name']; ?>" <?php echo $style_hw; ?> /></a>
						<?php
					}
				}
			}
			?>
			<!-- END LOOP -->
				
			
            	
				
            </div>
			<?php
			$social_icons=get_option('DDWpSTProfiles'); 
			if($WpSTProSettings['share_home']=='true')
			{
				$share_url=get_bloginfo('url');
			}
			else
			{
				if(is_single()||is_page())
				{
				$share_url=urlencode(get_permalink($post->ID));
				}
				elseif(is_archive())
				{
				
				$share_url=DDWpSTPro_curPageURL();
				}
				else
				{
				$share_url=DDWpSTPro_curPageURL();
				}
			}
			if($WpSTProSettings['facebook_setting']=='true')
			{
				$fb_share=$WpSTProSettings['fan_page'];
			}
			else
			{
				$fb_share=$share_url;
			}
			?>
						<div id="wpsc-social-counts"> 
						<?php if($WpSTProSettings['daddydesign_logo']=='true') : ?>
						<div class="wpcs-share-icons wpst-credit-pro"><a href="http://socialtoolbarpro.com/" title="Social Toolbar Pro" target="_blank"><img src="<?php echo plugins_url('images/icons/'.$WpSTProSettings['icon_size'].'/credit/'.$WpSTProSettings['icon_type'].'.png',__FILE__); ?>" alt="Social Toolbar Pro" <?php echo $style_hw; ?> /></a></div>
						<?php endif; ?>
						<div class="wpcs-share-icons">
						<?php if($WpSTProSettings['share_home']=='true') { ?>
						<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php bloginfo('url'); ?>" data-text="<?php bloginfo('name');?>" data-count="horizontal" data-via="<?php echo $social_icons[1]['url']?>">Tweet</a>
						<?php } else { ?>
						<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="<?php echo $social_icons[1]['url']?>">Tweet</a>
						<?php } ?>
						<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
						</div>
						<?php if($WpSTProSettings['google_plus_one']=='true') : ?>
						<?php if($WpSTProSettings['share_home']!='true') { ?>
						<div class="wpcs-share-icons"><g:plusone size="medium"></g:plusone></div>
						<?php } else { ?>
						<div class="wpcs-share-icons"><g:plusone size="medium" href="<?php echo get_bloginfo('url'); ?>"></g:plusone></div>
						<?php } ?>
						<?php endif; ?>
						<div class="wpcs-share-icons"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $fb_share; ?>&amp;layout=button_count&amp;show_faces=true&amp;width=90&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=25" scrolling="no" frameborder="0" style="border:none;margin-left:auto;margin-right:auto; overflow:hidden; width:90px; height:25px;" allowTransparency="true"></iframe></div>
				</div> <!-- wpsc social counts close -->
			</div> <!-- wpsc social bottom close -->
		<?php if($WpSTProSettings['position']=='top'): ?>
		<!-- Top Starts -->
    	<div id="wps-toolbar-top">
        	<div id="wps-close-button">
            	<img src="<?php echo plugins_url('images/icons/'.$WpSTProSettings['icon_size'].'/show/'.$button_color.'.png',__FILE__); ?>" class="wpsc_close_button" />
            </div>
			<?php if($WpSTProSettings['show_tweeter']=='yes') { DDWpSTPro_new_tweets(); } else { echo '<div id="wps-twitter-status-no"></div>'; } ?>
        </div>
		<!-- Top ends -->
		<?php endif; ?>
		</div><!-- wpsc social content close -->
					<?php if($WpSTProSettings['position']=='top') : ?>
			<!-- wp social toolbar border visible on hide starts -->
			<div class="wpcs-border">&nbsp;</div>
			<!-- wp social toolbar border visible on hide ends -->
			<!-- wp social toolbar show box start -->
			<div id="wp-social-toolbar-show-box">
				<div id="wps-toolbar-show">
				<img src="<?php echo plugins_url('images/icons/'.$WpSTProSettings['icon_size'].'/close/'.$button_color.'.png',__FILE__); ?>" class="wpsc_show_button" />
				</div>    
			</div>
			<!-- wp social toolbar show box end -->
			
			<?php endif; ?>
	</div><!-- wpsc social bottom close -->
<?php
	/* Function ends */
}

add_action('wp_footer', 'DDWpSTPro_html_code');

/************************************************************/


/* FUNCTIONS USED */
function DDWpSTPro_aasorting (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
	return $array;
}
// Function to DETECT mobile phones

function DDWpSTPro_mobileCSS() {
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))|| strstr($useragent,"iPad"))
	{
	echo '<style type="text/css"> #wp-social-toolbar{ display:none !important; } </style>';

	}
}

add_action('wp_footer', 'DDWpSTPro_mobileCSS');

function DDWpSTPro_new_tweets()
{
	global $WpSTProSettings;
	$social_icons=get_option('DDWpSTProfiles'); 
	if (false === ( $fs_tweets = get_transient('wpst_pro_tweets') ) || $social_icons[1]['url']!=get_transient('wpst_pro_tweets_user') ) {//if tweets are not in the cache
     $fs_tweets = DDWpSTPro_get_tweets();//fetch them
     set_transient('wpst_pro_tweets', $fs_tweets, 60*5);//cache them for 1 hour
     set_transient('wpst_pro_tweets_user', $social_icons[1]['url'], 60*5);//cache them for 1 hour
	}
	if($fs_tweets!=FALSE)
	{
	echo '<div id="wps-twitter-status">';
	echo make_clickable($fs_tweets[0]->text);
	if($WpSTProSettings['twitter_timestamp']=='true')
	{
	$real_time=DDWpSTPro_time_difference($fs_tweets[0]->created_at);
	echo '<span class="wps-tweetstamp">'.$real_time.'</span>';
	}
	echo '</div>';
	}
}
function DDWpSTPro_get_tweets()
{
	global $WpSTProSettings;
	$social_icons=get_option('DDWpSTProfiles'); 
	if($social_icons[1]['url']=='' || $social_icons[1]['url']==' ')
	{
		$social_icons[1]['url']='daddydesign';
	}
	$social_icons[1]['url']=trim($social_icons[1]['url']);
	$url = "http://api.twitter.com/1/statuses/user_timeline.json?screen_name=".$social_icons[1]['url']."&include_rts=true&count=1";	
    $twitter = @file_get_contents($url);
	if($twitter!=FALSE)
	{
    $fs_tweets = json_decode($twitter);
	}
	else
	{
		$fs_tweets=FALSE;
	}
    return $fs_tweets;
}
function DDWpSTPro_time_difference($date)
{
    if(empty($date)) {
        return "No date provided";
    }
   
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
   
    $now             = time();
    $unix_date         = strtotime($date);
   
       // check validity of date
    if(empty($unix_date)) {   
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {   
        $difference     = $now - $unix_date;
        $tense         = "ago";
       
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
   
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
   
    $difference = round($difference);
   
    if($difference != 1) {
        $periods[$j].= "s";
    }
   
    return "$difference $periods[$j] {$tense}";
}
	/* Load DaddyDesign.com Common Functions */
	include_once dirname(__FILE__).'/includes/common_functions.php';

function DDWpSTPro_curPageURL() {
 $pageURL = 'http';
 if (isset($_SERVER["HTTPS"]) &&  $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL; 
}

function DDWpSTPro_display_check()
{
	global $WpSTProSettings;
	$social_icons=get_option('DDWpSTProOptions'); 
	$url = DDWpSTPro_curPageURL();
	$display_code=0;
	$specific_pages=explode(',',$WpSTProSettings['specific_pages']);
	if(is_single() || is_page())
	{
		global $post,$posts;
		$page_id=$post->ID;
	}
	else
	{
		$page_id=0;
	}
	if($WpSTProSettings['whole_website']=='true')
	{
		return true;
	}
	else
	{
		if(isset($WpSTProSettings['home_page']) && $url==get_bloginfo('url').'/')
		{

			return true;
		}
		elseif(isset($WpSTProSettings['category_archive']) && (is_archive() || is_tag() || is_tax() || is_author()))
		{
			return true;
		}
		elseif(isset($WpSTProSettings['blog_single_post']) && is_single())
		{
			return true;
		}
		elseif(count($WpSTProSettings)>0 && (is_single() || is_page()))
		{
			if(in_array($page_id,$specific_pages))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

}
?>