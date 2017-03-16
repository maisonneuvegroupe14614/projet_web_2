/**
 * Document Ready JQuery
 */
$( function() {
    $( "#dialog" ).dialog({
        width: 500,
        autoOpen: false,
        position: { my: "center", at: "top" },
        show: {
            effect: "clip",
            duration: 1000
        },
        hide: {
            effect: "drop",
            duration: 1000
        }
    });

    $( "#opener" ).on( "click", function() {
        $( "#dialog" ).dialog( "open" );
    });

    $( "#openerPublication" ).on( "click", function() {
        $( "#dialog" ).dialog( "open" );
    });
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        autoOpen: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Oui": function() {
                $.ajax({
                    url : path+'retirer_ami',
                    type : 'POST',
                    data: { target:target.value },
                    success : function(resultat, statut){
                        target.parentNode.remove();
                        $("#dialog-confirm").dialog("close");
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

    $( ".evaluation" ).dialog( {
        width: 500,
        autoOpen: false,
        modal: true,
        position: { my: "center", at: "center" },
        show: {
            effect: "clip",
            duration: 1000
        },
        hide: {
            effect: "drop",
            duration: 1000
        }
    } );

    $( ".evaluer" ).each(function() {
        $(this).on("click", function() {
            var id = $(this).data('id');
            $.post({
                url : path+'findEvaluation',
                data: { id:id },
                success : function(resultat, statut) {
                    console.log(resultat);
                    var res=JSON.parse(resultat);
                    var str="<br>";
                    for (var i=0; i<res.evaluation.length; i++) {
                        str += "<p>" + res.evaluation[i].courrielUtil + ", " + res.evaluation[i].dateCreation + "<br>" +
                            res.evaluation[i].texte        + " "  + res.evaluation[i].note         + "<br></p>";
                    }
                    $( ".notes" ).html(str);
                    $( ".evaluation[data-id = '" + id + "']").dialog( "open" );
                    console.log(resultat+statut);
                },
                error : function(resultat, statut, erreur) {
                    console.log(resultat+statut+erreur);
                }
            });
        });
    });

    $( ".affichage" ).dialog( {
        width: 500,
        autoOpen: false,
        modal: true,
        position: { my: "center", at: "center" },
        show: {
            effect: "clip",
            duration: 1000
        },
        hide: {
            effect: "drop",
            duration: 1000
        }
    } );

    $( ".afficher" ).each(function() {
        $(this).on("click", function() {
            $( ".affichage[data-id=" + $(this).data('id') + "]").dialog( "open" );
        });
    });

    $( ".glyphicon-remove" ).each(function() {
        $(this).on("click", function(event) {
            var target = $( event.target );
            console.log(target.data("id"));
            $.post({
                url : path+'retirerPublication',
                data: { id: target.data("id") },
                success : function(resultat, statut){
                    target.parent().remove();
                },
                error : function(resultat, statut, erreur){
                    console.log(resultat+statut+erreur);
                }
            });
        });
    });

});

var x = document.querySelectorAll(".retirer_ami");

for(var i=0;i<x.length;i++) {
    x[i].addEventListener("click", function (e) {
        target = e.target;
        $("#dialog-confirm").dialog("open");
    });
}
