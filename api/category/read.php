<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use Api\Models\Category;

require_once '../../vendor/autoload.php';

// Instantitate Category
$category = new Category();
$category->read();

