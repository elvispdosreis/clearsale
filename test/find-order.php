<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 02/05/2017
 * Time: 09:44
 */

require __DIR__ . '/config.php';
require __DIR__ . '/../vendor/autoload.php';

use ClearSale\Environment\Sandbox;
use ClearSale\ClearSale;

$environment = new Sandbox(ENTITY_CODE);

$clearsale = new ClearSale($environment);
$package = $clearsale->getOrderStatus('2');
print_r($package);