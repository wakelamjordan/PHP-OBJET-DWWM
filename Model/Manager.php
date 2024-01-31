<?php
require_once("config/parametre.php");
class Manager {
    function findAllByConditionTable($table,$dataCondition=[],$order='',$type='obj'){  //  $order assure le classement du resultats
        $connexion=$this->connexion();  // recuoeration de la connexion à la bdd
        $condition=''; // On initialise la variable $condition à vide
        $values=[]; // la variable $values va etre injectée dans la methode execute 
        foreach($dataCondition as $key=>$value){ // A chaque element du tableau $dataCondition on le recupere dans la variable $valus Et $key correspond à l'indice de l'element
            if(!$condition){  // Le '!' dit que $contion est vide  On aurait pu ecrire if($condition=='')
                $condition.=" $key=? ";
            }else{
                $condition.=" and $key=? ";
            }
            // $condition.=(!$condition)?" $key=? " : " and $key= ? ";  
            // Syntaxe et ternaire =   (condition à verifier)? "expression correspondante à la condition si vrai" : " exepression correspondante à la condition si fausse"
            $values[]=$value; // Pousser dans la variable tableau $values le conntenu de la variable $value
        }
        $condition=(!$condition)?"true" : $condition; 
        $sql="select * from $table where $condition $order";
        // echo $sql;
        // printr($values);die;
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
        $resultats=$requete->fetchAll(PDO::FETCH_ASSOC);
        if($type=='obj'){
            $class=ucfirst($table);  //  Transformer le nom de la table à la variable $table en majuscule la première lettre. Exemple: avec 'article' on a  'Article'
            $objs=[]; // une variable qui va recevoir toutes les lignes de la variables $resultats
            foreach($resultats as $value){
                $obj=new $class($value);  // instanciation de la classe $clas sur le tableau $value
                $objs[]=$obj; //   Pousser $obj dans $objs
            }
            return $objs;
        }else{
            return $resultats;
        }

    }
    // La fonction findOneByConditionTable nous permet faire une recherche suivant le contenu de $dataCondition avec l'operateur 'and'
    function findOneByConditionTable($table,$dataCondition=[],$type='obj'){
        $connexion=$this->connexion();  // recuoeration de la connexion à la bdd
        $condition=''; // On initialise la variable $condition à vide
        $values=[]; // la variable $values va etre injectée dans la methode execute 
        foreach($dataCondition as $key=>$value){ // A chaque element du tableau $dataCondition on le recupere dans la variable $valus Et $key correspond à l'indice de l'element
            if(!$condition){  // Le '!' dit que $contion est vide  On aurait pu ecrire if($condition=='')
                $condition.=" $key=? ";
            }else{
                $condition.=" and $key=? ";
            }

            // $condition.=(!$condition)?" $key=? " : " and $key= ? ";  
            // Syntaxe et ternaire =   (condition à verifier)? "expression correspondante à la condition si vrai" : " exepression correspondante à la condition si fausse"
            $values[]=$value; // Pousser dans la variable tableau $values le conntenu de la variable $value
        }
        $condition=(!$condition)?"true" : $condition; 
        $sql="select * from $table where $condition";
        // echo $sql;
        // printr($values);die;
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
        $resultat=$requete->fetch();
        if($type=='obj'){
            $class=ucfirst($table);
            $obj=new  $class($resultat);
            return $obj;
        }else{
            return $resultat;
        }

    }
    function searchTable($table,$columnLikes,$mot){
        $connexion=$this->connexion();
        $condition="";
        $values=[];
        foreach($columnLikes as $value){
            $condition.=($condition=="")?   "$value like ? "  :  " or $value like ? ";
            $values[]="%$mot%";
        }
        $sql="select * from $table where $condition";
        //---------test------------
        // echo $sql;
        // MyFct::sprintr($values);die;
        //--------------
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
        $resultat=$requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;

    }
    function updateTable($table,$data,$id){
        $connexion=$this->connexion();
        $setColumn="";
        $values=[];
        foreach($data as $key=>$value){
            if($key!='id'){
                $setColumn.= ($setColumn=="") ?  "$key=?"  :  ",$key=?";  // if ternaire 
                /*--
                    if($setColumn==""){
                        $setColumn.="$key=?";
                    }else{
                        $setColumn.=",$key=?";
                    }
                */
                $values[]=$value;
            }
     
        }
        $sql="update $table set $setColumn where id=?";
        $values[]=$id;
        //----test----
        // echo "<h1>$sql </h1>";
        // MyFct::sprintr($values);
        // die;
        //------
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
    }
    function insertTable($table,$data){
        //---initialisation des variables
        $connexion=$this->connexion();
        $column="";
        $pi=""; //   les points d'interrogation
        $values=[];  // tableau pour la method execute
        //-----generation de la requete sql
        foreach($data as $key=>$value){
            if($key!='id'){
                if($column==""){
                    $column.=$key;
                    $pi.="?";
                }else{
                    $column.=",$key";
                    $pi.=",?";
                }
                $values[]=$value;
            }
        }
        $sql="insert into $table ($column) values ($pi) ";
        //---test----
        // echo $sql;
        // MyFct::sprintr($values);die;
        //----
        $requete=$connexion->prepare($sql);
        $requete->execute($values);
    }
    function getDescribeTable( $table ) {
        $connexion = $this->connexion();
        $sql = "desc $table";
        // requete pour affichage de la structure la table collaborateur
        $requete = $connexion->prepare( $sql );
        $requete->execute();
        $colonnes = $requete->fetchAll( PDO::FETCH_COLUMN );
        // recuperation de tous les noms de colonne de la table collaborateur
        /* sans avoir une bonne methode on devait initialiser la variavle tableau en :
        $variables = [
            'id'=>'',
            'civilite'=>'',
            'nom'=>'',
        ];
        */
        $variables = [];
        foreach ( $colonnes as $valeur ) {
            $variables[ $valeur ] = '';
        }

        return $variables;

    }

