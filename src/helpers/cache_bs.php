<?php

function cache_bs($path){

    try
    {
        $ts = '?v=' . File::lastModified(public_path() . $path);
    }
    catch(Exception $e)
    {
        $ts = '';
    }

    return $path.$ts;

}
