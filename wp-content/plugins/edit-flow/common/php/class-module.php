<?php
/**
 * class EF_Module
 *
 * @desc Base class any Edit Flow module should extend
 */

if ( !class_exists( 'EF_Module' ) ) {
	
class EF_Module {
	
	function __construct() {
	}

	/**
	 * Returns whether the module with the given name is enabled.
	 *
	 * @since 0.7
	 *
	 * @param string module Slug of the module to check
	 * @return <code>true</code> if the module is enabled, <code>false</code> otherwise
	 */
	function module_enabled( $slug ) {
		global $edit_flow;

		return isset( $edit_flow->$slug ) && $edit_flow->$slug->module->options->enabled == 'on';
	}

	/**
	 * Cleans up the 'on' and 'off' for post types on a given module (so we don't get warnings all over)
	 * For every post type that doesn't explicitly have the 'on' value, turn it 'off'
	 * If add_post_type_support() has been used anywhere (legacy support), inherit the state
	 *
	 * @param array $module_post_types Current state of post type options for the module
	 * @param string $post_type_support What the feature is called for post_type_support (e.g. 'ef_calendar')
	 * @return array $normalized_post_type_options The setting for each post type, normalized based on rules
	 *
	 * @since 0.7
	 */
	function clean_post_type_options( $module_post_types = array(), $post_type_support = null ) {
		$normalized_post_type_options = array();
		$pt_args = array(
			'_builtin' => false,
		);
		$all_post_types = get_post_types( $pt_args, 'names' );
		array_push( $all_post_types, 'post', 'page' );
		$all_post_types = array_merge( $all_post_types, array_keys( $module_post_types ) );
		foreach( $all_post_types as $post_type ) {
			if ( ( isset( $module_post_types[$post_type] ) && $module_post_types[$post_type] == 'on' ) || post_type_supports( $post_type, $post_type_support ) )
				$normalized_post_type_options[$post_type] = 'on';
			else
				$normalized_post_type_options[$post_type] = 'off';
		}
		return $normalized_post_type_options;
	}
	
	/**
	 * Collect all of the active post types for a given module
	 *
	 * @param object $module Module's data
	 * @return array $post_types All of the post types that are 'on'
	 *
	 * @since 0.7
	 */
	function get_post_types_for_module( $module ) {
		
		$post_types = array();
		if ( isset( $module->options->post_types ) && is_array( $module->options->post_types ) ) {
			foreach( $module->options->post_types as $post_type => $value )
				if ( 'on' == $value )
					$post_types[] = $post_type;
		}
		return $post_types;
	}
	
	/**
	 * Get all of the currently available post statuses
	 * This should be used in favor of calling $edit_flow->custom_status->get_custom_statuses() directly
	 *
	 * @return object $post_statuses All of the post statuses that aren't a published state
	 *
	 * @since 0.7
	 */
	function get_post_statuses() {
		global $edit_flow;
		
		if ( $this->module_enabled('custom_status') ) {
		 	return $edit_flow->custom_status->get_custom_statuses();
		} else {
			$post_statuses = array(
				(object)array(
					'name' => __( 'Draft' ),
					'description' => '',
					'slug' => 'draft',
				),
				(object)array(
					'name' => __( 'Pending Review' ),
					'description' => '',
					'slug' => 'pending',
				),				
			);
			return (object)$post_statuses;
		}
	}

	/**
	 * Filter to all posts with a given post status (can be a custom status or a built-in status) and optional custom post type.
	 *
	 * @since 0.7
	 *
	 * @param string $slug The slug for the post status to which to filter
	 * @param string $post_type Optional post type to which to filter
	 * @return an edit.php link to all posts with the given post status and, optionally, the given post type
	 */
	function filter_posts_link( $slug, $post_type = 'post' ) {
		$filter_link = add_query_arg( 'post_status', $slug, get_admin_url( null, 'edit.php' ) );
		if ( $post_type != 'post' && in_array( $post_type, get_post_types( '', 'names' ) ) )
			$filter_link = add_query_arg( 'post_type', $post_type, $filter_link );
		return $filter_link;
	}
	
	/**
	 * Returns the friendly name for a given status
	 *
	 * @since 0.7
	 *
	 * @param string $status The status slug
	 * @return string $status_friendly_name The friendly name for the status
	 */
	function get_post_status_friendly_name( $status ) {
		global $edit_flow;
		
		$status_friendly_name = '';
		
		$builtin_stati = array(
			'publish' => __( 'Published', 'edit-flow' ),
			'draft' => __( 'Draft', 'edit-flow' ),
			'future' => __( 'Scheduled', 'edit-flow' ),
			'private' => __( 'Private', 'edit-flow' ),
			'pending' => __( 'Pending Review', 'edit-flow' ),
			'trash' => __( 'Trash', 'edit-flow' ),
		);
		
		// Custom statuses only handles workflow statuses
		if ( $this->module_enabled( 'custom_status' ) && !in_array( $status, array( 'publish', 'future', 'private', 'trash' ) ) ) {
			$status_object = $edit_flow->custom_status->get_custom_status_by( 'slug', $status );
			if( $status_object && !is_wp_error( $status_object ) ) {
				$status_friendly_name = $status_object->name;
			}
		} else if ( array_key_exists( $status, $builtin_stati ) ) {
			$status_friendly_name = $builtin_stati[$status];
		}
		return $status_friendly_name;
	}
	
	/**
	 * Enqueue any resources (CSS or JS) associated with datepicker functionality
	 *
	 * @since 0.7
	 */
	function enqueue_datepicker_resources() {
		
		// Add the first day of the week as an available variable to wp_head
		echo "<script type=\"text/javascript\">var ef_week_first_day=\"" . get_option( 'start_of_week' ) . "\";</script>";		

		// Datepicker is available WordPress 3.3. We have to register it ourselves for previous versions of WordPress
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'edit_flow-date_picker', EDIT_FLOW_URL . 'common/js/ef_date.js', array( 'jquery', 'jquery-ui-datepicker' ), EDIT_FLOW_VERSION, true );

		// Now styles
		wp_enqueue_style( 'jquery-ui-datepicker', EDIT_FLOW_URL . 'common/css/jquery.ui.datepicker.css', array( 'wp-jquery-ui-dialog' ), EDIT_FLOW_VERSION, 'screen' );
		wp_enqueue_style( 'jquery-ui-theme', EDIT_FLOW_URL . 'common/css/jquery.ui.theme.css', false, EDIT_FLOW_VERSION, 'screen' );
	}
	
	/**
	 * Checks for the current post type
	 *
	 * @since 0.7
	 * @return string|null $post_type The post type we've found, or null if no post type
	 */
	function get_current_post_type() {
		global $post, $typenow, $pagenow, $current_screen;

		if ( $post && $post->post_type )
			$post_type = $post->post_type;
		elseif ( $typenow )
			$post_type = $typenow;
		elseif ( $current_screen && isset( $current_screen->post_type ) )
			$post_type = $current_screen->post_type;
		elseif ( isset( $_REQUEST['post_type'] ) )
			$post_type = sanitize_key( $_REQUEST['post_type'] );
		else
			$post_type = null;

		return $post_type;
	}
	
	/**
	 * Wrapper for the get_user_meta() function so we can replace it if we need to
	 *
	 * @since 0.7
	 *
	 * @param int $user_id Unique ID for the user
	 * @param string $key Key to search against
	 * @param bool $single Whether or not to return just one value
	 * @return string|bool|array $value Whatever the stored value was
	 */
	function get_user_meta( $user_id, $key, $string = true ) {
		
		$response = null;
		$response = apply_filters( 'ef_get_user_meta', $response, $user_id, $key, $string );
		if ( !is_null( $response ) )
			return $response;
			
		return get_user_meta( $user_id, $key, $string );
		
	}
	
	/**
	 * Wrapper for the update_user_meta() function so we can replace it if we need to
	 *
	 * @since 0.7
	 *
	 * @param int $user_id Unique ID for the user
	 * @param string $key Key to search against
	 * @param string|bool|array $value Whether or not to return just one value
	 * @param string|bool|array $previous (optional) Previous value to replace
	 * @return bool $success Whether we were successful in saving
	 */
	function update_user_meta( $user_id, $key, $value, $previous = null ) {
		
		$response = null;
		$response = apply_filters( 'ef_update_user_meta', $response, $user_id, $key, $value, $previous );
		if ( !is_null( $response ) )
			return $response;
			
		return update_user_meta( $user_id, $key, $value, $previous );
		
	}	
	
	/**
	 * Take a status and a message, JSON encode and print
	 *
	 * @since 0.7
	 *
	 * @param string $status Whether it was a 'success' or an 'error'
	 */
	function print_ajax_response( $status, $message = '' ) {
		header( 'Content-type: application/json;' );
		echo json_encode( array( 'status' => $status, 'message' => $message ) );
		exit;
	}
	
	/**
	 * Whether or not the current page is a user-facing Edit Flow View
	 * @todo Think of a creative way to make this work
	 *
	 * @since 0.7
	 *
	 * @param string $module_name (Optional) Module name to check against
	 */
	function is_whitelisted_functional_view( $module_name = null ) {
		
		// @todo complete this method
		
		return true;
	}
	
	/**
	 * Whether or not the current page is an Edit Flow settings view (either main or module)
	 * Determination is based on $pagenow, $_GET['page'], and the module's $settings_slug
	 * If there's no module name specified, it will return true against all Edit Flow settings views
	 *
	 * @since 0.7
	 *
	 * @param string $module_name (Optional) Module name to check against
	 * @return bool $is_settings_view Return true if it is
	 */
	function is_whitelisted_settings_view( $module_name = null ) {
		global $pagenow, $edit_flow;
		
		// All of the settings views are based on admin.php and a $_GET['page'] parameter
		if ( $pagenow != 'admin.php' || !isset( $_GET['page'] ) )
			return false;
		
		// Load all of the modules that have a settings slug/ callback for the settings page
		foreach ( $edit_flow->modules as $mod_name => $mod_data ) {
			if ( isset( $mod_data->options->enabled ) && $mod_data->options->enabled == 'on' && $mod_data->configure_page_cb )
				$settings_view_slugs[] = $mod_data->settings_slug;
		}
	
		// The current page better be in the array of registered settings view slugs
		if ( !in_array( $_GET['page'], $settings_view_slugs ) )
			return false;
		
		if ( $module_name && $edit_flow->modules->$module_name->settings_slug != $_GET['page'] )
			return false;
			
		return true;
	}
	
	/**
	 * Remove term(s) associated with a given object(s). Core doesn't have this as of 3.2
	 * @see http://core.trac.wordpress.org/ticket/15475
	 * 
	 * @author ericmann
	 * @compat 3.3?
	 *
	 * @param int|array $object_ids The ID(s) of the object(s) to retrieve.
	 * @param int|array $terms The ids of the terms to remove.
	 * @param string|array $taxonomies The taxonomies to retrieve terms from.
	 * @return bool|WP_Error Affected Term IDs
	 */
	function remove_object_terms( $object_id, $terms, $taxonomy ) {
		global $wpdb;

		if ( !taxonomy_exists( $taxonomy ) )
			return new WP_Error( 'invalid_taxonomy', __( 'Invalid Taxonomy' ) );

		if ( !is_array( $object_id ) )
			$object_id = array( $object_id );

		if ( !is_array($terms) )
			$terms = array( $terms );
			
		$delete_objects = array_map( 'intval', $object_id );
		$delete_terms = array_map( 'intval', $terms );	

		if ( $delete_terms ) {
			$in_delete_terms = "'" . implode( "', '", $delete_terms ) . "'";
			$in_delete_objects = "'" . implode( "', '", $delete_objects ) . "'";
			$return = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->term_relationships WHERE object_id IN ($in_delete_objects) AND term_taxonomy_id IN ($in_delete_terms)", $object_id ) );
			wp_update_term_count( $delete_terms, $taxonomy );
			return true;
		}
		return false;
	}
	
	/**
	 * This is a hack, Hack, HACK!!!
	 * Encode all of the given arguments as JSON.
	 * Used to store extra data in a term's description field
	 * @todo This is ghetto ghetto because so so brittle. Base64 the description instead?
	 *
	 * @since 0.7
	 *
	 * @param array $args The arguments to encode
	 * @param string $metadata_type Metadata type
	 * @return string $encoded Type and description encoded as JSON
	 */
	function get_encoded_description( $args = array() ) {
		
		$sanitized_args = array();
		foreach( $args as $key => $value ) {
			// Arrays make it through scot-free because we assume its just a set of integers
			if ( is_array( $value ) ) {
				$sanitized_args[$key] = $value;
				continue;
			}
			// Damn pesky carriage returns...
			$sanitized_args[$key] = str_replace( "\r\n", "\n", $value );
			$sanitized_args[$key] = str_replace( "\r", "\n", $sanitized_args[$key] );
			// Convert all newlines to <br /> for storage (and because it's the proper way to present them)
			$sanitized_args[$key] = str_replace("\n", "<br />", $sanitized_args[$key]);		
			$allowed_tags = '<b><a><strong><i><ul><li><ol><blockquote><em><br>';
			$sanitized_args[$key] = strip_tags( $sanitized_args[$key], $allowed_tags );
			// Escape any special characters (', ", <, >, &)
			$sanitized_args[$key] = esc_attr( $sanitized_args[$key] );
			$sanitized_args[$key] = htmlentities( $sanitized_args[$key], ENT_QUOTES );
		}
		$encoded = json_encode( $args );
		
		return $encoded;
	}
	
	/**
	 * If given an encoded string from a term's description field,
	 * return an array of values. Otherwise, return the original string
	 *
	 * @since 0.7
	 *
	 * @param string $string_to_unencode Possibly encoded string
	 * @return array $string_or_unencoded_array Array if string was encoded, otherwise the string as the 'description' field
	 */
	function get_unencoded_description( $string_to_unencode ) {
		$string_to_unencode = stripslashes( htmlspecialchars_decode( $string_to_unencode ) );
		$unencoded_array = json_decode( $string_to_unencode, true );
		$string_or_unencoded_array = array();
		// Only continue processing if it actually was an array. Otherwise, set to the original string
		if ( is_array( $unencoded_array ) ) {
			foreach( $unencoded_array as $key => $value ) {
				// html_entity_decode only works on strings but sometimes we store nested arrays
				if ( !is_array( $value ) )
					$string_or_unencoded_array[$key] = html_entity_decode( $value, ENT_QUOTES );
				else
					$string_or_unencoded_array[$key] = $value;
			}
		} else {
			$string_or_unencoded_array['description'] = $string_to_unencode;
		}
		return $string_or_unencoded_array;
	}
	
	/**
	 * Get the publicly accessible URL for the module based on the filename
	 *
	 * @since 0.7
	 *
	 * @param string $filepath File path for the module
	 * @return string $module_url Publicly accessible URL for the module
	 */
	function get_module_url( $file ) {
		$module_url = plugins_url( '/', $file );
		return trailingslashit( $module_url );
	}
	
	/**
	 * Produce a human-readable version of the time since a timestamp
	 *
	 * @param int $original The UNIX timestamp we're producing a relative time for
	 * @return string $relative_time Human-readable version of the difference between the timestamp and now
	 */
	function timesince( $original ) {
		// array of time period chunks
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'minute'),
			array(1 , 'second'),
		);

		$today = time(); /* Current unix time  */
		$since = $today - $original;

		if ( $since > $chunks[2][0] ) {
			$print = date("M jS", $original);

			if( $since > $chunks[0][0] ) { // Seconds in a year
					$print .= ", " . date( "Y", $original );
			}

			return $print;
		}

		// $j saves performing the count function each time around the loop
		for ($i = 0, $j = count($chunks); $i < $j; $i++) {

			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];

			// finding the biggest chunk (if the chunk fits, break)
			if (($count = floor($since / $seconds)) != 0) {
				break;
			}
		}

		return sprintf( _n( "1 $name ago", "$count ${name}s ago", $count), $count);
	}
	
	/**
	 * Displays a list of users that can be selected!
	 *
	 * @since 0.7
	 *
	 * @todo Add pagination support for blogs with billions of users
	 *
	 * @param ???
	 * @param ???
	 */
	function users_select_form( $selected = null, $args = null ) {
		global $blog_id;

		// Set up arguments
		$defaults = array(
			'list_class' => 'ef-users-select-form', 
			'input_id' => 'ef-selected-users'
		);
		$parsed_args = wp_parse_args( $args, $defaults );
		extract($parsed_args, EXTR_SKIP);

		$args = array(
			'who' => 'authors',
			'fields' => array(
				'ID',
				'display_name',
				'user_email'
			),
			'orderby' => 'display_name',
		);
		$users = get_users( $args );

		if ( !is_array($selected) ) $selected = array();
		?>

		<?php if( !empty($users) ) : ?>
			<ul class="<?php echo esc_attr( $list_class ) ?>">
				<?php foreach( $users as $user ) : ?>
					<?php $checked = ( in_array($user->ID, $selected) ) ? 'checked="checked"' : ''; ?>
					<li>
						<label for="<?php echo esc_attr( $input_id .'-'. $user->ID ) ?>">
							<input type="checkbox" id="<?php echo esc_attr( $input_id .'-'. $user->ID ) ?>" name="<?php echo esc_attr( $input_id ) ?>[]" value="<?php echo esc_attr( $user->ID ); ?>" <?php echo $checked; ?> />
							<span class="ef-user_displayname"><?php echo esc_html( $user->display_name ); ?></span>
							<span class="ef-user_useremail"><?php echo esc_html( $user->user_email ); ?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<?php
	}

	/**
	 * Adds an array of capabilities to a role.
	 *
	 * @since 0.7
	 *
	 * @param string $role A standard WP user role like 'administrator' or 'author'
	 * @param array $caps One or more user caps to add
	 */
	function add_caps_to_role( $role, $caps ) {

		// In some contexts, we don't want to add caps to roles
		if ( apply_filters( 'ef_kill_add_caps_to_role', false, $role, $caps ) )
			return;

		global $wp_roles;
		
		if ( $wp_roles->is_role( $role ) ) {
			$role =& get_role( $role );
			foreach ( $caps as $cap )
				$role->add_cap( $cap );
		}
	}

	/**
	 * Add settings help menus to our module screens if the values exist
	 * Auto-registered in Edit_Flow::register_module()
	 *
	 * @since 0.7
	 */
	function action_settings_help_menu() {
		
		$screen = get_current_screen();
		
		if ( !method_exists( $screen, 'add_help_tab' ) ) 
			return;
		
		if ( $screen->id != 'edit-flow_page_' . $this->module->settings_slug ) 
			return;

		// Make sure we have all of the required values for our tab
		if ( isset( $this->module->settings_help_tab['id'], $this->module->settings_help_tab['title'], $this->module->settings_help_tab['content'] ) ) {
			$screen->add_help_tab( $this->module->settings_help_tab );
		
			if ( isset( $this->module->settings_help_sidebar ) ) {
				$screen->set_help_sidebar( $this->module->settings_help_sidebar );
			}
		}
	}
	
}
}
