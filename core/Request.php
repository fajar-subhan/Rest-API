<?php 
/**
 * This class is useful for taking requests
 * 
 * @author Fajar Subhan
 * @category Request
 */

namespace Api\Core;

class Request 
{

    /**
     * Memberikan informasi request method yang didapatkan
     * 
     */
    public static function isMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Retrieve $_GET data
     * 
     * @var array $data
     */
    public static function getData()
    {
        $data = [];

        if(self::isMethod() == "get")
        {
            $i = 0;
            foreach($_GET as $name => $value)
            {
                $data[$i][$name] = htmlentities(strip_tags(trim(filter_input(INPUT_GET,$name,FILTER_SANITIZE_SPECIAL_CHARS))));
                $i++;
            }
        }

        return $data;
    }


}
