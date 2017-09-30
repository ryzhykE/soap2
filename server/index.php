<?php
include_once ('config.php');
include_once('ShopCars.php');

ini_set('soap.wsdl_cache_enabled', '0');
$obj = new SoapServer('http://soap.loc/server/auto.wsdl');
$obj->setClass('ShopCars');
$obj->handle();







/**
$result = new ShopCars();
$allCar = $result->allCars();

echo '<pre>';
print_r($allCar);
echo '</pre>';
//echo json_encode($allCar);

$idCar = $result->idCars(2);
echo '<pre>';
print_r($idCar);
echo '</pre>';

$params = [
    'year'=>'2015', 
    'model'=>'Corola', 
    //'brand'=>'TracKtorFigaktor',
    //'engine'=>'3500', 
    //'color'=>'RED', 
    //'max_speed'=>'800', 
    //'price'=>4000 
                  ];
$search = $result->getSerch($params);
echo '<pre>';
print_r($search );
echo '</pre>';

$order = [
     'id_cars'=>'1', 
     'first_name'=>'Test_E', 
     'second_name'=>'E_Test',
     'payment'=>'cash'
     ];

//$myord = $result->getOrders($order);
//print_r($myord);
 *
 * $order = [
'id_cars'=>'1',
'first_name'=>'Test_E',
'second_name'=>'E_Test',
'payment'=>'cash'
];
$result = new ShopCars();
$myord = $result->getOrders($order);


 */



