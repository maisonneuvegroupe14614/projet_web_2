

<section>
    <br><br>
    <h1>Connexion</h1>

    <form action="verifierIdentification" method="post">		<!--<form action="verifierIdentification" method="post">-->
        <br><br>

        <label>Nom d'utilisateur : </label>
        <input type="text" name="user"> <br>

        <label id="password">Mot de passe : </label>
        <input type="password" name="password"> <br><br>

        <button class="bouton" type="submit"><span>Se connecter</span></button><br><br><br>
        <p id="choix_acces">Ou</p><br><br><br>
        <a id="bouton_inscription" href="<?php echo path?>client/inscription"><span>S'inscrire</span></a>

    </form>
</section>
