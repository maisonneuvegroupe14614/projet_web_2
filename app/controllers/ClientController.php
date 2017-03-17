<?php

session_start();

/**
 * Class ClientController
 */
class ClientController extends Controller {
    public function __construct($view,$request) {
        parent::__construct($view,$request);
    }

    /**
     * Identification
     *
     * Sert a afficher la page de login aux utilisateur si aucune session n'est presente
     *
     * @return mixed
     */
    public function identification () {
        if(isset($_SESSION["courriel"])) {
            header("Location:espace/".$_SESSION['courriel']);
        } else {
            return $this->view->load('login/index');
        }
    }

    /**
     * Logout
     *
     * Detruit la session et redirige au login
     */
    public function logout () {
        session_destroy();
        header("Location:identification");
    }

    /**
     * Verifier Identification
     *
     * Verifier si le mot de passe correspond avec le hash bcryt du mot de passe de la bd
     */
    public function verifierIdentification () {
        $password = $_POST["password"];
        $user = Utilisateur::find($_POST["user"]);
        if(!empty($user) && password_verify($password,$user->motPasse)) {
            $_SESSION["courriel"]=$user->courriel;
            header("Location:".path."client/espace/".$_SESSION['courriel']);
        } else {
            echo "Vous n'etes pas identifier correctement!";
        }
    }

    /**
     * Inscription
     *
     * Sert a afficher la page d'inscription aux utilisateurs si aucune session n'est presente
     */
    public function inscription () {
        if(isset($_SESSION["courriel"])) {
            header("Location:".path."client/espace/".$_SESSION['courriel']);
        } else {
            $this->view->load('inscription/index');
        }

    }

    /**
     * Confirmation Inscription
     *
     * Insertion dans la bd d'un nouvel utilisateur et validation des champs
     */
    public function confirmationInscription () {
        //Construction de la table des erreurs
        foreach ($_POST as $key => $value) {
            if(empty($value)){
                $tab_error['empty'] = "erreur ! veuillez verifier tous les champs";
            }
        }

        $validation = new Validation();
        $tab_error['nom']=$validation->validate_alpha($_POST['nom']);
        $tab_error['prenom']=$validation->validate_alpha($_POST['prenom']);
        $tab_error['ville']=$validation->validate_alpha($_POST['ville']);
        $tab_error['province']=$validation->validate_alpha($_POST['province']);
        $tab_error['pays']=$validation->validate_alpha($_POST['pays']);
        $tab_error['email']=$validation->validate_email($_POST['courriel']);
        $tab_error['mpasse']=$validation->validate_password($_POST['mpasse']);
        if($_POST['mpasse']!==$_POST['mpasse_conf']){
            $tab_error['conf_mot_passe'] = "veuillez reconfirmer votre mot de passe";
        }
        /*verification de la table d'erreur*/
        while (list(, $val) = each($tab_error)) {
            if ($val) {
                $error_bool = true;
                break;
            }
            $error_bool = false;
        }

        if(!$error_bool){
            $enregistrer = Utilisateur::enregistrer($_POST['courriel'],$_POST['mpasse'],$_POST['nom'],
                $_POST['prenom'],$_POST["statut"],$_POST['ville'],$_POST['province'],$_POST['pays']);
            if($enregistrer) {
                $_SESSION["courriel"]=$_POST['courriel'];

                header("Location:".path."client/espace/".$_SESSION['courriel']);
            } else {
                header("Location:".path."client/inscription");
            }



        }
        else{
            $this->view->load('inscription/index',$tab_error);
            var_dump($tab_error);
        }

    }

    /**
     * Deinscription
     *
     * Sert a afficher la page de desinscription aux utilisateurs si aucune session n'est presente
     */
    public function desinscription () {
        Utilisateur::desinscription($_SESSION["courriel"]);
        session_destroy();
    }

    /**
     * ConfirmationDesinscription
     *
     * Efface un utilisateur de la bd et detruit la session
     */
    public function confirmationDesinscription () {
        echo '<h1>'.$_SESSION["courriel"].'</h1>';
        Utilisateur::desinscription($_SESSION["courriel"]);
        session_destroy();
        header("Location:".path."client/identification");
    }

