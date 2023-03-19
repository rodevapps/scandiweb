<?php

namespace Scandiweb\Controllers;

abstract class BaseController
{
    protected function output($data, $httpHeaders=array())
    {
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
 
        echo $data;
 
        exit();
    }
}