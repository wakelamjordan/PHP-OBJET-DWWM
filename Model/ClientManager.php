<?php
class ClientManager extends Manager{
    public function findAllByCondition($dataCondition=[],$order='',$type='obj'){
        return $this->findAllByConditionTable('client',$dataCondition,$order,$type);
    }
    public function findOneByCondition($dataCondition=[],$type='obj'){
        return $this->findOneByConditionTable('client',$dataCondition,$type);
    }
    public function search($columnLikes,$mot){
        return $this->searchTable('client',$columnLikes,$mot);
    }
    public function update($data,$id){
        $this->updateTable('client',$data,$id);
    }
    public function insert($data){
        $this->insertTable('client',$data);
    }
    public function getDescribe(){
        $resultat=$this->getDescribeTable('client');
        return $resultat;
    }
    public function findById($id,$type="obj"){
        $resultat=$this->findByIdTable('client',$id);
        if($type=="obj"){
            $objet=new Client($resultat);
            return $objet;
        }else{
            return $resultat;
        }
    }
    public function deleteById($id){
        $this->deleteByIdTable('client',$id);
    }
    public function findAll($order=''){
        $resultat=$this->listTable('client',$order);
        return $resultat;
    }
    public function statisticVente(){
        
    }

}