<?php

namespace Source\Controller;

use Source\Utils\View;

Class Home 
{
    public  static function getHome()
    {   
        
        include  __DIR__.'/../../Includes/Images.php';
        include  __DIR__.'/../../Includes/Url.php';

        return View::render('home',[
            'php'          => $php, 
            'sql'           => $sql,
            'css'           => $css,
            'html'          => $html,
            'js'            => $js,           
            'link'          => $link,
            'git'           => $git,
            'git_web_ivana' => $git_web_ivana,
            'web_ivana'     => $web_ivana,
            'my_github'     => $my_github,
            'my_linkedin'   => $my_linkedin
        ]);
    }
}