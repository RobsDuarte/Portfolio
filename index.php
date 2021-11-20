<?php

require __DIR__."/vendor/autoload.php";

use Source\Http\Request;

$teste = new Request();

echo '<pre>'; print_r($teste->getHeaders()); echo '</pre>';
echo '<pre>'; print_r($teste->getURI()); echo '</pre>';
echo '<pre>'; print_r($teste->getHttpMethod()); echo '</pre>';