<?php
global $db;

function replaceKnowledgeVariables($expression){
	if (strpos($expression, "#TIME#HOUR#") > 0){
        $expression = str_replace("#TIME#HOUR#", date('H'), $expression);
    }
	if (strpos($expression, "#TIME#MINUTE#") > 0){
        $expression = str_replace("#TIME#MINUTE#", date('i'), $expression);
    }
    return $expression;
}
?>