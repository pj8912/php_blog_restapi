<?php

header('Access-Control-Allow-Origin : *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$db = new Database();
$db = $db->connect();
$category = new Category($db);

$res = $category->read();

$num = $res->rowCount();

if ($num >  0) {
    $cat_arr = [];
    $cat_arr['data'] = [];
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cat_item = [
            'id' => $id,
            'name' => $name
        ];

        array_push($cat_arr['data'], $cat_item);
    }

    json_encode($cat_arr);
} else {

    // No Categories
    echo json_encode(
        ['message' => 'No Categories Found']
    );
}
