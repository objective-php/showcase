<?php

    namespace Showcase\Package\Debug;
    
    
    use ObjectivePHP\Html\Tag\Tag;

    /**
     * Class Dumper
     *
     * @package Showcase\Package\Debug
     */
    class Dumper
    {
        /**
         * @param      $value
         * @param null $label
         */
        public static function dump($value, $label = null)
        {
            echo Tag::pre();
            if($label) echo Tag::div($label);
            var_dump($value);
            echo Tag::pre()->close();
        }
    }