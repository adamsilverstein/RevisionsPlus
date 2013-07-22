<?php
/*
Plugin Name: Revisions Plus
Plugin URI: http://www.earthbound.com/plugins/revisions-plus
Description: Lets any Administrator simplify the WordPress Admin interface, on a per-user basis, by turning specific menu/submenu sections off.
Version: 0.5.4
Author: Adam Silverstein
Author URI: http://www.earthbound.com/plugins
License: GPLv2 or later
*/

	add_action( 'init', 'revisionsplus_init' );

	//future: implement show only user's available menus, eg. less than admins as per suggestion

	function revisionsplus_init() {
	}

	function revisionsplus_add_admin_menu() {
		add_management_page( 	esc_html__( 'Revisions Plus', 'revisionsplus' ),
								esc_html__( 'Revisions Plus', 'revisionsplus' ),
								'manage_options',
								'revisionsplus/revisionsplus.php',
								'revisionsplus_options_page' );
	}

	function revisionsplus_get_admin_options() {
		$saved_options = get_option( 'revisionsplus_options' );
		return is_array( $saved_options ) ? $saved_options : array();
	}

	function revisionsplus_save_admin_options( $revisionsplus_options ) {
		update_option( 'revisionsplus_options', $revisionsplus_options );
	}

	function revisionsplus_clean_menu_name( $menuname ) { //clean up menu names provided by WordPress
		$menuname = preg_replace( '/<span(.*?)span>/', '', $menuname ); //strip the count appended to menus like the post count
		return ( $menuname );
	}

	function revisionsplus_options_page() {

	revisionsplus_save_admin_options( $revisionsplus_options );
	}
	function revisionsplus_admin_js() {
?>
<script type="text/javascript">
	jQuery( function() {
		jQuery( document ).ready( function () {
		} );
	} );
</script>
<?php
}