    /**
     * Espace
     *
     * Affiche l'espace de l'utilisateur
     *
     * @return mixed
     */
    public function espace () {
        if (isset($_SESSION["courriel"])) {
            //$data["utilisateur"] = Utilisateur::listeAmis($_SESSION['courriel']);
            $data["nom_utilisateur"] = Utilisateur::find_user_status($_SESSION["courriel"]);
            $data["publication"] = Publication::find($_SESSION["courriel"]);
            $data["demandes_recu"] = Utilisateur::demande_recu($_SESSION["courriel"]);
            $data2=$param = $this->request->getParam();
            return $this->view->load('espace/index', $data, $data2, 'sidebar');
        } else {
            header("Location:".path."client/identification");
        }
    }

    /**
     * Notifications Ajax
     *
     * Affiche les notifications de l'utilisateur
     */
    public function getNotificationPub () {
        $notification["message"] = NotificationPub::all($_SESSION["courriel"],4);
        $notification["tutorat"] = NotificationPub::all($_SESSION["courriel"],1);
        $notification["astuce"] = NotificationPub::all($_SESSION["courriel"],2);
        $notification["quiz"] = NotificationPub::allNotSeen($_SESSION["courriel"],3);
        echo json_encode($notification);

    }

    /**
     * Tutorats
     *
     * Affiche les publications qui sont des tutorats
     *
     * @return mixed
     */
    public function tutorats() {
        $data["demandes_recu"] = Utilisateur::demande_recu($_SESSION["courriel"]);
        $data["publication"] = Publication::find_etudiant_tutorats($_SESSION["courriel"]);
        $data["nom_utilisateur"] = Utilisateur::find_user_status($_SESSION["courriel"]);
        if (isset($_SESSION["courriel"])) {
            return $this->view->load('tutorats/index', $data, $data2=null, 'sidebar');
        } else {
            header("Location:".path."client/identification");
        }
    }

    /**
     * Messages
     *
     * Affiche les publications qui sont des messages
     *
     * @return mixed
     */
    public function messages() {
        $data["demandes_recu"] = Utilisateur::demande_recu($_SESSION["courriel"]);
        $data["publication"] = Publication::find_etudiant_messages($_SESSION["courriel"]);
        $data["nom_utilisateur"] = Utilisateur::find_user_status($_SESSION["courriel"]);
        if (isset($_SESSION["courriel"])) {
            return $this->view->load('message/espace', $data, $data2=null, 'sidebar');
        } else {
            header("Location:".path."client/identification");
        }
    }

    /**
     * Tutorats
     *
     * Affiche les publications qui sont des tutorats
     *
     * @return mixed
     */
    public function astuces() {
        $data["demandes_recu"] = Utilisateur::demande_recu($_SESSION["courriel"]);
        $data["publication"] = Publication::find_etudiant_astuces($_SESSION["courriel"]);
        $data["nom_utilisateur"] = Utilisateur::find_user_status($_SESSION["courriel"]);
        if (isset($_SESSION["courriel"])) {
            return $this->view->load('astuces/index', $data, $data2=null, 'sidebar');
        } else {
            header("Location:".path."client/identification");
        }
    }

    /**
     * Mes Amis
     *
     * Afficher les amis d'un utilisateur
     *
     * @return mixed
     */
    public function mes_amis() {
        $data["demandes_recu"] = Utilisateur::demande_recu($_SESSION["courriel"]);
        $data["utilisateur"] = Utilisateur::listeAmis($_SESSION['courriel']);
        $data["nom_utilisateur"] = Utilisateur::find_user_status($_SESSION["courriel"]);
        if (isset($_SESSION["courriel"])) {
            return $this->view->load('mes_amis/index', $data, $data2=null, 'sidebar');
        } else {
            header("Location:".path."client/identification");
        }
    }

