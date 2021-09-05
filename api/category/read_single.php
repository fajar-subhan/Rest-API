<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../vendor/autoload.php';

use Api\Core\Request;
use Api\Models\Category;

// Instantitate Category
$category  = new Category();

// Enter data into properties
foreach(Request::getData() as $value)
{
    if(!empty($value['id']))
    {
        $category->id = $value['id'];
    }
}

$category->readSingle();
