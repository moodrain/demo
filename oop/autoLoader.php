<?php
function basic_loader($className)
{
	$fileName = $className . ".php";
	if(file_exists($fileName))
		include_once($fileName);
}
function app_loader($className) 
{
    $fileName = "./app/" . $className . ".php";
    if(file_exists($fileName))
    	include_once($fileName);
}
function controller_loader($className) 
{
    $fileName = "./app/controller/" . $className . ".php";
    if(file_exists($fileName))
    	include_once($fileName);
}
function view_loader($className) 
{
    $fileName = "./app/view/" . $className . ".php";
    if(file_exists($fileName))
    	include_once($fileName);
}
function model_loader($className) 
{
    $fileName = "./app/model/" . $className . ".php";
    if(file_exists($fileName))
    	include_once($fileName);
}
?>