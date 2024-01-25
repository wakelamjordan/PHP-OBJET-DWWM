<?php
    require_once("Service/extra.php");
    spl_autoload_register('charger');
    $m=new Manager();
    $dataCondition=[
        'numClient'=>'CT10654',
        'nomClient'=>'Marie',
    ];
    $client1=$m->findAllByConditionTable('client',[],' order by nomClient ');
    printr($client1);
    $client2=$m->findOneByConditionTable('client');  //  Recherche sans condition 
    printr($client2);