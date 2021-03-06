<?php
//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info
function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="fb:admins" content="Michael McCouman Jr."/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Wikibyte"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	
	//Audio or Video Tags as Idea and Testings
	//1.)
	#echo '<meta property="og:audio" content="http..." />'; //your Audio or Video data (http)
	
	//2.)
	echo '<meta property="og:audio" content="' . do_shortcode('[your shortcode to mp3]') . '" />'; //Shortcode (Podlove or others) 
	
	//3.)
	#?&gt;<meta property="og:audio" content="<?php echo $meta_values = get_post_custom($post->ID);
	#	
	#if ( isset ( $meta_values['meta_audio_attachment'][0] ) ) {
	#	echo $meta_values['meta_audio_attachment'][0];
	#} ?&gt;" /><?php
	
	echo '<meta property="og:audio:type" content="audio/mpeg" />'; //Audio Type

}
add_action( 'wp_head', 'insert_fb_in_head', 5 );
?>
