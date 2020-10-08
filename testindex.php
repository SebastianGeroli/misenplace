<?php 
require_once("./includes/class-autoload.inc.php");
$testObj = new UsersView();
//$testObj->getRoles();
//$testObj->getRolesStmt("m");
//$testObj->setRolesStmt("RECARGADO");
$testObj->showUser(1);
?>