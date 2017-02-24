<section>
<div class="bs-callout bs-callout-warning hidden">
    <h4>Erreur!</h4>
    <p>Le formulaire n'est pas valide</p>
</div>

<div class="bs-callout bs-callout-info hidden">
    <h4>Success!</h4>
    <p>Le formulaire est valide</p>
</div>
<form id="form1" name="form1" action="confirmationInscription" method="POST" data-parsley-validate="">

    <div id="error"><?php echo $string = (isset($data['empty'])) ? $data['empty']:  '';?></div><br>
    <label >Nom :</label>
    <input type="text"
           data-parsley-required="true" data-parsley-maxlength="70" name="nom"
           value="<?php echo $string = (isset($_POST['nom'])) ? $_POST['nom']:  '';?>"/> <br>
    <span><?php echo $string = (isset($data['nom'])) ? $data['nom']:  '';?></span>
    <br>
    <label >Prenom :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="prenom"
           value="<?php echo $string = (isset($_POST['prenom'])) ? $_POST['prenom']:  '';?>"/> <br>
    <span><?php echo $string = (isset($data['prenom'])) ? $data['prenom']:  '';?></span>
    <br>
    <label >Courriel :</label>
    <input data-parsley-required="true" data-parsley-type="email" type="text"  name="courriel"
           value="<?php echo $string = (isset($_POST['courriel'])) ? $_POST['courriel']:  '';?>"/> <br>
    <span><?php echo $string = (isset($data['email'])) ? $data['email']:  '';?></span>
    <br>
    <label >Mot de passe :</label>
    <input data-parsley-required="true" id="pw" type="text"  name="mpasse" /> <br>
    <span><?php echo $string = (isset($data['mot_passe'])) ? $data['mot_passe']:  '';?></span>
    <br>
    <label >Confirmer mot de passe :</label>
    <input data-parsley-required="true" data-parsley-equalto="#pw" type="text"  name="mpasse_conf"/><br>
    <span><?php echo $string = (isset($data['conf_mot_passe'])) ? $data['conf_mot_passe']:  '';?></span>
    <br>
    <label >Statut :</label>
    <select name="statut">
        <option value="1">Tuteur</option>
        <option value="2">Etudiant</option>
    </select>
    <br>
    <label >Ville :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="ville"
           value="<?php echo $string = (isset($_POST['ville'])) ? $_POST['ville']:  '';?>"/><br>
    <span><?php echo $string = (isset($data['ville'])) ? $data['ville']:  '';?></span>
    <br>
    <label >Province :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="province"
           value="<?php echo $string = (isset($_POST['province'])) ? $_POST['province']:  '';?>"/><br>
    <span><?php echo $string = (isset($data['province'])) ? $data['province']:  '';?></span>
    <br>
    <label >Pays :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="pays"
           value="<?php echo $string = (isset($_POST['pays'])) ? $_POST['pays']:  '';?>"/><br>
    <span><?php echo $string = (isset($data['pays'])) ? $data['pays']:  '';?></span>
    <br>

    <button class="button icon" type="submit">Effectuer l'inscription</button>

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

