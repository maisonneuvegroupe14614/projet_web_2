<?php

session_start();

class ClientController extends Controller {
    public function __construct($view,$request) {
        parent::__construct($view,$request);
    }

    public function identification () {
        if(isset($_SESSION["courriel"])) {
            header("Location:espace/".$_SESSION['courriel']);
        } else {
            $this->view->load('login/index');
        }

    }

    public function logout () {
        session_destroy();
        header("Location:identification");
    }

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

    public function inscription () {
        if(isset($_SESSION["courriel"])) {
            header("Location:espace/".$_SESSION['courriel']);
        } else {
            $this->view->load('inscription/index');
        }

    }

    public function confirmationInscription () {
        /*construction de la table des erreurs*/
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

    public function desinscription () {
        $this->view->load('desinscription/index',$_SESSION["courriel"]);
    }

    public function confirmationDesinscription () {
        echo '<h1>'.$_SESSION["courriel"].'</h1>';
        Utilisateur::desinscription($_SESSION["courriel"]);
        session_destroy();
        header("Location:identification");
    }

    public function espace () {
        $data["publication"] = Publication::find($_SESSION["courriel"]);
        $data["utilisateur"] = Utilisateur::listeAmis($_SESSION['courriel']);
        $param = $this->request->getParam();
        $this->view->load('espace/index',$data, $param);
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
        Publication::Enregistrer($_POST["publications"],$_POST["url"],$this->request->getParam());
        header("Location:../espace/".$this->request->getParam());
    }

    public function ajouterPublicationAmi () {
        Publication::Enregistrer($_POST["publications"],$_POST["url"],$this->request->getParam());
        header("Location:../ami/".$this->request->getParam());
    }

    public function ajouterQuiz () {
        $this->view->load('quiz/index');
    }

    public function addQuiz () {
        Publication::Enregistrer($_POST["nomQuiz"],"dasdasdsafdfdg","michael@hotmail.com");
        $denierId = Publication::dernier();
        foreach ($_POST["questionnaire"] as $data) {
            if($data["question"]==$data["reponses"]["noQuestion"]) {
                Question::enregistrer($denierId,$data["question"],$data["valeur"],$data["reponses"]["reponse"]);
            } else {
                Question::enregistrer($denierId,$data["question"],$data["valeur"],0);
            }

        }

        echo "success";
    }
}