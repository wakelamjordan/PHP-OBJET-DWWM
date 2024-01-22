<?php
class UserManager extends Manager{
    public function search($columnLikes,$mot){
        return $this->searchTable('user',$columnLikes,$mot);
    }
    public function update($data,$id){
        $this->updateTable('user',$data,$id);
    }
    public function insert($data){
        $this->insertTable('user',$data);
    }
    public function getDescribe(){
        $resultat=$this->getDescribeTable('user');
        return $resultat;
    }
    public function findById($id,$type="obj"){
        $resultat=$this->findByIdTable('user',$id);
        if($type=="obj"){
            $objet=new User($resultat);
            return $objet;
        }else{
            return $resultat;
        }
    }
    public function deleteById($id){
        $this->deleteByIdTable('user',$id);
    }
    public function findAll(){
        $resultat=$this->listTable('user');
        return $resultat;
    }
    public function statisticVente(){
        
    }

}