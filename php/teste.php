<?php
global $db;
require("library.php");
require("nusoap/nusoap.php");
$token = "FG#748#1986";
$command = $_POST["command"];
if ($command == "#INITESTE#"){
	myodbc_query("UPDATE `general` SET last_state = 'INI01'",$db);
  $command = "";
}
$return = CallAusiInternal($token, $command);

if (strlen($command) > 1){
  echo "typeUser('".$command."');";
}
if (strlen($return) > 1){
  echo "typeOperator('".$return."');";
}
?>