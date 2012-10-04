<?php
/* Function to Get Recend Feeds */
if(!function_exists('DaddyDesignNewsFeeds')):
function DaddyDesignNewsFeeds($feed='http://feeds2.feedburner.com/daddydesign')
{
		include_once(ABSPATH . WPINC . '/feed.php');
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed($feed);
		if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
	    // Figure out how many total items there are, but limit it to 5. 
		$maxitems = $rss->get_item_quantity(5); 
	    // Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
		endif;
	echo '<ol class="WPSOCIALTOOLBAR_latest_news">';
    if ($maxitems == 0) echo '<li>No items.</li>';
    else
    // Loop through each feed item and display each item as a hyperlink.
    foreach ( $rss_items as $item ) : 
    echo '<li>';
    echo '<a href="'.$item->get_permalink().'" title="">'.$item->get_title().'</a></li>';
    endforeach; 
	echo '</ol>';
}
endif;
// ADD Content Slide JS TO HEAD SECTION
?>