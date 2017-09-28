<?php

include_once ('config.php');
include_once ('ShopCars.php');

$result = new ShopCars();
$allCar = $result->allCars();

echo '<pre>';
print_r($allCar);
echo '</pre>';
//echo json_encode($allCar);

$idCar = $result->idCars(1);
echo '<pre>';
print_r($idCar);
echo '</pre>';

$search = $result->getSerch('Corola');
echo '<pre>';
//print_r($search );
echo '</pre>';