<?php
/*
Plugin Name: Revisions Plus
Plugin URI: http://www.earthbound.com/plugins/revisions-plus
Description: Extends the WordPress revisions system with additional features.
Version: 0.9
Author: Adam Silverstein
Author URI: http://www.earthbound.com/plugins
License: GPLv2 or later
*/

	add_action( 'admin_init', 'revisionsplus_admin_init' );
	add_filter( 'process_revision_diff_html', 'filter_process_revision_diff_html', 10, 2 );


	function revisionsplus_admin_init() {
		/*
			* enable single column view
			* enable wysiwyg view
			* enable list of revisions on revision page
			* enable easter egg
		 */
		// Only load JS on revision screen
		if ( 'revision' == get_current_screen()->id ) {			
			wp_enqueue_script( 'revisionsplus', plugins_url( 'js/revisionsplus.js' , __FILE__ ), array( 'jquery' ) );
			wp_enqueue_style( 'revisionsplus', plugins_url( 'css/revisionsplus.css' , __FILE__ ) );
			$_revisionsplus = array( 
				'easteregg' => plugins_url( 'revisionseasteregg.php' , __FILE__ ) );
			wp_localize_script( 'revisionsplus', '_revisionsplus', $_revisionsplus );



			// add the clickable easter egg
?>
	<div class="easteregg"><a href="#"><img src="<?php echo plugins_url( 'images/easteregg.png' , __FILE__ ) ?>" /></a></div>
<?php
		//include( './js/revisions-js.php' );
		//wp_redirect( 'post.php' );
		//exit;

		}

	}

	function filter_process_revision_diff_html( $org, $line ) {
		error_log($line);
		return wp_kses_post( $line );
	}

