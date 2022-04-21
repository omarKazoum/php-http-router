<?php
require_once '../controllers/controlers.php';
require_once '../route/Router.php';
require_once '../route/routes.php';


Router::processIncomingRequest();

phpinfo();
?>