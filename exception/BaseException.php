<?php 
/**
 * This class aims to hold all exception messages 
 * 
 * @author Fajar Subhan
 * @category Exception
 */

namespace Api\Exception;

class BaseException
{
    /** 
     * Take an exception message and return the result in json form  
     * 
     * @param object $error  
     * @return json
    */
    public static function getException($error)
    {
        $message = 
        [
            'status'  => false,
            'message' => $error->getMessage(),
            'code'    => $error->getCode(),
            'file'    => $error->getFile(),
            'line'    => $error->getLine(),
            'errors'  => 
            [
                'trace' => $error->getTrace()
            ]
        ];

        header('Content-Type: application/json');
        echo json_encode($message);
        exit;
    }
}