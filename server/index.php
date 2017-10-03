<?php
include_once ('config.php');
include_once('ShopCars.php');

try
{
    ini_set('soap.wsdl_cache_enabled', '0');
    $obj = new SoapServer('http://soap.loc/server/auto.wsdl');
    $obj->setClass('ShopCars');
    $obj->handle();
}

catch(Exception $e)
{
    $error = $e->getMessage();
}


