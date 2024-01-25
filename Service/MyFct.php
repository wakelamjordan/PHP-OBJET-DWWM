<?php
 
class MyFct{
    function notGranted($role_libelle){
        $granted=self::isGranted($role_libelle);  // comme isGranted est static alors on utilise self:: au lieu de $this->
        if($granted){
            return false;
        }else{
            return true;
        }
    }
    function throwMessage($message){
        $variables=['message'=>$message];
        $file="View/erreur/erreur.html.php";
        $this->generatePage($file,$variables);
    }
    function crypter($password,$iteration=127){  // on a mis par defaut $iteration à 127
        for($i=0;$i<=$iteration;$i++){  // boucle qui commence par $i=0 et se termine à $i=$iteration avec une incrementation de 1 ($i++)
            $password=sha1($password);   // On applique le sha1 sur $password à chaque iteration
        }
        return $password;
    }
    static function isGranted($role_libelle){
        $user_roles=$_SESSION['roles']; //   en format json
        $user_roles=json_decode($user_roles);  // transformation en tableau php
        if(in_array($role_libelle,$user_roles)){  // tester si $role_libelle fait parti des roles de l'utilisateur en cours
            return true;
        }else{
            return false;
        }
    }
    
    function generatePage($file,$variables=[],$base="View/base-bs.html.php"){  // generation d'une page
        // $file  : fichier html
        //$variables  : une variable en tableau qui contnient comme indices les noms des variables utilisées par $file
        //Exemple ['x'=>2,'y'=>5,'z'=>10]   . avec extract($variables) , on a $x=2;  $y=5 et $z=10
        if(file_exists($file)){   // if faut verifier si le $file existe ou non
            //cas de $file existe
            extract($variables);
            ob_start();   // Ouvrir   la memoire tampon pour contenir lfichier $file à transformer en texte
            require($file);
            $content=ob_get_clean();
            //------------
            //---Ouvrir à nouveau la memoire tampon pour recevoir le fichier $base avec la variable $content
    
            ob_start();
            require($base);
            $page=ob_get_clean();
            echo $page;
    
        }else{
    
            // cas où le fichier $file n'existe pas
            echo "<h1>Desolé! Le fichier $file n'existe pas!</h1>"; 
            die;
        }
    
    }
    
    function printr($tableau){
        echo "<pre>";
        print_r($tableau);
        echo "</pre>";
    
    }
    static function sprintr($tableau){
        echo "<pre>";
        print_r($tableau);
        echo "</pre>";
    
    }





}

