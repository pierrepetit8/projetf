<?php

/**
 * Created by PhpStorm.
 * User: petit
 * Date: 14/12/2016
 * Time: 22:14
 */
class Validate
{
    public function sanitizeVar($var, $type)
    {
        switch($type)
        {
            case 'int' :
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;
            case 'email' :
                $filter = FILTER_SANITIZE_EMAIL;
                break;
            case 'string' :
                $filter = FILTER_SANITIZE_STRING;
                break;
            default:
                return null;
        }
        $result = filter_var($var, $filter);
        return($result);
    }

    public function validateVar($var, $type)
    {
        switch($type)
        {
            case 'int' :
                $filter = FILTER_VALIDATE_INT;
                break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
                break;
            case 'email':
                $filter = FILTER_VALIDATE_EMAIL;
                break;
            default:
                return null;
        }
        $result = filter_var($var, $filter);
        return($result);
    }
}