    /**
     * Espace d'un ami
     *
     * Afficher l'espace d'un ami
     *
     * @return mixed
     */
    public function ami() {
        $data["demandes_recu"] = Utilisateur::demande_recu($_SESSION["courriel"]);
        $data["liste_mes_amis"] = Utilisateur::listeAmis($_SESSION['courriel']);
        $data["nom_utilisateur"] = Utilisateur::find_user_status($_SESSION["courriel"]);
        $data["publication_ami"] = Publication::find($this->request->getParam());
        $data["publication_ami_messages"] = Publication::findType($this->request->getParam(),4);
        $data["publication_ami_tutorats"] = Publication::findType($this->request->getParam(),1);
        $data["publication_ami_astuces"] = Publication::findType($this->request->getParam(),2);
        $data["publication_ami_quiz"] = Publication::findType($this->request->getParam(),3);
        $data["utilisateur_ami"] = Utilisateur::listeAmis($this->request->getParam());
        $data["user"] = Utilisateur::find($this->request->getParam());
        $data["courriel_xx"] = $this->request->getParam();
        $data2 = $this->request->getParam();
        $list_demande = Utilisateur::all_demande();
        $data["btn_ajouter"] = 1;
        $demande_envoye = trim($_SESSION['courriel']) . trim($data["courriel_xx"]);
        $demande_recu = trim($data["courriel_xx"]) . trim($_SESSION['courriel']);
        foreach ($list_demande as $demande) {
            $demande = trim($demande->courrielAmi) . trim($demande->courrielUtil);
            if ($demande == $demande_recu) {
                $data["btn_ajouter"] = 2;
            } elseif ($demande == $demande_envoye) {
                $data["btn_ajouter"] = 3;
            }
        }
        if (isset($_SESSION["courriel"])) {
            return $this->view->load('ami/index', $data, $data2, 'sidebar');
        } else {
            header("Location:".path."client/identification");
        }
    }

    /**
     * Demande ami
     *
     * Differentes requetes lors d'une demande d'amis
     */
    public function demande_ami() {
        $list_demande = Utilisateur::all_demande();
        $inser_demande = true;
        $ma_demande = $_SESSION['courriel'] . $_POST['demande_ami'];
        foreach ($list_demande as $demande) {
            $demandeAB = trim($demande->courrielUtil) . trim($demande->courrielAmi);
            $demandeBA = trim($demande->courrielAmi) . trim($demande->courrielUtil);
            if (($ma_demande == $demandeAB) || ($ma_demande == $demandeBA)) {
                $inser_demande = false;
                break;
            }
        }
        if ($inser_demande) {
            Utilisateur::demande_ami($_SESSION['courriel'], $_POST['demande_ami']);
            header("Location:" . path . "client/ami/" . $_POST['demande_ami']);
        }
    }

    /**
     * Accepter Ami
     *
     * Requete lors de l'acceptation d'un ami
     */
    public function accepte_ami() {
        if (isset($_POST['accepte_ami'])) {
            Utilisateur::accepte_demande ($_SESSION['courriel'],$_POST['accepte_ami']);
            Utilisateur::ajouter_ami($_SESSION['courriel'],$_POST['accepte_ami']);
            header("Location:".path."client/espace/".$_SESSION['courriel']);
        }
        if (isset($_POST['refuse_ami'])) {
            Utilisateur::refuse_demande ($_SESSION['courriel'],$_POST['refuse_ami']);
            header("Location:".path."client/espace/".$_SESSION['courriel']);
        }
    }

    /**
     * Effacer Ami
     *
     * Requete lors du retrait d'un ami
     */
    public function retirer_ami() {
        Utilisateur::retire_ami ($_SESSION['courriel'],$_REQUEST['target']);
        Utilisateur::retirer_demande ($_SESSION['courriel'],$_REQUEST['target']);
    }

   /* public function testAllUsers () {
        $user=Utilisateur::all();
        print_r($user);
    }

    public function testFindUser () {
        $user=Utilisateur::find("michael@hotmail.com");
        print_r($user);
    }

    public function testAllPublications () {
        $pub = Publication::all();
        print_r($pub);
    }

    public function testFindPublication () {
        $pub = Publication::find($_SESSION["courriel"]);
        print_r($pub);
    }

    public function testAllEvaluations () {
        $evaluation = Evaluation::all();
        print_r($evaluation);
    }

    public function testFindEvaluation () {
        $evaluation = Evaluation::find($_SESSION["courriel"]);
        print_r($evaluation);
    }*/

    /**
     * Ajout Publication Propre Espace
     *
     * Requete lors de l'ajout d'une publication
     */
    public function ajouterPublication () {
        Publication::enregistrer($_POST["typePub"],$_POST["titre"],$_POST["publications"],$_POST["url"],$_SESSION["courriel"],$_SESSION["courriel"]);
        header("Location:".path."client/espace/".$this->request->getParam());
    }

