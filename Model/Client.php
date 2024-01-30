<?php
class Client{
    private $id;
    private $numClient;
    private $nomClient;
    private $adresseClient;



    public function __construct( $data = [] ) {
       if($data){
           foreach($data as $key=>$valeur){
               $set="set".ucfirst($key);
               if(method_exists($this,$set)){
                   $this->$set($valeur);
               }

           }
       }
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of numClient
     */ 
    public function getNumClient()
    {
        return $this->numClient;
    }

    /**
     * Set the value of numClient
     *
     * @return  self
     */ 
    public function setNumClient($numClient)
    {
        $this->numClient = $numClient;

        return $this;
    }

    /**
     * Get the value of nomClient
     */ 
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * Set the value of nomClient
     *
     * @return  self
     */ 
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    /**
     * Get the value of adresseClient
     */ 
    public function getAdresseClient()
    {
        return $this->adresseClient;
    }

    /**
     * Set the value of adresseClient
     *
     * @return  self
     */ 
    public function setAdresseClient($adresseClient)
    {
        $this->adresseClient = $adresseClient;

        return $this;
    }
}