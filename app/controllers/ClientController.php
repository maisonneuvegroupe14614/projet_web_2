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
            header("Location:espace/".$_SESSION['courriel']);
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
            header("Location:espace/".$_SESSION['courriel']);
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

                header("Location:espace/".$_SESSION['courriel']);
            } else {
                header("Location:inscription");
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
        $this->view->load('desinscription/index',$_SESSION["courriel"]);
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
        header("Location:identification");
    }

    /**
     * Espace
     *
     * Affiche l'espace de l'utilisateur
     *
     * @return mixed
     */
    public function espace () {
        $data["publication"] = Publication::find($_SESSION["courriel"]);
        $data["utilisateur"] = Utilisateur::listeAmis($_SESSION['courriel']);
        $param = $this->request->getParam();
        return $this->view->load('espace/index',$data, $param);
    }

    public function getNotificationPub () {
        $notification["messageAll"] = NotificationPub::all($_SESSION["courriel"],"message");
        $notification["message"] = NotificationPub::allNotSeen($_SESSION["courriel"],"message");
        $notification["tutorat"] = NotificationPub::allNotSeen($_SESSION["courriel"],"tutorat");
        $notification["astuce"] = NotificationPub::allNotSeen($_SESSION["courriel"],"astuce");
        $notification["quiz"] = NotificationPub::allNotSeen($_SESSION["courriel"],"quiz");
        echo json_encode($notification);

    }

    public function ami () {
        $data["publication"] = Publication::find($this->request->getParam());
        $data["utilisateur"] = Utilisateur::listeAmis($this->request->getParam());
        $param = $this->request->getParam();
        $this->view->load('ami/index',$data, $param);
    }

    public function testAllUsers () {
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
    }

    public function ajouterPublication () {
        Publication::Enregistrer(1,"",$_POST["publications"],$_POST["url"],$this->request->getParam());
        header("Location:../espace/".$this->request->getParam());
    }

    public function ajouterPublicationAmi () {
        Publication::Enregistrer(1,"",$_POST["publications"],$_POST["url"],$this->request->getParam());
        NotificationPub::enregistrer("message",$this->request->getParam(),NotificationPub::last());
        header("Location:../ami/".$this->request->getParam());
    }

    public function afficherAjouterQuiz () {
        $this->view->load('quiz/afficherAjouter');
    }

    public function ajouterQuiz () {
        Publication::Enregistrer(3,$_POST["nomQuiz"],"","","michael@hotmail.com");
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

    public function afficherQuizUtilisateur () {
        $data["quiz"] = Publication::allQuiz();
        $this->view->load("quiz/afficherQuizUtilisateur",$data);
    }

    public function afficherQuizById () {
        $param = $this->request->getParam();
        $data["quiz"] = Publication::findQuiz($param);
        $data["question"] = Question::find($param);
        $data["choix"] = Question::allChoix($param);
        $this->view->load("quiz/afficherQuizById", $data);
//        echo "<pre>".print_r($data,true)."</pre>";
    }

    public function updateNotification () {
        NotificationPub::update($_POST["id"]);
        echo "success";
    }


}