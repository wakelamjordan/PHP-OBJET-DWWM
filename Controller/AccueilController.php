<?php

class AccueilController{
    public function __construct(){
        $file="View/accueil/accueil.html.php";
        $myFct=new MyFct();
       $myFct->generatePage($file);

    }
    //-------------------------Mes Methodes------------




}