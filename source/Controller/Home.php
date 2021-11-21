<?php

namespace Source\Controller;

use Source\Utils\View;

Class Home 
{
    public  static function getHome()
    {
        return View::render('home');
    }
}