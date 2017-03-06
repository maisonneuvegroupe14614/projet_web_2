<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Class_menu
 *
 * @author e1695292
 */
class Menu {
    
        private $titre ;
        private $src ;
        private $with = 30 ;
        private $height = 30 ;
        private $href ;
        public function __construct($src, $with, $height, $href,$titre) {
            $this->setSrc($src);
            $this->setWith($with);
            $this->setHeight($height);
            $this->setHref($href);
            $this->setTitre($titre);
        }

        public function getSrc() {
            return $this->src;
        }
        public function getTitre() {
            return $this->titre;
        }

        public function getWith() {
            return $this->with;
        }

        public function getHeight() {
            return $this->height;
        }

        public function getHref() {
            return $this->href;
        }

        public function setSrc($src) {
            $this->src = path."templates/images/".$src;
            return $this;
        }
        public function setTitre($titre) {
            $this->titre = $titre;
            return $this;
        }

        public function setWith($with) {
            $this->with = $with;
            return $this;
        }

        public function setHeight($height) {
            $this->height = $height;
            return $this;
        }

        public function setHref($href) {
            $this->href = $href;
            return $this;
        }

        public function menu_gauche() {
            return "<li><img src='".$this->getSrc()."' width='".$this->getWith()."' height='".$this->getHeight()."'>&nbsp;</img><a href='".path.$this->getHref()."'>".$this->getTitre()."</a></li>";
        
              
        }        
                  //put your code here
}
