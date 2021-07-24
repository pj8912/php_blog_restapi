<?php


header('Access-Control-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

$databse = new Database();
$db = $db->connect();

$post = new Post($db);
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

if ($post->delete()) {
    echo json_encode(['message' => 'Post Delted']);
} else {
    echo json_encode(['message' => 'Post Not Delted']);
}
