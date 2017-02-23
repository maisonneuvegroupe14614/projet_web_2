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
        Utilisateur::enregistrer($_POST['courriel'],$_POST['mpasse'],$_POST['nom'],
            $_POST['prenom'],$_POST["statut"],$_POST['ville'],$_POST['province'],$_POST['pays']);

        $_SESSION["courriel"]=$_POST['courriel'];

        header("Location:espace/".$_SESSION['courriel']);
    }

    public function espace () {
        $publication = Publication::find($_SESSION["courriel"]);
        $param = $this->request->getParam();
        $this->view->load('espace/index',$publication, $param);
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
}