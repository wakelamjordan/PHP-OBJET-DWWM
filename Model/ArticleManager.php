<?php
class ArticleManager extends Manager{
    public function findAllByCondition($dataCondition=[],$order='',$type='obj'){
        return $this->findAllByConditionTable('article',$dataCondition,$order,$type);
    }
    public function findOneByCondition($dataCondition=[],$type='obj'){
        return $this->findOneByConditionTable('article',$dataCondition,$type);
    }
    public function search($columnLikes,$mot){
        return $this->searchTable('article',$columnLikes,$mot);
    }
    public function update($data,$id){
        $this->updateTable('article',$data,$id);
    }
    public function insert($data){
        $this->insertTable('article',$data);
    }
    public function getDescribe(){
        $resultat=$this->getDescribeTable('article');
        return $resultat;
    }
    public function findById($id,$type="obj"){
        $resultat=$this->findByIdTable('article',$id);
        if($type=="obj"){
            $objet=new Article($resultat);
            return $objet;
        }else{
            return $resultat;
        }
    }
    public function deleteById($id){
        $this->deleteByIdTable('article',$id);
    }
    public function findAll(){
        $resultat=$this->listTable('article');
        return $resultat;
    }
    public function statisticVente(){
        
    }

}