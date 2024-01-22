<?php
    class User extends UserManager{

        private $id;
        private $username;
        private $email;
        private $password;
        private $dateCreation;
        private $dateModification;
        private $dateDerniereConnexion;
        private $roles;
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
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of dateCreation
         */ 
        public function getDateCreation()
        {
                return $this->dateCreation;
        }

        /**
         * Set the value of dateCreation
         *
         * @return  self
         */ 
        public function setDateCreation($dateCreation)
        {
                $this->dateCreation = $dateCreation;

                return $this;
        }

        /**
         * Get the value of dateModification
         */ 
        public function getDateModification()
        {
                return $this->dateModification;
        }

        /**
         * Set the value of dateModification
         *
         * @return  self
         */ 
        public function setDateModification($dateModification)
        {
                $this->dateModification = $dateModification;

                return $this;
        }

        /**
         * Get the value of dateDerniereConnexion
         */ 
        public function getDateDerniereConnexion()
        {
                return $this->dateDerniereConnexion;
        }

        /**
         * Set the value of dateDerniereConnexion
         *
         * @return  self
         */ 
        public function setDateDerniereConnexion($dateDerniereConnexion)
        {
                $this->dateDerniereConnexion = $dateDerniereConnexion;

                return $this;
        }

        /**
         * Get the value of roles
         */ 
        public function getRoles()
        {
                return $this->roles;
        }

        /**
         * Set the value of roles
         *
         * @return  self
         */ 
        public function setRoles($roles)
        {
                $this->roles = $roles;

                return $this;
        }
}
