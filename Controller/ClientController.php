<?php
class ClientController extends MyFct{
    function __construct(){
        $action='list';
        extract($_GET);
        switch($action){
            case 'search':
                $this->chercherClient($mot);
                break;
            case 'list':
                $this->listerClient();
                break;
            
            case 'show':
                //$id=$_GET['id'];
                //test de lencement client&action=show&id=2
                $this->afficherClient($id);
                break;
            case 'insert':
                $this->insererClient();
                break;
            case 'update':
                $this->modifierClient($id);
                break;  
            case 'save' :
                $this->sauvegarderClient($_POST);
                break;
            case 'delete' :
                $this->supprimerClient($id);
                break;              
        }

    }
    //------------------Mes differentes fonctions ou method---------
    function chercherClient($mot){
        $cm=new ClientManager();
        $columnLikes=['numClient','nomClient','adresseClient'];
        $clients=$cm->search($columnLikes,$mot);
        $variables=[
            'lignes'=>$clients,
            'nbre'=>count($clients),
        ];
        $file="View/client/list.html.php";
        $myFct=new MyFct();
        $myFct->generatePage($file,$variables);        

    }
    function supprimerClient($id){
        $cm=new ClientManager();
        $cm->deleteById($id);
        header("location:client");
        exit();
    }
    function insererClient(){
        $variables=[
            'id'=>'',
            'numClient'=>'',
            'nomClient'=>'',
            'adresseClient'=>'',
            'disabled'=>'',
        ];
        //----Ouverture de la page
        $file="View/client/form.html.php";
        $this->generatePage($file,$variables);        
    }
    function sauvegarderClient($data){
        $cm=new ClientManager();
        $connexion=$cm->connexion();
        extract($data);
        $id=(int) $id;  // transformation de $id en entier
        if($id!=0){  // cas d'une modification
            // $sql="update client set numClient=?,nomClient=?,adresseClient=? where id=?";
            // $requete=$connexion->prepare($sql);
            // $requete->execute([$numClient,$nomClient,$adresseClient,$id]);
            $cm->update($data,$id);
        }else{  //  cas d'une insertion 
            // $sql="insert into client (numClient,nomClient,adresseClient) values (?,?,?) ";
            // $requete=$connexion->prepare($sql);
            // $requete->execute([$numClient,$nomClient,$adresseClient]);
            $cm->insert($data);
        }
        //  Redurection vers la page list client
        header("location:client");
    }
    function modifierClient($id){
        $cm=new ClientManager();
        $client=$cm->findById($id);
        //---------prearation variables---
        $variables=[
            'id'=>$client->getId(),
            'numClient'=>$client->getNumClient(),
            'nomClient'=>$client->getNomClient(),
            'adresseClient'=>$client->getAdresseClient(),
            'disabled'=>'',

        ];
        //----Ouverture de la page
        $file="View/client/form.html.php";
        $this->generatePage($file,$variables);
    }
    function afficherClient($id){
        $cm=new ClientManager();
        $client=$cm->findById($id);
        //-----preparation des varisles à envoyer ver la page html
        $variables=[
            'id'=>$client->getId(),
            'numClient'=>$client->getNumClient(),
            'nomClient'=>$client->getNomClient(),
            'adresseClient'=>$client->getAdresseClient(),
            'disabled'=>'disabled',
        ];
        //$this->printr($variables);die;
        //----------Preparation à l'ouverture de la page------
        $file="View/client/form.html.php";
        $this->generatePage($file,$variables);

    }
    function listerClient(){
        $cm=new ClientManager();
        $clients=$cm->findAll();
        $variables=[
            'lignes'=>$clients,
            'nbre'=>count($clients),
        ];
        $file="View/client/list.html.php";
        $myFct=new MyFct();
        $myFct->generatePage($file,$variables);
    }


}