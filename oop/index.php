<?php
define("APP_PATH","/oop/");
include_once('autoLoader.php');


spl_autoload_register('basic_loader');
spl_autoload_register('controller_loader');
spl_autoload_register('view_loader');
spl_autoload_register('model_loader');

$router = new router();
$router->bind('studentController',function($router){
	return new studentController();
});
// $router->bind('testController',function($router){
// 	return new testController;
// });
// $router->addRule(['test' => 'testController@test']);
// $router->addRule(['studentTotal' => 'testController@studentTotal']);

$router->addRule(['home' => 'studentController@home']);
$router->addRule(['add' => 'studentController@add']);
$router->addRule(['student' => 'studentController@stuList']);
$router->addRule(['detail/_num' => 'studentController@detail']);

$router->route();
?>