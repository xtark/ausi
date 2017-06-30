<?php
require("library.php");
require("nusoap/nusoap.php");
$URL       = getURL();
$namespace = $URL.'?wsdl';

//using soap_server to create server object
$server    = new soap_server;
$server->configureWSDL('AUSIService', $namespace);

//register a function that works on server
$server->register('CallAusi');

// create the function
function CallAusi($userToken, $message)
{
    if (!$userToken) {
        return new soap_fault('Client', '', 'Desculpe, não consigo responder, temos um problema em seu Token.');
    }
    if (!$message) {
        return new soap_fault('Client', '', 'Desculpe, não consigo responder, temos um problema em sua Interação.');
    }
    $result = CallAusiInternal($userToken, $message);
    return $result;
}
// create HTTP listener
$server->service($HTTP_RAW_POST_DATA);
exit();
?>