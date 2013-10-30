window.wp = window.wp || {};
(function($) {
	timelineMode = _revisionsplus.revisiontimelinebutton;

	$(document).ready( function() {
	var revisions, timeline;
	revisions = window.wp.revisions,
	SELF = this;

	if ( 'undefined' !== typeof revisions) {

		console.log(revisions);

//console.log(revisions.settings.revisionData);

		// The all diff view.
		// This is the view for the all diff.
		revisions.view.AllDiffs = wp.Backbone.View.extend({
			//template: _.template('tmpl-revisions-timeline'),
			className: 'revisions-timeline',
			template: wp.template('revisions-timeline'),

			initialize: function() {
				//this.listenTo( revisions.model, 'change:revision', alert('update') );
				//this.listenTo( revisions.model, 'change:ddddd', alert('update') );

			},

			// Generate the options to be passed to the template.
			render: function() {
				var SELF = this,
				data,
				build = '<span class="revisions-timeline-title">' + _revisionsplus.revisions_list_name + '</span>',
				timeline = '<div class="revisions-timeline postbox"></div>';

				_.each(
					revisions.settings.revisionData, function( revision ) {
						//console.log( SELF.template( revision ) );
						build = build + SELF.template( revision );
						//SELF.$el.append( SELF.template( data ) );
					}
				);
				//console.log(build);
				$( '.revisions' ).append( timeline );
				$( '.revisions-timeline' ).html( build );
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
					if ( $( this ).prop( 'checked' ) ) {
					// Show the timeline view
					$( '.revisions' ).addClass( 'timeline' );

					// Check the checkbox!
					$( this ).prop( 'checked', true );
				} else {

					// Show the normal view
					$( '.revisions' ).removeClass( 'timeline' );

					// Un-check the checkbox!
					$( this ).prop( 'checked', false );

				}
		} );
	});


	$( '.easteregg a' ).on( 'click', function() {
		document.location = _revisionsplus.easteregg;
	});
}(jQuery));
