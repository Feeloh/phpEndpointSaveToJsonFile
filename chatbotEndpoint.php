<?php

getClients();

function getClients()
{
    // load required supported files
    require_once("dbController.php");

    // load contents
    $client = $_GET['client'];

    // create objects from class
    $db_handle = new DBController();

    // load data from database
    $sql = json_encode($db_handle->runQuery("SELECT * FROM `client_paymentterms` WHERE `name`= '$client'"));

    $rowcount=$db_handle->numRows("SELECT * FROM `client_paymentterms` WHERE `name`= '$client'");

    $error = 'No content';

    if($rowcount > 0)
    {		   
        $message  = [$sql];
        $input = fopen('staffShowerEndpoint.json','w');
        fwrite($input, json_encode($message, JSON_FORCE_OBJECT));
        var_dump($message);die();
    } 
    else
    {
        $message  = [$error];
        $input = fopen('staffShowerEndpoint.json','w');
        fwrite($input, json_encode($message, JSON_FORCE_OBJECT));
    }

    return;
}