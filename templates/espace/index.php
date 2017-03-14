
<article class="center">
 <!--   <form action="../ajouterPublication/<?php /*echo $data2; */?>" method="post">
        <input type="text" id="titrePub"><br>
<textarea name="publications">
</textarea><br>
        <input type="text" name="url">
        <input type="submit">
    </form>-->
    <button class="btn btn-primary creer_pub" id="openerPublication">Nouvelle Publication</button>

    <div id="dialog" title="Nouvelle Publication">


        <form action="<?php echo path; ?>client/ajouterPublication/<?php echo $data2; ?>" method="post">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Message</a></li>
                <li><a data-toggle="tab" href="#menu1">Tutorat</a></li>
                <li><a data-toggle="tab" href="#menu2">Astuce</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <form action="<?php echo path; ?>client/ajouterPublication/<?php echo $data2; ?>" method="post">
                        <br><br>
                        <div class="form-group">
                            <input name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
<!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="4">
                        <input type="submit" class="btn btn-primary" value="Envoyer"></input>
                    </form>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <form action="<?php echo path; ?>client/ajouterPublication/<?php echo $data2; ?>" method="post">
                        <br><br>
                        <div class="form-group">
                            <input name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <input name="url" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="URL optionnel">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="1">
                        <input type="submit" class="btn btn-primary" value="Envoyer">
                    </form>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <form action="<?php echo path; ?>client/ajouterPublication/<?php echo $data2; ?>" method="post">
                        <br><br>
                        <div class="form-group">
                            <input name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <input name="url" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="URL optionnel">
                            <!--                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div>
                        <div class="form-group">
                            <textarea name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="typePub" value="2">
                        <input type="submit" class="btn btn-primary" value="Envoyer">
                    </form>
                </div>
            </div>
        </form>
    </div>






    <?php

    if(isset($data["publication"])) {
        /*mon mur*/
        ?>
        <div id="publications">
            <?php
            foreach($data["publication"] as $publication) { ?>
                <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
                    <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation."<br>".$publication->titre ?></p>

                    <img src="<?php echo path; ?>templates/images/lire.png"    width="20" height="20">&nbsp;</img><span class="droite afficher" style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Lire   </span>
                    <img src="<?php echo path; ?>templates/images/evaluer.png" width="20" height="20">&nbsp;</img><span class="droite evaluer"  style="font-size:9pt; color:#7C3840;" data-id="<?php echo $publication->id ?>">Évaluer</span>

                    <div class="affichage" title="<?php echo $publication->titre ?>" data-id="<?php echo $publication->id ?>">
                        <form action="../afficherPubliDetail/<?php echo $data2; ?>" method="post">
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
                        <form action="<?php echo path; ?>client/ajouterEvaluation/<?php echo $data2; ?>" method="post">
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active"><br>
                                    <div class="form-group">
                                        <textarea name="evaluations"></textarea>
                                        <input type="number" name="note" id="note" min="0" max="5" value="0">
                                    </div>
                                    <!--<select name="destinataire">
											<option value="1">Amis  </option>
											<option value="2">Public</option>
											<?php
                                    foreach ($data["amis"] as $ami) {
                                        echo "<option value='".$ami->courriel."'>".$ami->courriel."</option>";
                                    }
                                    ?>
										</select>-->
                                    <input type="hidden" name="idPublication" value="<?php echo $publication->id ?>">
                                    <input type="submit" class="btn btn-primary"></input>
                                </div>
                            </div>
                            <div class="notes"></div>
                        </form>
                    </div>

                </div>
            <?php } ?>
        </div><article class="mesamis">
    <?php }
    if(isset($data["utilisateur"])){
        foreach ($data["utilisateur"] as $utilisateur) {

            echo "<div><a href=".path."client/ami/$utilisateur->courriel>".$utilisateur->nom."  ".$utilisateur->prenom."</a>".'<button class="retirer_ami" value="'.$utilisateur->courriel.'">retirer de la list</button></div>'."<br>";
        }


        echo '<div id="id_div" hidden>
                        <h1>supression </h1>
                        </div>';
    }



 ?>
    </article></article>
</section>


<script type="text/javascript" src="<?php echo path; ?>templates/js/dialog.js"></script>

