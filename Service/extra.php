<?php 
function charger($class){  // le parametre $class contient le nom de la class à instancier avec new
        $fileModel="Model/$class.php"; // Exemple si  $class="Arctile" alors $fileModel="Model/Article.php"
        $fileController="Controller/$class.php";
        $fileView="View/$class.php";
        $fileService="Service/$class.php";
        $files=[$fileModel,$fileController,$fileView,$fileService];
        foreach($files as $file){
            if(file_exists($file)){
                require_once($file);
            }
        }
    }



        function printr($array){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }