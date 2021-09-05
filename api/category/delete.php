<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json;charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization,X-Requested-With');

require_once '../../vendor/autoload.php';

use  Api\Models\Category;

// Instantitate Category
$category = new Category();

$data = json_decode(file_get_contents('php://input'));

// Set property
$category->id = $data->id;

$category->delete();