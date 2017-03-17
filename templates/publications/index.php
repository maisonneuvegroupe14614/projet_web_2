<div id="publications">
    <?php
    foreach($data["publication"] as $publication) { ?>
        <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
            <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation."<br>".$publication->titre ?></p>

            <img src="<?php echo path; ?>templates/images/lire.png"      width="20" height="20">&nbsp;</img><a class="afficher droite pointeur" style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Lire     </a>
            <img src="<?php echo path; ?>templates/images/evaluer.png"   width="20" height="20">&nbsp;</img><a class="evaluer  droite pointeur" style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Évaluer  </a>
            <img src="<?php echo path; ?>templates/images/supprimer.png" width="20" height="20">&nbsp;</img><a class="supprimer   pointeur" style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Supprimer</a>
            <div class="affichage" title="<?php echo $publication->titre ?>" data-id="<?php echo $publication->id ?>">
                <form action="<?php echo path; ?>client/afficherPubliDetail/<?php echo $data2; ?>" method="post">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active"><br>
                            <div class="form-group">
                                <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation ?></p>
                                <p><?php echo $publication->texte ?></p>
                                <p><?php echo $publication->url   ?></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="evaluation" title="Évaluer une Publication" data-id="<?php echo $publication->id ?>">
                <form  data-parsley-validate action="<?php echo path; ?>client/ajouterEvaluation/<?php echo $data2; ?>" method="post">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active"><br>
                            <div class="form-group">
                                <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="evaluations"></textarea>
                                <input data-parsley-required="true" data-parsley-required-message="Ce champ est requis" type="number" name="note" id="note" min="0" max="5" value="0">
                            </div>

                            <?php
                            foreach ($data["amis"] as $ami) {
                                echo "<option value='".$ami->courriel."'>".$ami->courriel."</option>";
                            }
                            ?>
                            <input type="hidden" name="idPublication" value="<?php echo $publication->id ?>">
                            <input type="submit" class="btn btn-primary"></input>
                        </div>
                    </div>
                    <div class="notes"></div>
                </form>
            </div>


            <div class="suppression" title="<?php echo $publication->titre ?>" data-id="<?php echo $publication->id ?>">
                <form action="<?php echo path; ?>client/supprimerPub/<?php echo $data2; ?>" method="post">
                    Êtes-vous sûr de vouloir supprimer cette publication ?<br><br>
                    <input type="hidden" name="idPublication" value="<?php echo $publication->id ?>">
                    <input type="submit" class="btn btn-danger" value="Supprimer"></input>
                </form>
            </div>
        </div>
    <?php } ?>
</div>