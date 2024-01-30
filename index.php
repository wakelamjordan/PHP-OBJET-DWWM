<?php
    session_start();
    if(!$_SESSION){   //    la variable $_SESSION est encore vide ====  $_SESSION=[];
        $_SESSION['username']='user';
        $_SESSION['roles']=json_encode(['ROLE_USER']);
        $_SESSION['bg_navbar']='bg_red';
    }
    require_once("Service/extra.php");
    spl_autoload_register('charger');  //  spl_autoload_register charge automatiquement la fonction indiqué en parametre. 
    $path='accueil';  // initialisation de la variable $path 
    extract($_GET);   // generation de variables via les indices de $_GET. Exemple $path, $action, $id , ...
    $nameController=ucfirst($path)."Controller";  // generation de nom de controller via $path.
                                                 //  Par exemple si $path="article" alors $nameController="ArticleController"
    $fileController="Controller/$nameController.php";  // generation du chemin où se troune le fichier correspondant 
                                             // au controller designé par $nameController. Par exemple "Controllet/ArticleController.php"
    if(file_exists($fileController)){  // On teste l'existance du fichier representé par $fileController
        $x=new $nameController();  // cas où le fichier existe
    }else{
        $myFct=new MyFct;
        $file="View/erreur/erreur.html.php";
        $message="Le fichier $fileController n'existe pas!";
        $variables=['message'=>$message];
        $myFct->generatePage($file,$variables);
        // echo "<h1>Le fichier $fileController n'existe pas!</h1>";die;
    }

    