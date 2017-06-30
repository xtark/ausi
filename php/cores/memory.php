<?php
function getState($userToken){
    global $db;
	$result = myodbc_fetch_row(myodbc_query("SELECT last_state FROM general WHERE token LIKE '".$userToken."'",$db));
    return $result[0];
}

function renewStates(){
    global $db;
	myodbc_query("UPDATE `general` SET last_state = 'INI01', last_state_date = NOW() WHERE last_state_date < DATE_ADD(NOW(), INTERVAL -5 MINUTE)",$db);
}

function setState($token, $state){
    global $db;
	myodbc_query("UPDATE `general` SET last_state = '".$state."', last_state_date = NOW() WHERE token like '".$token."'",$db);
}

function getParam($param){
    global $db;
	$result = myodbc_fetch_row(myodbc_query("SELECT param_value FROM params WHERE param_id LIKE '".$param."'",$db));
    return $result[0];
}

function replaceMemoryVariables($expression){
	if (strpos($expression, "&NAME&") > 0){
        $expression = str_replace("&NAME&", getParam('NAME'), $expression);
    }
    if (strpos($expression, "&NAME_AUSI&") > 0){
        $expression = str_replace("&NAME_AUSI&", getParam('NAME_AUSI'), $expression);
    }
    return $expression;
}
?>