        <article class="center">
                <?php if(isset($data["utilisateur"])):
                    foreach ($data["utilisateur"] as $utilisateur) {
                        echo "<div><a href=".path."client/ami/$utilisateur->courriel>".$utilisateur->nom."  ".
                            $utilisateur->prenom."</a>".'<button class="retirer_ami btn-sm btn-warning btn btn_amis" 
                            value="'.$utilisateur->courriel.'">Enlever</button></div>'."<br>";
                    }
                endif; ?>

        </article>
    </article>
</section>

<div id="dialog-confirm" title="Effacer un ami">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Etes-vous sur de vouloir supprimer cet amis?</p>
</div>

<script type="text/javascript" src="<?php echo path; ?>templates/js/dialog.js"></script>