    /**
     * Ajout Publication Ami
     *
     * Requete lors de l'ajout d'une publication d'un ami
     */
    public function ajouterPublicationAmi () {
        Publication::enregistrer($_POST["typePub"],$_POST["titre"],$_POST["publications"],$_POST["url"],$_SESSION["courriel"],$this->request->getParam());
        NotificationPub::enregistrer("message",$this->request->getParam(),NotificationPub::last());
        header("Location:".path."client/ami/".$this->request->getParam());
    }

    /**
     * Afficher la page d'ajout d'un quiz
     *
     * Charger la vue de la page d'ajout d'un quiz
     *
     * @return mixed
     */
    public function afficherAjouterQuiz () {
        return $this->view->load('quiz/afficherAjouter', $data=null, $data2=null, 'sidebar');
    }

    public function ajouterQuiz () {
        Publication::Enregistrer(3,$_POST["nomQuiz"],"","",$_SESSION["courriel"],$_SESSION["courriel"]);
        $denierId = Publication::dernier();
        foreach ($_POST["questionnaire"] as $data) {
                Question::Enregistrer($data["question"],$data["valeur"],"multiple",$denierId);
                $denierIdQuestion = Question::dernier();
                foreach ($_POST["choix"] as $choix) {
                    if($data["question"]==$choix["noQuestion"]) {
                        Question::EnregistrerChoix($choix["noChoix"],$choix["choix"], $choix["reponse"],
                            $denierId,$denierIdQuestion);
                    }
                }
        }

        echo "success";
    }

    /**
     * Affiche la page des quiz d'un tuteur
     *
     * Charger la vue de la page de quiz d'un tuteur
     *
     * @return mixed
     */
    public function afficherQuizUtilisateur () {
        $statut= Utilisateur::find_user_status($_SESSION["courriel"]);
        if($statut->idStatut==1) {
            $data["quiz"] = Publication::findQuizByUser($_SESSION["courriel"]);
            return $this->view->load("quiz/afficherQuizUtilisateur",$data, $data2=null, 'sidebar');
        } elseif ($statut->idStatut==2) {
            $data["quiz"] = Publication::quizFaitEtudiant($_SESSION["courriel"]);
            return $this->view->load("quiz/afficherQuizEtudiant",$data, $data2=null, 'sidebar');
        }
    }

    /**
     * Affiche un quiz par id
     *
     * Requete pour trouver un quiz par id
     *
     * @return mixed
     */
    public function afficherQuizById () {
        $param = $this->request->getParam();
        $data["quiz"] = Publication::findQuiz($param);
        $data["question"] = Question::find($param);
        $data["choix"] = Question::allChoix($param);
        $data["statut"] = Utilisateur::find_user_status($_SESSION["courriel"]);
        return $this->view->load("quiz/afficherQuizById", $data, $param, 'sidebar');
    }

    /**
     * Mettre a jour les notifications
     *
     * Requete pdo pour ajouter les donnees dans la BD
     */
    public function updateNotification () {
        NotificationPub::update($_POST["id"]);
        echo "success";
    }

    /**
     * Afficher la page d'evaluation d'une publication
     *
     * Requete pour trouver les evaluations
     *
     * @return mixed
     */
    public function afficherEvaluation () {
        $param = $this->request->getParam();
        $data["evaluation"] = Evaluation::find($param);
        return $this->view->load('evaluation/index',$data,$param);
    }

    /**
     * Afficher les messages
     *
     * Requete pour trouver la liste d'ami d'un utilisateur
     *
     * @return mixed
     */
    public function afficherMessage () {
        $param = $this->request->getParam();
        $data["amis"] = Utilisateur::listeAmis($_SESSION['courriel']);
        return $this->view->load('message/index',$data,$param, 'sidebar');
    }

    /**
     * Afficher la page de partage d'une publications
     *
     * Trouver les partages d'une pub et chargement d'une vue
     *
     * @return mixed
     */
    public function afficherPartage () {
        $param = $this->request->getParam();
        $data["partage"] = Partage::find($param);
        return $this->view->load('partage/index',$data,$param,'sidebar');
    }

    /**
     * Afficher la les details d'une publication
     *
     * Trouver les details d'une pub et chargement d'une vue
     *
     * @return mixed
     */
    public function afficherPubliDetail () {
        $param = $this->request->getParam();
        $data["publiDetail"] = PubliDetail::find($param);
        return $this->view->load('publiDetail/index',$data,$param,'sidebar');
    }

