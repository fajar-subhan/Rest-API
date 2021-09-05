<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use Api\Models\Posts;

require_once '../../vendor/autoload.php';

// Instantitate Posts
$posts  = new Posts();
$posts->read(); 

