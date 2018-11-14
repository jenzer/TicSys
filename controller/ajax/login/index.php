<?php
require "{$_SERVER['DOCUMENT_ROOT']}/vendor/autoload.php";

include_once "{$_SERVER['DOCUMENT_ROOT']}/config/config.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/vendor/KLogger.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/LoginController.php";

session_start();
$controller = new LoginController();
if ($controller != null) {
    $controller->route();
}
?>