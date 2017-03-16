var countMess = 0;
var countTuto = 0;
var countAstuce = 0;
var countQuiz = 0;
var on;
var onTutorat;
var onAstuce;

/**
 * Temps de rafraichissement de recuperation des donnees
 *
 * @param timeoutPeriod
 */
function timedRefresh(timeoutPeriod) {
    setTimeout(update,timeoutPeriod);
}

/**
 * Notifications Ajax
 *
 * Mis a jour des donnees dynamique avec ajax avec interval
 */
function update() {
    $.get(path+"getNotificationPub", function (data) {
        countMess++;
        countTuto++;
        countAstuce++;
        countQuiz++;

        var btnMessage;
        var btnTutorat;
        var btnAstuce;
        var btnQuiz;

        console.log(data);
        data = JSON.parse(data);
        console.log(data);
        console.log(data.length);

        var tutoratNb = data.tutorat.length;
        var messageNb = data.message.length;
        var astuceNb = data.astuce.length;
        var quizNb = data.quiz.length;
        var countNotificationMessage = 0;
        var countNotificationTutorat = 0;
        var countNotificationAstuce = 0;
        var countNotificationQuiz = 0;


        for(var j=0;j<messageNb;j++) {
            if(data.message[j].notificationVue==null) {
                countNotificationMessage++;
                console.log(countNotificationMessage);
            }
        }

        for(var k=0;k<tutoratNb;k++) {
            if(data.tutorat[k].notificationVue==null) {
                countNotificationTutorat++;
            }
        }

        for(var l=0;l<astuceNb;l++) {
            if(data.astuce[l].notificationVue==null) {
                countNotificationAstuce++;
            }
        }


        var strMessage="";
        var strTutorat="";
        var strAstuce="";
        var strQuiz="";

        for(var i=0;i<data.message.length;i++) {
            if(data.message[i].notificationVue==null) {
                strMessage += '<mark><a class="dropdown-item messageAll" data-notification="'+data.message[i].id+'" href="../afficherPubliDetail/'+data.message[i].idPublication+'">'+data.message[i].texte+" par : "+data.message[i].courrielUtil+'</a></mark><br><br>';

            } else {
                console.log("hello");
                console.log(data.message[i]);
                strMessage += '<a class="dropdown-item messageAll" data-notification="'+data.message[i].id+'" href="../afficherPubliDetail/'+data.message[i].idPublication+'">'+data.message[i].texte+" par : "+data.message[i].courrielUtil+'</a><br><br>';
            }
        }

        for(var i=0;i<data.tutorat.length;i++) {
            if(data.tutorat[i].notificationVue==null) {
                strTutorat += '<mark><a class="dropdown-item tutoratAll" data-notification="'+data.tutorat[i].id+'" href="../afficherPubliDetail/'+data.tutorat[i].idPublication+'">'+data.tutorat[i].texte+" par : "+data.tutorat[i].courrielUtil+'</a></mark><br><br>';

            } else {
                console.log("hello");
                console.log(data.message[i]);
                strTutorat += '<a class="dropdown-item tutoratAll" data-notification="'+data.tutorat[i].id+'" href="../afficherPubliDetail/'+data.tutorat[i].idPublication+'">'+data.tutorat[i].texte+" par : "+data.tutorat[i].courrielUtil+'</a><br><br>';
            }
        }

        for(var i=0;i<data.astuce.length;i++) {
            if(data.astuce[i].notificationVue==null) {
                strAstuce += '<mark><a class="dropdown-item astuceAll" data-notification="'+data.astuce[i].id+'" href="../afficherPubliDetail/'+data.astuce[i].idPublication+'">'+data.astuce[i].texte+" par : "+data.astuce[i].courrielUtil+'</a></mark><br><br>';

            } else {
                console.log("hello");
                console.log(data.astuce[i]);
                strTutorat += '<a class="dropdown-item astuceAll" data-notification="'+data.astuce[i].id+'" href="../afficherPubliDetail/'+data.astuce[i].idPublication+'">'+data.astuce[i].texte+" par : "+data.astuce[i].courrielUtil+'</a><br><br>';
            }
        }
        console.log(data.message);

        btnMessage = '<div id="dropdownMessage" class="btn-group btn-block"><button class="btn btn-sm btn-danger dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Messages <span class="badge">'+countNotificationMessage+'</span></button><div id="myDropDown" class="dropdown-menu">'+strMessage+'</div></div><br>';
        console.log(messageNb+" messages");

        btnTutorat = '<div id="dropdownTutorat" class="btn-group btn-block"><button class="btn btn-sm btn-danger dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Tutorats <span class="badge">'+countNotificationTutorat+'</span></button><div id="myDropDown" class="dropdown-menu">'+strTutorat+'</div></div><br>';
        console.log(messageNb+" messages");

        btnAstuce = '<div id="dropdownAstuce" class="btn-group btn-block"><button class="btn btn-sm btn-danger dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Astuces <span class="badge">'+countNotificationAstuce+'</span></button><div id="myDropDown" class="dropdown-menu">'+strAstuce+'</div></div><br>';
        console.log(messageNb+" messages");

        btnQuiz = '<button class="btn btn-primary" type="button"> Quiz <span class="badge">'+quizNb+'' +
            '</span></button><br>';
        console.log(countMess);


        if(countMess==1) {
            $("#notificationMessage").html(btnMessage);
        }

        if(on==false) {
            console.log("last");
            console.log(btnMessage);
            $("#notificationMessage").html(btnMessage);
        }

        $('#dropdownMessage').on('show.bs.dropdown', function () {
            console.log("true");
            if(countMess>1) {
                on=true;
            }


        }).on('hide.bs.dropdown', function () {
            console.log("hidden");
            if(countMess>1) {
                on=false;
            }



        });

        if(countTuto==1) {
            $("#notificationTutorat").html(btnTutorat);
        }

        if(onTutorat==false) {
            console.log("last");
            console.log(btnTutorat);
            $("#notificationTutorat").html(btnTutorat);
        }

        $('#dropdownTutorat').on('show.bs.dropdown', function () {
            console.log("true");
            if(countTuto>1) {
                onTutorat=true;
            }


        }).on('hide.bs.dropdown', function () {
            console.log("hidden");
            if(countTuto>1) {
                onTutorat=false;
            }



        });



        if(countAstuce==1) {
            $("#notificationAstuce").html(btnAstuce);
        }

        if(onAstuce==false) {
            console.log("last");
            console.log(btnAstuce);
            $("#notificationAstuce").html(btnAstuce);
        }

        $('#dropdownAstuce').on('show.bs.dropdown', function () {
            console.log("true");
            if(countAstuce>1) {
                onAstuce=true;
            }


        }).on('hide.bs.dropdown', function () {
            console.log("hidden");
            if(countAstuce>1) {
                onAstuce=false;
            }



        });


        console.log(on);
        console.log(onTutorat);


        $(".messageAll").on("click" , function () {
            var clicked = $(this).data("notification");
            $.ajax({
                url : path+'updateNotification',
                type : 'POST',
                data: { id: clicked },
                success : function(resultat, statut){
                    console.log(resultat+statut);
                },
                error : function(resultat, statut, erreur){
                    console.log(resultat+statut+erreur);
                }
            });
        });

        $(".tutoratAll").on("click" , function () {
            var clicked = $(this).data("notification");
            $.ajax({
                url : path+'updateNotification',
                type : 'POST',
                data: { id: clicked },
                success : function(resultat, statut){
                    console.log(resultat+statut);
                },
                error : function(resultat, statut, erreur){
                    console.log(resultat+statut+erreur);
                }
            });
        });

        $(".astuceAll").on("click" , function () {
            var clicked = $(this).data("notification");
            $.ajax({
                url : path+'updateNotification',
                type : 'POST',
                data: { id: clicked },
                success : function(resultat, statut){
                    console.log(resultat+statut);
                },
                error : function(resultat, statut, erreur){
                    console.log(resultat+statut+erreur);
                }
            });
        });


        //Mis a jour des donnees a 2 secondes
        timedRefresh(2000);
    });
}

update();
