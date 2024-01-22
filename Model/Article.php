<?php

class Article extends ArticleManager{

    private $id;
    private $numArticle;
    private $designation;
    private $prixUnitaire;

    /*----------------------les method ----------------------*/

    public function __construct( $data = [] ) {
        // La methode __construct s'execute automatiquement à l'instanciation de l'objet
       if($data){
           foreach($data as $key=>$valeur){
               // creation de fonction set
               $set="set".ucfirst($key);
               // cas où  $key='numArticle'  alors $set="setNumArticle"
               if(method_exists($this,$set)){
                   $this->$set($valeur);
               }

           }
       }




        //    if($data){  // if($data!=[])
        //        $this->setId($data['id']);
        //         $this->setNumArticle($data['numArticle']);
        //         $this->setDesignation($data['designation']);
        //         $this->setPrixUnitaire($data['prixUnitaire']);
        //    }

        // $this->setId(1);
        // $this->setNumArticle('BB0012');
        // $this->setDesignation('Biere Listel Gris 75cl' );
        // $this->setPrixUnitaire( 8.10 );
    }

    public function getId() {
        //   recuperation du contenu de la propriété  $id
        return $this->id;
        //   $this   remplace le nom de la class en cours
    }

    public function setId( $my_id ) {
        //   assigner une valeur sur la propriété $id

        $this->id = $my_id;
    }

    /**
    * Get the value of numArticle
    */

    public function getNumArticle()
 {
        return $this->numArticle;
    }

    /**
    * Set the value of numArticle
    *
    * @return  self
    */

    public function setNumArticle( $numArticle )
 {
        $this->numArticle = $numArticle;

        return $this;
    }

    /**
    * Get the value of designation
    */

    public function getDesignation()
 {
        return $this->designation;
    }

    /**
    * Set the value of designation
    *
    * @return  self
    */

    public function setDesignation( $designation )
 {
        $this->designation = $designation;

        return $this;
    }

    /**
    * Get the value of prixUnitaire
    */

    public function getPrixUnitaire()
 {
        return $this->prixUnitaire;
    }

    /**
    * Set the value of prixUnitaire
    *
    * @return  self
    */

    public function setPrixUnitaire( $prixUnitaire )
 {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }
}