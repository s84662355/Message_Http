<?php
/**
 * Created by PhpStorm.
 * User: chenjiahao
 * Date: 2019-06-10
 * Time: 18:10
 */


require('../vendor/autoload.php');

use websocketsp\PubClient;


$config = include '../config/websocketsp.php';

var_dump($config);

$uri = "ws://{$config['host']}:{$config['port']}";

$Client = new PubClient($uri,$config['options']);

$Client->auth($config['password']);

$Client->publish("dssksgsklgskl放到了快三个酸辣粉高考顺利sdmfldskfs".time(),"111111",1,"skvmdlvmdkflvd",3,"111111");