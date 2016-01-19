<?php
/**
 * Created by PhpStorm.
 * User: zl
 * Date: 2016/1/19
 * Time: 10:01
 */
if(!function_exists('mysql_escape')){
    function mysql_escape($inp){
        if(is_array($inp))
            return array_map(__METHOD__,$inp);
        if(!empty($inp) && is_string($inp)){
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

    }
}