<?php

class ArticleController extends MyFct{
    public function __construct(){
        $action='list';
        extract($_GET);
        switch($action){

            case 'list':
                $am=new ArticleManager();
                $articles=$am->findAll();  // Recuperer toutes les données de la table artcile
                $file="View/article/list.html.php";
                /* $valiables=[
                    'articles'=>json_encode($articles),
                ];
                $this->generatePage($file,$variables);
                */
                $this->generatePage($file,['articles'=>json_encode($articles)]);
                break;

        }
    }
    //------------Mes method ------------------------


}