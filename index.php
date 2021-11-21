<?php

require __DIR__."/vendor/autoload.php";

use Source\Http\Request;
use Source\Http\Response;
use Source\Http\Router;

define('URL','http://localhost/projetos/portfolio');

$ObjRouter = new Router(URL);

include __DIR__."/Routes/RouteCollection.php";

echo $ObjRouter->run()->sendResponse();


