<?php

namespace Source\Utils;

Class View
{
    public static function getContentView($view)
    {
        $file = __DIR__."/../../View/".$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function getContentImage($vars)
    {        
        $image = __DIR__."/../../img/".$vars.'.svg';            
        return file_get_contents($image);
    }

    public static function render($view,$vars = [])
    {
        $keys = array_keys($vars);       
        $keys = array_map(
            function($key_element)
            {
                return '{{'.$key_element."}}";
            }
            ,$keys);
        $content = self::getContentView($view);
        
        return str_replace($keys,array_values($vars),$content);
    }   
}