    function connexion( $host = HOST, $dbname = DBNAME, $user = USER, $password = PASSWORD ) {
        $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";
        try {
            $connexion = new PDO( $dns, $user, $password );
        } catch( Exception $e ) {
            echo '<h1> Connexion impossible ! Verifiez les paramètres !</h1>';
            die;
        }
        return $connexion;
    }
    // function $this->connexion() {
    //     $dns = 'mysql:host=localhost;dbname=dwwm;charset=utf8';
    //     try {
    //         $connexion = new PDO( $dns, 'admin', '4321' );
    //     } catch( Exception $e ) {
    //         echo '<h1> Connexion impossible ! Verifiez les paramètres !</h1>';
    //         die;
    //     }
    //     return $connexion;
    // }

    function findByIdTable( $nomTable, $id ) {
        $connexion = $this->connexion();
        // valeur retouner par la fontion $this->connexion() du fichier myFct.
        $sql = "select * from $nomTable where id=?";
        // Ecrire la requete sql correspondante
        $requete = $connexion->prepare( $sql );
        //  Dire à php de oreparer la requete sql
        $requete->execute( [ $id ] );
        // Executer la requete avec id = $id
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        // Mettre dans $article l'article trouvé
        return $resultat;
    }

    function deleteByIdTable( $nomTable, $id ) {
        $connexion = $this->connexion();
        $sql = "delete from $nomTable where id=?";
        $requete = $connexion->prepare( $sql );
        $requete->execute( [ $id ] );
        return true;

    }

    function listTable( $nomTable, $order='' ) {
        $sql = "select * from $nomTable $order ";
        $connexion = $this->connexion();
        $requete = $connexion->prepare( $sql );
        $requete->execute();
        $tables = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $tables;
    }

}