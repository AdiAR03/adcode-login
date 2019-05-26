<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cetak'))
{
    function cetak($str)
    {
        echo htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
}