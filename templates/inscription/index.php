<div class="bs-callout bs-callout-warning hidden">
    <h4>Erreur!</h4>
    <p>Le formulaire n'est pas valide</p>
</div>

<div class="bs-callout bs-callout-info hidden">
    <h4>Success!</h4>
    <p>Le formulaire est valide</p>
</div>
<form id="form1" name="form1" action="confirmationInscription" method="POST" data-parsley-validate="">


    <label >Nom :</label>
    <input type="text"
           data-parsley-required="true" data-parsley-maxlength="70" name="nom"/>
    <br>
    <label >Prenom :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="prenom"/>
    <br>
    <label >Courriel :</label>
    <input data-parsley-required="true" data-parsley-type="email" type="text"  name="courriel"/>
    <br>
    <label >Mot de passe :</label>
    <input data-parsley-required="true" id="pw" type="text"  name="mpasse"/>
    <br>
    <label >Confirmer mot de passe :</label>
    <input data-parsley-required="true" data-parsley-equalto="#pw" type="text"  name="mpasse_conf"/>
    <br>
    <label >Ville :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="ville"/>
    <br>
    <label >Ville :</label>
    <select name="statut">
        <option value="1">Tuteur</option>
        <option value="2">Etudiant</option>
    </select>
    <br>
    <label >Province :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="province"/>
    <br>
    <label >Pays :</label>
    <input data-parsley-required="true" data-parsley-maxlength="70" type="text"  name="pays"/>
    <br>

    <button class="button icon" type="submit"><span>Effectuer l'inscription</span></button>

</form>

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