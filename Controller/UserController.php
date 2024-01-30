<?php
    class UserController extends MyFct{
        function __construct(){
            
            $action='list';
            extract($_GET);
            switch($action){
                case 'list':
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!"); 
                    $this->listerUser();
                    break;
                case 'insert':
                    $this->insererUser();
                    break;
                case 'update':
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!"); 
                    $this->modifierUser($id);
                    break;
                case 'show':
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!"); 
                    $this->afficherUser($id);
                    break;
                case 'delete':
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!"); 
                    $this->supprimerUser($id);
                    break;
                case 'save' :
                    // $this->printr($_POST);
                    // $this->printr($_FILES);die;         
                    //if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!"); 
                    
                    $this->sauvegarderUser($_POST,$_FILES);
                    break;
                case 'search':
                    $this->chercherUser($mot);
                    break;
                case 'login':
                    if($_POST){  // if($_POST!=[])  ou if(!empty($_POST))
                        $this->valider($_POST);
                    }
                    $this->seConnecter();
                    break;
                case 'logout':
                    $this->seDeconnecter();
                    break;
            }
        }
        /*------------------Les Methods------------------------*/
        function listerUser(){
            //-----------protection
            // if(this->notGranted('ROLE_ADMIN')){
            //     $this->throwMessage("Von'avez pas <br> le droit d'utiliser cette action!");
            // }
            // if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!"); 
            // On a ici un if sans accolade car on n'a qu'une seule  ligne d'instruction


            /*-------------Préparation des variables à envoyer à la page--- */
            $um=new UserManager();
            $users=$um->findAll();
            $lignes=[];
            foreach($users as $value){
                //$dateCreation=$value['dateCreation']
                $user=new User($value);
                $dateCreation=$user->getDateCreation();
                $dateCreation=new DateTime($dateCreation);
                $dateCreation=$dateCreation->format('d/m/Y');
                //-----Afficher roles en menu deroulant----
                $roles=json_decode($user->getRoles());  ///   tansformer un json en tableau php.  Et json_encode c'est la taransfomation d'un tableai php en json
                $role_title=implode(" - ",$roles); // transformer le tableau $roles en texte avec un separateur " - "
                $user_roles="<select class='form-select bg_green'     title='$role_title'  > ";
                foreach($roles as $role){
                    $user_roles.="<option>$role</option>";
                }
                $user_roles.="</select>";
                $photo=$user->getPhoto();  // recuperation de photo dans user
                $photo=(!$photo)? 'photo.jpg': $photo;  // si $photo est vide alors prendre comme valeur 'photo.jpg' sinon garder $photo
                //----
                $lignes[]=[
                    'id'=>$user->getId(),
                    'username'=>$user->getUsername(),
                    'dateCreation'=>$dateCreation,
                    'roles'=>$user_roles,
                    'photo'=>$photo,
                ];
            }
            $variables=[
                'lignes'=>$lignes,
                'nbre'=>count($lignes),
            ];
            //------------Evoi page-------------*/
            $file="View/user/listUser.html.php";
            $this->generatePage($file,$variables);

        }        
        function sauvegarderUser($data,$files=[]){
            // $this->printr($files);die;
            if($files['photo']['name']){  // verifier si $files['photo']['name'] n'est pas vide
                // echo 'on est ici'; die;
                $file_photo=$files['photo'];  // $_FILES['photo']
                $name=$file_photo['name'];  //  recuperer le nom du fichier uploadé avec son extension
                $source=$file_photo['tmp_name'];  // recuperer le chemin temporaire de l'emplacement du fichier uploadé
                $destination="Public/upload/$name";  // le chemin  où on va stocker le fichier
                move_uploaded_file($source,$destination);  // deplacer le ficher temporaire vers la destination
                $data['photo']=$name;
            }else{
                unset($data['name']); // supprimer l'element à l'indice 'name' dans $data           }
             }
             $um=new UserManager();
             $connexion=$um->connexion();
             $data['roles']=json_encode($data['roles']); // tranformer le condetune de $data['roles'] en json
             $password=$data['password'];
             if($password){  //  tester si $password n'est ni vide ni null ni egal à 0
                 $password=$this->crypter($password);
                 $data['password']=$password;
             }else{  // $password est vide ou  null ou égal à 0
                 unset($data['password']);  // enlever dans les elements à modifier password pour que mysql ne modifie pas à vide le contenu de password
             }
            // $this->printr($data);die;
             extract($data);
             $id=(int) $id;  // transformation de $id en entier
             if($id!=0){  // cas d'une modification
                 // $sql="update user set numUser=?,nomUser=?,adresseUser=? where id=?";
                 // $requete=$connexion->prepare($sql);
                 // $requete->execute([$numUser,$nomUser,$adresseUser,$id]);
                 $um->update($data,$id);
             }else{  //  cas d'une insertion 
                 // $sql="insert into user (numUser,nomUser,adresseUser) values (?,?,?) ";
                 // $requete=$connexion->prepare($sql);
                 // $requete->execute([$numUser,$nomUser,$adresseUser]);
                 $um->insert($data);
             }
             //  Redurection vers la page list user
             header("location:user");
         }
        function seDeconnecter(){
            session_destroy();
            header('location:accueil');
            exit;
        }
        function valider($data){
            $um=new UserManager();
            extract($data);
            // $connexion=$um->connexion();
            // $sql="select * from user where (username=? or email=?)  and password=?";
            // $requete=$connexion->prepare($sql);
            // $requete->execute([$username,$username,$this->crypter($password)]);  // le premier $username est pour username=? et le 2ème pour email=?
            // $user =$requete->fetch(PDO::FETCH_ASSOC);
            $dataCondition=['username'=>$username,'password'=>$this->crypter($password)];
            // $user=$um->findOneByCondition($dataCondition,'array');
            $user=$um->findOneByCondition($dataCondition);
            if(!$user->getUsername()){  // La recherche sur username s'est averée fausse alors on tente la recherche sur email
                $dataCondition=['email'=>$username,'password'=>$this->crypter($password)];
                $user=$um->findOneByCondition($dataCondition);                
            }
            //printr($user);die;
            if($user->getUsername()){
                $_SESSION['username']=$user->getUsername(); //$user['username'];
                $_SESSION['roles']=$user->getRoles(); //$user['roles'];
                $_SESSION['bg_navbar']="bg_green";
                //---Redirection vers l'accueil
                header('location:accueil');
                exit();
            }else{
                $message="<div class='center'>";
                $message.= "<p>Identifant et ou mot de passe incorrect <p>";
                $message.="<img src='Public/img/giphy.gif' class='img-fluid radius_50' width='25%' >";
                $message.="</div>";

                $variables=[
                    'message'=>$message,
                ];
                $file="View/erreur/erreur.html.php";
                $this->generatePage($file,$variables);
            }
        }
        function seConnecter(){
            $file="View/user/formLogin.html.php";
            $this->generatePage($file);

        }
        function chercherUser($mot){
            $um=new UserManager();
            $columnLikes=['username'];
            $users=$um->search($columnLikes,$mot);
            $variables=[
                'lignes'=>$users,
                'nbre'=>count($users),
            ];
            $file="View/user/listUser.html.php";
            $this->generatePage($file,$variables);        
        }        
        function supprimerUser($id){
            $um=new UserManager();
            $um->deleteById($id);
            header("location:user");
            exit();
        }
        function insererUser(){
            //-----User---
            $user=new User();  // Créer un user à vide
            $user->setRoles(['ROLE_USER']);  //  Au moins un user à créer doit avoir 'ROLE_USER' 
            //$user_roles=$user->getRoles(); // Recupartion de roles (json) dans user
            $disabled="";
            /*------Creation de la page FormUser-----*/
            $this->generateFormUser($user,$disabled);
        }        
        function afficherUser($id){
            $um=new UserManager();  //  Instancier la clasee UserManager
            $user=$um->findById($id);  // Recuperer user corespondant à l'id $id. D'après UserManager on a ici un objet
            $user_roles=$user->getRoles(); // Recupartion de roles (json) dans user
            $user_roles=json_decode($user_roles); //  transformation de $user_roles qui est encore JSON en tableau php
            $user->setRoles($user_roles);   // mettre à jour le roles dans l'objet user en tableau php
            $disabled="disabled";
            //----Role----------------
            $this->generateFormUser($user,$disabled);
        }   
        function modifierUser($id){
            //-----User---
            $um=new UserManager();  //  Instancier la clasee UserManager
            $user=$um->findById($id);  // Recuperer user corespondant à l'id $id. D'après UserManager on a ici un objet
            $user_roles=$user->getRoles(); // Recupartion de roles (json) dans user
            $user_roles=json_decode($user_roles); //  transformation de $user_roles qui est encore JSON en tableau php
            $user->setRoles($user_roles);   // mettre à jour le roles dans l'objet user en tableau php
            $disabled="";
            $this->generateFormUser($user,$disabled);
        }  
        function generateFormUser($user,$disabled){
            $photo=$user->getPhoto();
            if(!$photo){
                $photo="photo.jpg";  //  l'iage photo.jpg doit etre créer
            }
            
            $user_roles=$user->getRoles();
            //MyFct::printr($user_roles);die;
            $rm=new RoleManager();
            $myRoles=$rm->findAll();  // recuperer la totalité de la table role.
            $roles=[]; // variale $roles à envoyer vers la page form.html.php
            foreach($myRoles as $role){
                //$this->printr($role);die;
                $libelle=$role['libelle'];
                if(in_array($libelle,$user_roles)){  // si $libelle fait parti de la tables $user_roles
                    $selected="selected";
                    $checked="checked";
                }else{
                    $selected="";
                    $checked="";
                }
                $roles[]=['libelle'=>$libelle,'selected'=>$selected,'checked'=>$checked];
            }
            //---------prearation variables---

            $variables=[
                'id'=>$user->getId(),
                'username'=>$user->getUsername(),
                'password'=>'',
                'email'=>$user->getEmail(),
                'roles'=>$roles,
                'disabled'=>$disabled,
                'photo' =>$photo,
            ];
            //printr($variables);die;
            //----Ouverture de la page
            $file="View/user/formUser.html.php";
            $this->generatePage($file,$variables);

        }                







    }