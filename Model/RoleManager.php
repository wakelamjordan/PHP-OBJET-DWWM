<?php
class RoleManager extends Manager{
    public function findAllByCondition($dataCondition=[],$order='',$type='obj'){
        return $this->findAllByConditionTable('role',$dataCondition,$order,$type);
    }
    public function findOneByCondition($dataCondition=[],$type='obj'){
        return $this->findOneByConditionTable('role',$dataCondition,$type);
    }
    public function search($columnLikes,$mot){
        return $this->searchTable('role',$columnLikes,$mot);
    }
    public function update($data,$id){
        $this->updateTable('role',$data,$id);
    }
    public function insert($data){
        $this->insertTable('role',$data);
    }
    public function getDescribe(){
        $resultat=$this->getDescribeTable('role');
        return $resultat;
    }
    public function findById($id,$type="obj"){
        $resultat=$this->findByIdTable('role',$id);
        if($type=="obj"){
            $objet=new Role($resultat);
            return $objet;
        }else{
            return $resultat;
        }
    }
    public function deleteById($id){
        $this->deleteByIdTable('role',$id);
    }
    public function findAll(){
        $resultat=$this->listTable('role');
        return $resultat;
    }
    public function statisticVente(){
        
    }

}