    /*public function testAllMessages () {
        $message = Message::all();
        print_r($message);
    }*/

   /* public function testFindMessage () {
        $param = $this->request->getParam();
        $message = Message::find($param);
        print_r($message);
    }*/

    /**
     * Ajout d'une message dans la boite de reception
     *
     * Enregistrer le message et redirection vers la page en cour
     */
    public function ajouterMessage () {
        $param = $this->request->getParam();
        Message::enregistrer($_POST["sujet"],$_POST["messages"],$_POST["url"],$param,$_POST["courrielAmi"]);
        header("Location:".path."client/afficherMessage/".$param);
    }

    /*public function testAllPartages () {
        $partage = Partage::all();
        print_r($partage);
    }

    public function testFindPartage () {
        $param = $this->request->getParam();
        $partage = Partage::find($param);
        print_r($partage);
    }*/

    /**
     * Ajout partage d'une publication
     *
     * Requete pour partager une pub et redirection sur la page en cours
     */
    public function ajouterPartage () {
        $param = $this->request->getParam();
        Partage::enregistrer($_POST["destinataire"],$_POST["idPublication"],$param,$_POST["courrielAmi"]);
        header("Location:".path."client/afficherPartage/".$param);
    }

   /* public function testFindPubliDetail () {
        $param = $this->request->getParam();
        $publiDetail = PubliDetail::find($param);
        print_r($publiDetail);
    }*/

    /**
     * Ajout evaluation d'une publication
     *
     * Requete pour ajouter une evaluation a une pub et redirection sur la page en cours
     */
    public function ajouterEvaluation () {
        $param = $this->request->getParam();
        Evaluation::enregistrer($_POST["evaluations"],$_POST["note"],$_POST["idPublication"],$_SESSION["courriel"]);
        header("Location:".path."client/espace/".$param);
    }

    /**
     * Trouver une evaluation Ajax
     *
     * Trouver les evaluations d'une pub
     */
    public function findEvaluation () {
        $data["evaluation"] = Evaluation::find($_POST["id"]);
        echo json_encode($data);
    }

    /**
     * Trouver un message Ajax
     *
     * Requete pour trouver les messages
     */
    public function findMessage () {
        $data["message"] = Message::find($_POST["courrielAmi"],$_SESSION["courriel"]);
        echo json_encode($data);
    }

    /**
     * Score d'un quiz Ajax
     *
     * Ajout du score d'un etudiant qui participe a un quiz
     */
    public function scoreQuiz () {
        Publication::quizFait($_SESSION["courriel"],$_POST["idQuiz"],$_POST["score"]);
        echo "success";
    }

    /**
     * Retirer une publication Ajax
     */
    public function retirerPublication () {
        Publication::effacer($_POST["id"]);
    }

    /**
     * Supprimer une publication
     */
    public function supprimerPub() {
        $param = $this->request->getParam();
        Publication::supprimer($_POST["idPublication"]);
        header("Location:".path."client/espace/".$param);
    }

    /**
     * Masquer un utilisateur pour le chat
     */
    public function masquer() {
        Utilisateur::masque ($_SESSION['courriel']);
        header ("Location: $_SERVER[HTTP_REFERER]" );
    }

    /**
     * Masquer un utilisateur pour le chat
     */
    public function demasquer() {
        Utilisateur::connecte ($_SESSION['courriel']);
        header ("Location: $_SERVER[HTTP_REFERER]" );
    }

    /**
     * Liste des utilisateurs connectes pour le chat
     */
    public function liste_connecte(){
        $liste_connecte['moi'] = $_SESSION["courriel"];
        $liste_connecte['connectes'] = Utilisateur::all_connecte($_SESSION["courriel"]);
        echo json_encode($liste_connecte);

    }

    /**
     * Systeme de chat
     */
    public function chat(){
        Utilisateur::chat($_SESSION['courriel'], $_POST['destinataire'],$_POST['chat']);
        $chat_messages['chat'] = Utilisateur::chat_messages($_SESSION['courriel'], $_POST['destinataire']);
        echo json_encode($chat_messages);
    }

    /**
     * Messages Chat
     */
    public function chat_messages(){
        $chat_messages[] = Utilisateur::chat_messages($_SESSION['courriel'], $_POST['destinataire']);
        echo json_encode($chat_messages);
    }
}