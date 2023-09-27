<?php

class tratamento{
    public static function null_array($array){
        foreach($array as &$value){
            if(is_array($value)){
                $value = null_array($value);
            }else if(trim($value) === ''){
                $value = NULL;
            }
        }
        return $array;
    }
}