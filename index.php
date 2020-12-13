<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');
ob_start();

include_once 'includes/core.php';
include_once 'includes/helpers.php';
include_once 'includes/config.php';

$controller = new TestController();

$response = $controller->testAction();

echo $response;

ob_end_flush();
