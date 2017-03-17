 <article class="center">
<?php
/*espace d un utilisateur*/

$array=[];
foreach ($data["liste_mes_amis"] as $utilisateur) {
    $array[]=$utilisateur->courriel;
}
$key = in_array($data["courriel_xx"], $array); // $key = 2;
//echo $data["courriel_xx"].'<br>';
//print_r($array);
if($key){
    $ajouter = '';
}else {
    switch ($data["btn_ajouter"]) {
        case 1:
            $ajouter = '<form action="' . path . 'client/demande_ami" method="post">
    <button class="btn btn-warning btn-sm" name="demande_ami" type="submit"  value="' . $data["courriel_xx"] . ' "  >ajouter comme ami</button>
</form>';
            break;
        case 2:
            $ajouter = '<p style="color:blue;">Demande en cours</p>';
            break;
        case 3:
            $ajouter = '<form action="' . path . 'client/accepte_ami" method="post">
    <button class="btn btn-warning btn-sm" name="accepte_ami" type="submit"  value="' . $data["courriel_xx"] . ' "  >accepte comme ami</button>
    <button class="btn btn-warning btn-sm" name="refuse_ami" type="submit"  value="' . $data["courriel_xx"] . ' "  >refusé la demande </button>
</form>';
            break;
    }
}


  ?>
     <div class="titre">
        <?php echo '<h5 class="textcenter">Espace de  '.$data["user"]->prenom." ".$data["user"]->nom.$ajouter.'</h5>'; ?>
        </div>
     <ul class="nav nav-tabs tabs_amis">
         <li class="active"><a data-toggle="tab" href="#messagesAmi">Messages</a></li>
         <li><a data-toggle="tab" href="#tutorats">Tutorats</a></li>
         <li><a data-toggle="tab" href="#astuces">Astuces</a></li>
         <li><a data-toggle="tab" href="#quiz">Quiz</a></li>
     </ul>
     <br><br><br>
     <div class="tab-content">
         <div id="messagesAmi" class="tab-pane fade in active">
             <div id="publications">
                 <button class="btn btn-primary creer_pub" id="openerPublication">Nouvelle Publication</button>
                 <?php
                 foreach($data["publication_ami_messages"] as $publication) {
                     ?>
                     <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
                         <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation."<br>".$publication->titre ?></p>

                         <img src="<?php echo path; ?>templates/images/lire.png"      width="20" height="20">
                         <a class="afficher droite pointeur" style="font-size:9pt; color:#7C3840;"
                            data-id="<?php echo $publication->id ?>">Lire     </a>
                         <img src="<?php echo path; ?>templates/images/evaluer.png"   width="20" height="20">
                         <a class="evaluer  droite pointeur" style="font-size:9pt; color:#7C3840;"
                            data-id="<?php echo $publication->id ?>">Évaluer  </a>

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
                             <form data-parsley-validate action="<?php echo path; ?>client/ajouterEvaluation/<?php echo $data2; ?>" method="post">
                                 <div class="tab-content">
                                     <div id="home" class="tab-pane fade in active"><br>
                                         <div class="form-group">
                                             <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="evaluations"></textarea>
                                             <input type="number" name="note" id="note" min="1" max="5" value="1">
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

                     <?php
                 }
                 ?>
             </div>
         </div>
         <div id="tutorats" class="tab-pane fade">
             <div id="publications">
                 <?php
                 foreach($data["publication_ami_tutorats"] as $publication) {
                     ?>
                     <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
                         <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation."<br>".$publication->titre ?></p>

                         <img src="<?php echo path; ?>templates/images/lire.png"      width="20" height="20">
                         <a class="afficher droite pointeur" style="font-size:9pt; color:#7C3840;"
                            data-id="<?php echo $publication->id ?>">Lire     </a>
                         <img src="<?php echo path; ?>templates/images/evaluer.png"   width="20" height="20">
                         <a class="evaluer  droite pointeur" style="font-size:9pt; color:#7C3840;"
                            data-id="<?php echo $publication->id ?>">Évaluer  </a>

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
                             <form data-parsley-validate action="<?php echo path; ?>client/ajouterEvaluation/<?php echo $data2; ?>" method="post">
                                 <div class="tab-content">
                                     <div id="home" class="tab-pane fade in active"><br>
                                         <div class="form-group">
                                             <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="evaluations"></textarea>
                                             <input type="number" name="note" id="note" min="1" max="5" value="1">
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

                     <?php
                 }
                 ?>
             </div>
         </div>

         <div id="astuces" class="tab-pane fade">
             <div id="publications">
                 <?php
                 foreach($data["publication_ami_astuces"] as $publication) {
                     ?>
                     <div class='publication'><img src="<?php echo path?>/templates/images/punaise.png"  width="30" height="30" class="centre"><br>
                         <p><?php echo $publication->courrielUtil.", ".$publication->dateCreation."<br>".$publication->titre ?></p>

                         <img src="<?php echo path; ?>templates/images/lire.png"      width="20" height="20">
                         <a class="afficher droite pointeur" style="font-size:9pt; color:#7C3840;"
                            data-id="<?php echo $publication->id ?>">Lire     </a>
                         <img src="<?php echo path; ?>templates/images/evaluer.png"   width="20" height="20">
                         <a class="evaluer  droite pointeur" style="font-size:9pt; color:#7C3840;"
                            data-id="<?php echo $publication->id ?>">Évaluer  </a>

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
                             <form data-parsley-validate action="<?php echo path; ?>client/ajouterEvaluation/<?php echo $data2; ?>" method="post">
                                 <div class="tab-content">
                                     <div id="home" class="tab-pane fade in active"><br>
                                         <div class="form-group">
                                             <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="evaluations"></textarea>
                                             <input type="number" name="note" id="note" min="1" max="5" value="1">
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

                     <?php
                 }
                 ?>
             </div>
         </div>
         <div id="quiz" class="tab-pane fade">
             <div id="qz">
             <table>
                 <tr>
                     <th>Nom Quiz</th>
                     <th>Date Creation</th>
                 </tr>
                 <?php foreach ($data["publication_ami_quiz"] as $quiz) :
                     echo "<tr><td><a href=".path."client/afficherQuizById/$quiz->id>".$quiz->titre."</a></td>";
                     echo "<td>".substr($quiz->dateCreation,0,10)."</td></tr>";
                 endforeach; ?>
             </table></div>
         </div>
     </div>





        <div id="dialog" title="Nouvelle Publication">


                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Message</a></li>
                    <li><a data-toggle="tab" href="#menu1">Tutorat</a></li>
                    <li><a data-toggle="tab" href="#menu2">Astuce</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <form data-parsley-validate action="<?php echo path; ?>client/ajouterPublicationAmi/<?php echo $data2; ?>" method="post">                            <br><br>
                            <div class="form-group">
                                <input data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            </div>
                            <div class="form-group">
                                <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="typePub" value="4">
                            <input type="submit" class="btn btn-primary" value="Envoyer"></input>
                        </form>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <form data-parsley-validate action="<?php echo path; ?>client/ajouterPublicationAmi/<?php echo $data2; ?>" method="post">                            <br><br>
                            <div class="form-group">
                                <input data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            </div>
                            <div class="form-group">
                                <input name="url" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="URL optionnel">
                            </div>
                            <div class="form-group">
                                <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="typePub" value="1">
                            <input type="submit" class="btn btn-primary" value="Envoyer">
                        </form>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <form data-parsley-validate action="<?php echo path; ?>client/ajouterPublicationAmi/<?php echo $data2; ?>" method="post">                            <br><br>
                            <div class="form-group">
                                <input data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="titre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
                            </div>
                            <div class="form-group">
                                <input name="url" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="URL optionnel">
                            </div>
                            <div class="form-group">
                                <textarea data-parsley-required="true" data-parsley-required-message="Ce champ est requis" name="publications" class="form-control" id="exampleTextarea"  placeholder="Texte" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="typePub" value="2">
                            <input type="submit" class="btn btn-primary" value="Envoyer">
                        </form>
                    </div>
                </div>
            </form>
        </div>
 </article>
 <article class="rightbar">

<?php
 if(isset($data["utilisateur_ami"])){
 echo "<h5>Amis</h5>";
 foreach ($data["utilisateur_ami"] as $utilisateur) {
 if($utilisateur->courriel == $_SESSION['courriel']){
 echo "<a href='".path."client/espace/$utilisateur->courriel'>".$utilisateur->courriel."</a><br>";

 }else{
 echo "<a href=../ami/$utilisateur->courriel>".$utilisateur->courriel."</a><br>";
 }

 }

 }

 ?>
 </article></article>
</section>
 <script type="text/javascript" src="<?php echo path; ?>templates/js/dialog.js"></script>
