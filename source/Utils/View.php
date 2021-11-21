<?php

namespace Source\Utils;

Class View
{
    private static function getContentView($view)
    {
        $file = __DIR__."/../../View/".$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function render($view,$vars= [])
    {
        $keys = array_keys($vars);
        $keys = array_map(
            function($key_element)
            {
                return '{{'.$key_element."}}";
            }
            ,$keys);
        $content = self::getContentView($view);
        return str_replace($keys,array_values($keys),$content);
    }   
}