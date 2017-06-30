<?php
global $db;

function CallAusiMain($userToken, $message){
	renewStates();
	if (strlen($message) < 2){
		$returnAusi = CallAusiClear($userToken);
	}else{
		$returnAusi = CallAusiCommon($userToken, $message);
		if (strlen($returnAusi) < 3){
			$returnAusi = CallAusiComplex($userToken, $message);
			if (strlen($returnAusi) < 3){
				$returnAusi = CallAusiNegative($userToken, $message);
			}
		}
	}
	return $returnAusi;
}
function CallAusiCommon($userToken, $message){
	global $db;
	$result = myodbc_query("SELECT expression, return_exp FROM `expressions` WHERE type_exp LIKE 'IN'",$db);
	$retperctmp = 0;
	$retperc = 0;
	$retcmd = "";
    while($resultls = myodbc_fetch_array($result)){
		similar_text($message,urldecode($resultls[0]),$retperctmp);
        if ($retperctmp > $retperc)
		{
			$retperc = $retperctmp;
			$retcmd = $resultls[1];
			if (substr($resultls[1], 0, 6) == "HABIT#"){
				$retcmd = replaceVariables(getExpressionOut(str_replace("HABIT#", "", $resultls[1])));
			}
		}
    }
	if ($retperc > getPercentOne()){
		return $retcmd;
	}else{
		return "";
	}
}

function CallAusiComplex($userToken, $message){
	return "";
	//em DESENVOLVIMENTO
	$retHtml = utf8_decode(file_get_contents('http://www.google.com.br/search?q='.urlencode($message).'&oq='.urlencode($message).'&aqs=chrome..69i57j0.4351j0j7&sourceid=chrome&ie=UTF-8'));
	$returnOk = get_string_between($retHtml, '<span class="st">', '</span>');
	$returnOk = utf8_decode(strip_tags($returnOk));
	$returnOk = str_replace(';', "",str_replace('&nbsp;', "", str_replace('?', "", str_replace('"', "", str_replace("'", "", str_replace(">", "", str_replace("<", "", $returnOk)))))));
	if (strlen($returnOk) > 15){
		return $returnOk;
	}else{
		return "";
	}
}

function CallAusiNegative($userToken, $message){
	return replaceVariables(getExpressionOut('NEG01'));
}

function CallAusiClear($userToken){
	if (getState($userToken) == 'INI01'){
		setState($userToken, "WAIT1");
		return replaceVariables(getExpressionOut('INI01C'));
	}
	return "";
}

function replaceVariables($expression){
	return replaceKnowledgeVariables(replaceMemoryVariables($expression));
}
?>