<section><br><br>
    <h1>Inscription</h1>
<div class="bs-callout bs-callout-warning hidden">
    <h4>Erreur!</h4>
    <p>Le formulaire n'est pas valide</p>
    <div id="erreurs"></div>
</div>

<div class="bs-callout bs-callout-info hidden">
    <h4>Success!</h4>
    <p>Le formulaire est valide</p>
</div>
<form id="form1" name="form1" action="confirmationInscription" method="POST" data-parsley-validate="">

    <div id="error"><?php echo $string = (isset($data['empty'])) ? $data['empty']:  '';?></div><br>
    <label >Nom :</label>
    <input type="text"
           data-parsley-required="true" data-parsley-required-message="Le champ nom est requis" data-parsley-maxlength="70" data-parsley-errors-container='#erreurs' name="nom"
           value="<?php echo $string = (isset($_POST['nom'])) ? $_POST['nom']:  '';?>"/> <br>
    <span><?php echo $string = (isset($data['nom'])) ? $data['nom']:  '';?></span>
    <br>
    <label >Prenom :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le champ prenom est requis" data-parsley-maxlength="70" data-parsley-errors-container='#erreurs' type="text"  name="prenom"
           value="<?php echo $string = (isset($_POST['prenom'])) ? $_POST['prenom']:  '';?>"/> <br>
    <span><?php echo $string = (isset($data['prenom'])) ? $data['prenom']:  '';?></span>
    <br>
    <label >Courriel :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le champ courriel est requis" data-parsley-type="email" data-parsley-errors-container='#erreurs'  type="text"  name="courriel"
           value="<?php echo $string = (isset($_POST['courriel'])) ? $_POST['courriel']:  '';?>"/> <br>
    <span><?php echo $string = (isset($data['email'])) ? $data['email']:  '';?></span>
    <br>
    <label >Mot de passe :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le mot de passe est requis" data-parsley-errors-container='#erreurs' id="pw" type="text"  name="mpasse" /> <br>
    <span><?php echo $string = (isset($data['mot_passe'])) ? $data['mot_passe']:  '';?></span>
    <br>
    <label >Confirmer mot de passe :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le champ confirmation de mot de passe est requis" data-parsley-errors-container='#erreurs' data-parsley-equalto="#pw" type="text"  name="mpasse_conf"/><br>
    <span><?php echo $string = (isset($data['conf_mot_passe'])) ? $data['conf_mot_passe']:  '';?></span>
    <br>
    <label >Statut :</label>
    <select name="statut">
        <option value="1">Tuteur</option>
        <option value="2">Etudiant</option>
    </select>
    <br>
    <label >Ville :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le champ ville est requis" data-parsley-errors-container='#erreurs' data-parsley-maxlength="70" type="text"  name="ville"
           value="<?php echo $string = (isset($_POST['ville'])) ? $_POST['ville']:  '';?>"/><br>
    <span><?php echo $string = (isset($data['ville'])) ? $data['ville']:  '';?></span>
    <br>
    <label >Province :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le champ province est requis" data-parsley-errors-container='#erreurs' data-parsley-maxlength="70" type="text"  name="province"
           value="<?php echo $string = (isset($_POST['province'])) ? $_POST['province']:  '';?>"/><br>
    <span><?php echo $string = (isset($data['province'])) ? $data['province']:  '';?></span>
    <br>
    <label >Pays :</label>
    <input data-parsley-required="true" data-parsley-required-message="Le champ pays est requis" data-parsley-errors-container='#erreurs' data-parsley-maxlength="70" type="text"  name="pays"
           value="<?php echo $string = (isset($_POST['pays'])) ? $_POST['pays']:  '';?>"/><br>
    <span><?php echo $string = (isset($data['pays'])) ? $data['pays']:  '';?></span>
    <br>

    <button id="effectuer" class="btn btn-danger btn-block" style="margin-left:25%;width:50%;" type="submit">Effectuer l'inscription</button>
<br><br>
</form>

</section>
<script type="text/javascript">
    $(function () {
        $('#form1').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
            .on('form:submit', function() {
                return true; // Don't submit form for this demo
            });
    });
</script>

