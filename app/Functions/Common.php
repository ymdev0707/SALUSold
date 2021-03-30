<?php

namespace App;

class Common
{
    /**
     * debug
     *
     * @param  mixed $target
     * @return void
     */
    public static function debug($target){
        echo('<pre>');
        var_dump($target);
        echo('</pre>');
        exit;
    }
}
