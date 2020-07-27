jQuery(document).ready(function( $ ){
    $('#job_location, #company_location').geocomplete(jobhunt_options.location_geocomplete_options).bind( "geocode:result", function( event, result ) {
            
    });
});

