<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?php echo path; ?>templates/js/config.js"></script>
    <script type="text/javascript" src="<?php echo path; ?>templates/js/desinscription.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?php echo path; ?>validation/parsley.min.js"></script>
    <link href="<?php echo path; ?>validation/parsley.css" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/redmond/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo path; ?>templates/css/style.css">

    <title>Scholar Net</title>
</head>
<div id="conteneur">
    <header>
        <section>
            <img id="logo" src="<?php echo path; ?>templates/images/logo.png" width="297" height="100"></img>
            <nav id="menu-principal">
                <?php if(isset($_SESSION['courriel'])){?>
                <ul id="menu">
                    <li>
                        <a href="#"><img id="hamburger" src="<?php echo path; ?>templates/images/hamburger.png"
                                         width="54" height="57"></img></a>
                        <ul>
                            <li><a href="<?php echo path; ?>client/afficherMessage/<?php echo $data2 ?>">
                                    Boite de réception</a></li>
                            <li><a href="#">Trouver des amis</a></li>
                            <li><a href="<?php echo path.'client/logout'?>">Se déconnecter</a></li>
                            <li><a id="openerDesinscription" href="#">Désinscrire</a></li>

                        </ul>
                    </li>
                </ul>
            </nav>
            <?php } ?>
        </section>
    </header>
    <div id="dialog-desinscription" title="Effacer votre compte">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Etes-vous sur de vouloir supprimer votre compte?</p>
    </div>