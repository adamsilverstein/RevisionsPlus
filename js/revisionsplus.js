console.log(_revisionsplus);
(function($) {
	$( '.easteregg a' ).on( 'click', function() {
		console.log( 'click' );
		document.location = _revisionsplus.easteregg;
	});
}(jQuery));
