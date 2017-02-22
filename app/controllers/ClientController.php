<?php

session_start();

class ClientController extends Controller {
    public function __construct($view) {
        parent::__construct($view);
    }

    public function identification () {
        $this->view->load('login/index');
    }

    public function verifierIdentification () {
        $password = $_POST["password"];
        $user = Utilisateur::find($_POST["user"]);
        if(!empty($user) && password_verify($password,$user->motPasse)) {
            $_SESSION["courriel"]=$user->courriel;
            header("Location:espace");
        } else {
            echo "Vous n'etes pas identifier correctement!";
        }
    }

    public function inscription () {
        $this->view->load('inscription/index');
    }

    public function confirmationInscription () {
        Utilisateur::enregistrer($_POST['courriel'],$_POST['mpasse'],$_POST['nom'],
            $_POST['prenom'],$_POST["statut"],$_POST['ville'],$_POST['province'],$_POST['pays']);
    }

    public function espace () {
        $this->view->load('espace/index',$_SESSION["courriel"]);
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
        $pub = Publication::find("michael@hotmail.com");
        print_r($pub);
    }

    public function testAllEvaluations () {
        $evaluation = Evaluation::all();
        print_r($evaluation);
    }

    public function testFindEvaluation () {
        $evaluation = Evaluation::find("michael@hotmail.com");
        print_r($evaluation);
    }
}