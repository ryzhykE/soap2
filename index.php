<?php
include_once ('server/ShopCars.php');
include_once ('server/config.php');
ini_set("soap.wsdl_cache_enabled", "0");

$client = new SoapClient("http://soap.loc/server/auto.wsdl");
echo $client->allCars();
echo '</br>';
echo $client->idCars(2);
echo '</br>';
echo $client->getSerch('{"brand":"Toyota","year":"2015"}');
echo '</br>';

