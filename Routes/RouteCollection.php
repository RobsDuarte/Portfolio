<?php

use Source\Http\Response;
use Source\Controller\Home;

$ObjRouter->get('/',[
    function()
    {
        return new Response(200,Home::getHome());
    }
]);