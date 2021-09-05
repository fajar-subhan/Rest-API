<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json;charset=UTF-8');   
header('Access-Control-Allow-Methods: PUT');
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorization,X-Requested-With');


require_once '../../vendor/autoload.php';

use Api\Models\Posts;

// Instantitate Posts
$posts  = new Posts();

$data = json_decode(file_get_contents('php://input'));

$posts->id          = $data->posts_id;
$posts->category_id = $data->category_id;
$posts->title       = $data->title;
$posts->body        = $data->body;
$posts->author      = $data->author;

$posts->update();