window.wp = window.wp || {};
(function($) {
	timelineMode = _revisionsplus.revisiontimelinebutton;
/*
	template = '<script id="tmpl-revisions-diff" type="text/html">
		<div class="loading-indicator"><span class="spinner"></span></div>
		<div class="diff-error"><?php _e( \'Sorry, something went wrong. The requested comparison could not be loaded.\' ); ?></div>
		<div class="diff">
		<# _.each( data.fields, function( field ) { #>
		<h3>{{ field.name }}</h3>
		{{{ field.diff }}}
		<# }); #>
		</div>
		</script>';*/

	$(document).ready( function() {
	var revisions, timeline;
	revisions = window.wp.revisions;

	if ( 'undefined' !== typeof revisions) {
		console.log( revisions );

		// The all diff view.
		// This is the view for the all diff.
		revisions.view.AllDiffs = wp.Backbone.View.extend({
			className: 'revisions-all-diffs',
			template: wp.template('revisions-all-diff'),

			// Generate the options to be passed to the template.
			render: function() {
				console.log(this);
				timeline = '<div class="revisions-timeline">';
				_.each( this.revisions, function( revision ){
					timeline = timeline + '<div id="' + esc_attr( revision->ID ) +'">' +
					// snippet +
					'</div>';

				} );
				$( '.revisions-diff-frame' ).after( timeline );

				//</div>
			}
		});

		var alldiffs = new revisions.view.AllDiffs({
				frame: revisions.model,
				revisions: revisions.model.revisions
			});

		alldiffs.render();
	}
		$( '.revision-toggle-compare-mode label' )
			.before( timelineMode );
		$( 'input.show-revision-history' )
			.on( 'click',
				function() {
					if ( $( this ).attr( 'checked' ) ) {
					// Show the timeline view
					$( '.revisions' ).addClass( 'timeline' );

					// Check the checkbox!
					$( this ).attr( 'checked', true );
				} else {

					// Show the normal view
					$( '.revisions' ).removeClass( 'timeline' );

					// Un-check the checkbox!
					$( this ).attr( 'checked', false );

				}
		} );
	});





	$( '.easteregg a' ).on( 'click', function() {
		document.location = _revisionsplus.easteregg;
	});
}(jQuery));
