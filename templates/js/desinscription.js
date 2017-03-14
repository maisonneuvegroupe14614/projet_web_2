$( function() {
    $( "#dialog-desinscription" ).dialog({
        resizable: false,
        autoOpen: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Oui": function() {

                $.post({
                    url : path+'desinscription',
                    success : function(resultat, statut){
                        $("#dialog-confirm").dialog("close");
                        $(location).attr('href', path+'identification');
                    },
                    error : function(resultat, statut, erreur){
                        console.log(resultat+statut+erreur);
                    }
                });

            },
            "Non": function() {
                $( this ).dialog( "close" );
            }
        }
    });

    $("#openerDesinscription").on("click", function () {
        console.log("click");
        $("#dialog-desinscription").dialog("open");
    });
});
