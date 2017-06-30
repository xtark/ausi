<?php
/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);*/
require("config.php");
require("cores/knowledge.php");
require("cores/memory.php");
require("cores/decision.php");
global $db;
session_start();

function openDB(){
	global $db;
	$db = mysqli_connect(getDBHost(), getDBUser(), getDBPass(), getDBBase());
}
function myodbc_query($select){
	global $db;
	return mysqli_query($db, $select);
}
function myodbc_fetch_row($resultado){
	return mysqli_fetch_row($resultado);
}

function myodbc_fetch_array($resultado){
	return mysqli_fetch_array($resultado);
}

function myodbc_num_rows($resultado){
	return mysqli_num_rows($resultado);
}

function CallAusiInternal($userToken, $message){
	$message = standardizeText($message);
	return CallAusiMain($userToken, $message);
}

function standardizeText($message){
	$message = removeAccents($message);
	$message = strtoupper($message);
	return $message;
}

function removeAccents($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function getExpressionOut($classExp){
    global $db;
	$result = myodbc_query("SELECT expression FROM `expressions` WHERE class_exp LIKE '".$classExp."'",$db);
	$randExp = rand(1, myodbc_num_rows($result));
	$nret = 1;
	while($resultls = myodbc_fetch_array($result)){
		if ($nret == $randExp){
			return urldecode($resultls[0]);
		}
		$nret = $nret + 1;
    }
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

openDB();
?>