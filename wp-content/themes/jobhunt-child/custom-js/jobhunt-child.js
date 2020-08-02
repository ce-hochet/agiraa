jQuery(document).ready(function( $ ){
    /*
     * 27/07/2020
     * BNORMAND
     * GEOCOMPLETE sur les champs Job & Company Location
     */ 
    $('#job_location, #company_location').geocomplete(jobhunt_options.location_geocomplete_options).bind( "geocode:result", function( event, result ) {
            
    });


    /*
     * 27/07/2020
     * BNORMAND
     * Gestion du champs RNA en fonction du role.
     */
    function deactivateRNAField() {
        $("#jobhunt_register_user_rna_block").hide()
        $("#jobhunt_register_user_rna_block input").attr("required", false)
        $("#register_b").prop('disabled', false);
    }

    function activateRNAField() {
        $("#jobhunt_register_user_rna_block").show()
        $("#jobhunt_register_user_rna_block input").attr("required", true)
        $("#register_b").prop('disabled', true);
    }

    deactivateRNAField();
    // Vérification du role choisie. Affichage & obligation du champ en fonction.
    $("#jobhunt_register_user_role").change(() => 
        $( "#jobhunt_register_user_role" ).val() === "employer" ? 
            activateRNAField() : deactivateRNAField()
    );
    $("#jobhunt_register_user_rna").on('input', () => {
        $("#register_b").prop('disabled', true);
        let rna_value = $("#jobhunt_register_user_rna").val();
        if(rna_value.length != 10){
            $("#jobhunt_register_user_rna_error").text("Le RNA est un code à 10 caractères.");
            $("#jobhunt_register_user_rna_error").css('color', '#DF3F52');
        } else {
            let url = "https://data.opendatasoft.com/api/records/1.0/search/?dataset=associations%40public&q=" + rna_value + "&facet=commune&facet=datedeclaration&facet=nom_dep&facet=nom_reg&facet=code_epci&facet=dept";
            $("#jobhunt_register_user_rna_error").text("Loading...");
            $.ajax({url: url, 
                success: function(result){
                    if(result.records.length == 0) {
                        $("#jobhunt_register_user_rna_error").text("Code RNA introuvable.");
                    } else {
                        $("#register_b").prop('disabled', false) 
                        $("#jobhunt_register_user_rna_error").html('<span class="las la-check-circle"></span> Validé.');
                        $("#jobhunt_register_user_rna_error").css('color',  '#b4c408');
                    }
                },
                error: function(error){
                    $("#jobhunt_register_user_rna_error").text("Erreur lors de la recherche. Actualiser votre page.")
                    $("#jobhunt_register_user_rna_error").css('color', '#DF3F52');
                }
            });
        }      
    })
});

