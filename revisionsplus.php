<?php
/*
Plugin Name: Revisions Plus
Plugin URI: http://www.earthbound.com/plugins/revisions-plus
Description: Extends the WordPress revisions system with additional features.
Version: 1.0.0
Author: Adam Silverstein
Author URI: http://www.earthbound.com/plugins
License: GPLv2 or later
*/

	add_action( 'admin_footer', 'revisionsplus_admin_footer' );
	add_filter( 'process_text_diff_html', 'revisionsplus_filter_process_revision_diff_html', 10, 2 );
//	add_filter( 'show_revisions_split_view', '__return_false', 10 );
	add_filter( 'revision_text_diff_options', function( array $args ) {
		$args['show_split_view'] = false;
		return $args;
	} );
	//include_once( 'patched_core/revision.php' );
	//include_once( 'patched_core/wp-diff.php' );

	function revisionsplus_admin_footer() {
		/*
			* enable single column view.
			* enable wysiwyg view.
			* enable list of revisions on revision page
			* enable easter egg.
			* add list of revisions to the edit post screen
		 */
		// Only load JS on revision screen
		//
		if ( 'revision' == get_current_screen()->id ) {
			wp_enqueue_script( 'revisionsplus', plugins_url( 'js/revisionsplus.js' , __FILE__ ), array( 'jquery' ) );
			wp_enqueue_style( 'revisionsplus', plugins_url( 'css/revisionsplus.css' , __FILE__ ) );
			$revisiontimelinebutton = sprintf( '<label><input class="show-revision-history" type="checkbox"></input> %s</label> ', __( 'Show Revision Timeline' ) );
			$_revisionsplus = array(
				'easteregg' 				=> plugins_url( 'revisionseasteregg.php' , __FILE__ ),
				'revisiontimelinebutton'	=> $revisiontimelinebutton,
				'revisions_list_name'		=> esc_html__( 'Revisions', 'revisionsplus' ),
				 );
			wp_localize_script( 'revisionsplus', '_revisionsplus', $_revisionsplus );

			// add the clickable easter egg
?>
	<div class="easteregg"><a href="#"><img src="<?php echo plugins_url( 'images/easteregg.png' , __FILE__ ) ?>" /></a></div>
<script type="text/javascript">
	function gotoRevision( revisionID ) {

		// Go to the revision.
		window.wp.revisions.view.frame.model.set( {
			to: window.wp.revisions.view.frame.model.revisions.get( revisionID ),
			from: window.wp.revisions.view.frame.model.revisions.get( revisionID-1 )
		} );
	}

</script>
<script id="tmpl-revisions-timeline" type="text/html">
	<div class="revision">
	<a href="javascript:gotoRevision( {{{ data.id }}} );">
		{{{ data.dateShort }}}
	</a>
	</div>
</script>
<?php
		//include( './js/revisions-js.php' );
		//wp_redirect( 'post.php' );
		//exit;

		}

	}

	function revisionsplus_filter_process_revision_diff_html( $org, $line ) {
		return wp_kses_post( $line );
	}

	function set_show_revisions_split_view() {
		return false;
	}

