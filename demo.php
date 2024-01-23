<?php
    require_once("Service/extra.php");
    spl_autoload_register('charger');
    $m=new Manager();
    $clients=$m->findAllByConditionTable('client');
    MyFct::sprintr($clients);die;

    // $cm=new ClientManager;
    // $data=[
    //     "id"=>5,
    //     "numClient"=>"CLT4588",
    //     "nomClient"=>"Dupont+++++++",
    //     "adresseClient"=>"Niort"
    // ];
    // $id=5;

    // $cm->update($data,$id);
