<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../vendor/autoload.php';

use Api\Core\Request;
use Api\Models\Posts;

// Instantitate Posts
$posts  = new Posts();

// Enter data into properties
foreach(Request::getData() as $value)
{
    if(!empty($value['id']))
    {
        $posts->id = $value['id'];
    }
}

$posts->readSingle();
