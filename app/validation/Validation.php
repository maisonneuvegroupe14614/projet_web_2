<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author e1695292
 */
class Validation {
    //put your code here

    private $REGEX_ERROR ;
   
    /*
        Un mot de passe valide aura
        - de 8 à 15 caractères
        - au moins une lettre minuscule
        - au moins une lettre majuscule
        - au moins un chiffre
        - au moins un de ces caractères spéciaux: $ @ % * + - _ !
        - aucun autre caractère possible: pas de & ni de { par exemple)          
         */
    public function getREGEX_ERROR() {
        return $this->REGEX_ERROR;
    }
    /*initialisation et centralisation de la table regex=>error*/
    public function setREGEX_ERROR() {
        $this->REGEX_ERROR  =array(
            "nom" => array(
            "regex" => "/^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ[:blank:]-]{1,30})$/",
            "error" => "que des alphabet"
                     ),
            "passe" => array(
            "regex" => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/",
            "error" => "respecter le format du mot de passe"
                     ),
             "email" => array(
            
            "error" => "faut email"
                     )               
            );;
    }

        
            public function getInput() {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setInput($data){ 
        $this->data = $data;
        $this->data  = trim($this->data);
        $this->data  = stripslashes($this->data);
        $this->data  = htmlspecialchars($this->data);
        
        return $this;
    }

    /**
     * Validation constructor.
     */
    public function __construct() {
        $this->setREGEX_ERROR();
        
    }

    /**
     * @param $alpha
     * @return mixed
     */
    public function validate_alpha($alpha) {
        $this->setInput($alpha);
        if (!preg_match($this->REGEX_ERROR['nom']['regex'],$this->data)) {
            return $this->REGEX_ERROR['nom']['error'];
        }
        
        }

    /**
     * @param $password
     * @return mixed
     */
    public function validate_password($password) {
    $this->setInput($password);
    if (!preg_match($this->REGEX_ERROR['passe']['regex'],$this->data)) {
        return $this->REGEX_ERROR['passe']['error'];
        echo $this->REGEX_ERROR['passe']['regex'];
    }

    }

    /**
     * @param $email
     * @return mixed
     */
    public function validate_email($email) {
    $this->setInput($email);
    if (!filter_var($this->data, FILTER_VALIDATE_EMAIL)) {
        return $this->REGEX_ERROR['email']['error'];     
    }

    }
        
    

}
