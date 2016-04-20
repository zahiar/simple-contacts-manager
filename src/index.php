<?php

require_once dirname(__FILE__) . '/controller/Index.php';

$controller = new \Controller\Index();
$ajaxAction = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
$getAction = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

if (strcasecmp($ajaxAction, 'POST') === 0) {
    $controller->savePeopleHandler();
} else if (strcasecmp($ajaxAction, 'GET') === 0 && strcasecmp($getAction, 'getpeople') === 0) {
    $controller->getPeopleAction();
} else {
    $controller->indexAction();
}
