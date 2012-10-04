<?php
/*
 * Tommy Leunen (t@tommyleunen.com) http://www.tommyleunen.com
 */

abstract class WSO_Service
{	
	private function __construct()
	{
	}
	
	abstract protected function isAutoPublish($type);
	
	abstract protected function authenticate();
	abstract public function publish($postid, $comment = "");
	
	abstract public function connect();
	abstract public function disconnect();
	abstract public function savePage();
	
	public function beforeShowingPage() {}
	abstract public function showPage();
		
	protected function getSupportedFormats()
	{
		$supportedFormats = array('standard');
		if(current_theme_supports('post-formats'))
		{
			$formats = get_theme_support('post-formats');
			if(is_array($formats[0]))
				$supportedFormats = array_merge($supportedFormats, $formats[0]);
		}
		return $supportedFormats;
	}
	
	protected function getImage($postid, &$wsoOpts)
	{
		$img = '';

		// 1. featured image
		if(current_theme_supports('post-thumbnails'))
		{
			$imgFeat = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'full');
			if($imgFeat !== false) $img = $imgFeat[0];
		}
		
		// 2. image inside the post
		if(empty($img))
		{
			$attachments = get_children(array(
						'post_parent' => $postid,
						'numberposts' => 1,
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'ASC',
						'orderby' => 'menu_order date'));
								
			if(is_array($attachments) && !empty($attachments))
			{
				foreach($attachments as $att_id => $attachment)
				{
					$img = wp_get_attachment_image_src($att_id, 'full');
					if($img !== false) { $img = $img[0]; break; }
				}
			}
		}
        
        // 3. from youtube
        if(empty($img))
		{
            $img = $this->tryToSaveImageFromYoutubeLink($postid);
        }
        
        // 4. inside the post
        if(empty($img))
        {
            $post = get_post($postid);
            $patternImg = '/<*img[^>]*src*=*["\']?([^"\']*)/i';
            if(preg_match($patternImg, $post->post_content, $matches))
            {
                $img = $matches[1];
            }
        }
		
		if(empty($img)) $img = $wsoOpts['pict'];
		
		return $img;
	}
	
	protected function qTrans($output)
	{
		if(function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) 
		{
			$output = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($output);
		}
		return $output;
	}
	
	protected function strip_tags($output)
	{
		$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
				   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
		);
		return preg_replace($search, '', $output); 
	}
    
    private function tryToSaveImageFromYoutubeLink($postid)
	{
        $imageSource = "";
        $youtube = "";
        $post = get_post($postid);
        $content = strip_tags($post->post_content);
        
        // check if we have a youtube video
        preg_match_all('#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(v/|embed/)([\w-]+)(.*?)#i', $post->post_content, $matches);
        if(is_array($matches[3]) && !empty($matches[3]))
        {
            $youtube = $matches[3][0];
        }
        unset($matches);

        if(empty($youtube))
        {
            preg_match('#http://(www.youtube|youtube)\.com/(watch\?v=)([\w-]+)(.*?)#i', $post->post_content, $matches);
            if(!empty($matches[3]))
            {
                $youtube = $matches[3];
            }
        }

        if(!empty($youtube))
        {			
            $file = "http://img.youtube.com/vi/".$youtube."/0.jpg";
            
            $uploads = wp_upload_dir($post->post_date);					
            $filetype = wp_check_filetype( $file, null );
            
            if(empty($uploads['error']) && !empty($filetype['ext']) && !empty($filetype['type']))
            {
                $filename = $postid . "-" .wp_unique_filename($uploads['path'], basename($file));
                $cpfile = $uploads['path'] . '/' . $filename;
                
                if(file_exists($cpfile))
                {
                    $attachment = get_posts(array( 'post_type' => 'attachment', 'meta_key' => '_wp_attached_file', 'meta_value' => substr($uploads['subdir'],1) . '/' . $filename ));
                    if (!empty($attachment))
                    {
                        $attachmentId = $attachments[0]->ID;
                    }
                }
                else
                {
                    if(copy($file, $cpfile))
                    {
                        // Set correct file permissions
                        $stat = stat(dirname($cpfile));
                        $perms = $stat['mode'] & 0000666;
                        chmod($cpfile, $perms);
                        
                        $url = $uploads['url'] . '/' . rawurlencode($filename);
                        
                        //Apply upload filters
                        $ret = apply_filters( 'wp_handle_upload', array( 'file' => $cpfile, 'url' => $url, 'type' => $filetype['type'] ) );
                        $cpfile = $ret['file'];
                        $url = $ret['url'];
                        $filetype['type'] = $ret['type'];
                        
                        $title = preg_replace('!\.[^.]+$!', '', basename($file));
                        
                        // Construct the attachment array
                        $attachment = array(
                            'post_mime_type' => $filetype['type'],
                            'guid' => $url,
                            'post_parent' => $postid,
                            'post_title' => $title,
                            'post_name' => $title,
                            'post_content' => "",
                            'post_date' => $post->post_date,
                            'post_date_gmt' => $post->post_date_gmt
                        );

                        // Save the data
                        $attachmentId = wp_insert_attachment($attachment, $cpfile, $postid);
                    }
                    
                    if(!is_wp_error($attachmentId))
                    {
                        $data = wp_generate_attachment_metadata($attachmentId, $cpfile);
                        wp_update_attachment_metadata($attachmentId, $data);
                    }
                    $imageSource = wp_get_attachment_url($attachmentId);
                }
            }		
        }
        
        return $imageSource;
	}
}