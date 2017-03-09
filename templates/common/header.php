<html>
<head>
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>

    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="../validation/parsley.min.js"></script>
    <link href="../validation/parsley.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo path; ?>templates/css/style.css">
    <title>Dashboard</title>
    <style>
        .container {
            max-width:1200px;
            background-color:blue;
            margin-left:auto;
            margin-right:auto;
        }
    </style>
</head>

<div id="conteneur">
    <header>
        <section>
            <img id="logo" src="<?php echo path; ?>templates/images/logo.png" width="297" height="100"></img>

            <nav id="menu-principal">
                <?php if(isset($_SESSION['courriel'])){?>
                <ul id="menu">
                    <li>
                        <a href="#"><img id="hamburger" src="<?php echo path; ?>templates/images/hamburger.png" width="54" height="57"></img></a>
                        <ul>
                            <li><a href="../afficherMessage/<?php echo $data2 ?>">Boite de réception</a></li>
                            <li><a href="#">Trouver des amis</a></li>
                            <li><a href="<?php echo path.'client/logout'?>">Se déconnecter</a></li>
                            <li><a id="openerDesinscription" href="#">Désinscrire</a></li>

                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="dialogDesinscription" title="Confirmation">
                <p>voulez vous vraiment desinscrire <?php echo $_SESSION['courriel']?></p>
                <form>
                    <button value="desinscription" name='desinscription'  formmethod='post' formaction='<?php echo path."client/desinscription"?>' type="submit" id="desinscription" class="btn btn-danger">Oui</button>
                    <button formmethod='post' formaction='' type="submit"  class="btn btn-success">Cancel</button>
                </form>
            </div>
            <?php } ?>
        </section>
    </header>
    <script>
        $( function() {
            $( "#dialogDesinscription" ).dialog({
                autoOpen: false,
                show: {
                    effect: "blind",
                    duration: 1000
                },
                hide: {
                    effect: "explode",
                    duration: 1000
                }
            });

            $( "#openerDesinscription" ).on( "click", function() {
                $( "#dialogDesinscription" ).dialog( "open" );
                x = document.getElementById("confirmation_supression").style.visibility ;
                //console.log(x);
                if(x=='visible'){
                    document.getElementById("confirmation_supression").style.visibility = 'hidden';
                }
            });
            $( "#desinscription" ).on( "click", function() {
                console.log("desinscription");
            });
        } );
    </script>