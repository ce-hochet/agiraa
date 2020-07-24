jQuery( function( $ ) {
    if ( window.elementorFrontend && elementorFrontend.hooks !== 'undefined' && elementorFrontend.hooks.addAction !== 'undefined' ) {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ) {
            var $target = $scope.find('[data-ride="slick"]');
            if( $target.length ) {
                $target.each( function() {
                    var $slickCarousel = $(this);
                    $slickCarousel.slick();
                });
            }
        } );
    }
} );