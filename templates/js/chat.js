$( function() {
    $("#dialogListeConnecte").dialog({
        autoOpen: false,
        modal:true,

        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        }
    });

    $("#openerListeConnecte").on("click", function () {
        $("#dialogListeConnecte").dialog("open");
        $("#chat_group").dialog("close");


    });


    $("#chat_group").dialog({
        autoOpen: false,
        modal: true,

        show: {
            effect: "blind",
            duration: 1000
        },
        hide: {
            effect: "explode",
            duration: 1000
        }
    });

    $(".amiChat").on("click", function (evt) {
        valeur = evt.target.value;
        console.log(evt.target.value);

        $("#dialogListeConnecte").dialog("close");
        document.getElementById("mon_ami").innerHTML = valeur;
        $("#chat_group").dialog("close");
        $("#chat_group").dialog("open");


    });


    $("#openerListeConnecte").on("click", function () {

        $.ajax({
            url: path+'client/liste_connecte',
            type: 'POST',
            success: function (resultat, statut) {
                var data = JSON.parse(resultat);
                amis = '';
                for (i = 0; i < data.connectes.length; i++) {
                    if (data.connectes[i].courrielUtil != data.moi) {
                        amis += '<a  class="amiChat" onClick="chatter(this);">' + data.connectes[i].courrielUtil + '</a><br>'
                    }
                }
                $("#dialogListeConnecte").html(amis);
            },
            error: function (resultat, statut, erreur) {
                console.log(resultat + statut + erreur);
            }
        });
    });
    function chatter(evt) {
        $("#chat_group").dialog({
            autoOpen: false,
            modal:true,
            maxHeight: 500,
            minWidth: 400,
            position: {my: "center", at: "center", of: "#opener"},
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });

        $.ajax({
            url: path+'client/chat_messages',
            type: 'POST',
            data: {destinataire: evt.textContent},
            success: function (resultat, statut) {
                var message = eval("(" + resultat + ")");
                console.log(JSON.parse(resultat));
                var chat_text = '';

                for (i = 0; i < message[0].length; i++) {
                    chat_text += '<p ><h6 style="color:blue">' + message[0][i].courrielUtil + '</h6>' + message[0][i].text + '</p><br>';
                }
                document.getElementById("text_chat").innerHTML = chat_text;

            },
            error: function (resultat, statut, erreur) {
                console.log(resultat + statut + erreur);
            }
        });


        valeur = evt.textContent;
        console.log(evt.textContent);

        $("#dialogListeConnecte").dialog("close");
        document.getElementById("mon_ami").innerHTML = valeur;

        document.getElementById("destinataire").value = valeur;
        $("#chat_group").dialog("open");


    }

    function envoyer_chat() {
        $.ajax({
            url: path+'client/chat',
            type: 'POST',
            data: {
                destinataire: document.getElementById("destinataire").value,
                chat: document.getElementById("message_chat").value
            },
            success: function (resultat, statut) {
                console.log('succes');
                var message = eval("(" + resultat + ")");
                var chat_text = '';
                //console.log(message.chat[0].text);
                for (i = 0; i < message.chat.length; i++) {
                    chat_text += '<p><h6 style="color:blue">' + message.chat[i].courrielUtil + '</h6>' + message.chat[i].text + '</p><br>';
                }
                document.getElementById("text_chat").innerHTML = chat_text;


            },
            error: function (resultat, statut, erreur) {
                console.log(resultat + statut + erreur);
            }
        });
    }
});