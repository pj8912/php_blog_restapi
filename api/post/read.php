<?php
header('Access-Control-Allow-Origin : *');

header('Content-Type: application/json');


include '../../models/Post.php';
include '../../config/Database.php';
$databse = new Database();
$db = $databse->connect();
$post = new Post($db);
$result = $post->read();

$num = $result->rowCount();
if ($num > 0) {
    $post_arr = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = [
            'id' => $id,
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        ];
        array_push($post_arr, $post_item);
    }
    echo json_encode($posts_arr);
} else {
    
    echo json_encode(['message' => 'No Posts Found']);
}
