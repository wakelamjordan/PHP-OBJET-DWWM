<?php
    require_once("Service/extra.php");
    spl_autoload_register('charger');
    $cm=new ClientManager();
    $columnLikes=['numClient','nomClient','adresseClient'];
    $mot="er";
    $clients=$cm->search($columnLikes,$mot);
    MyFct::sprintr($clients);

    // $cm=new ClientManager;
    // $data=[
    //     "id"=>5,
    //     "numClient"=>"CLT4588",
    //     "nomClient"=>"Dupont+++++++",
    //     "adresseClient"=>"Niort"
    // ];
    // $id=5;

    // $cm->update($data,$id);
