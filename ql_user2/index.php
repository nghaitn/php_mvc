<?php


$action = isset($_GET['action']) ? $_GET['action'] : '';

 
if (empty($action)){
    $action = 'login';
}
 
$path = 'view/' . $action . '.php';
 

if (file_exists($path)) {
    include_once ('./model/database.php');
	include_once ('./controller/session.php');
	include_once ('./controller/functions.php');
    include_once ($path);
} 
