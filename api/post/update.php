<?php

header('Access-Control-Allow-Origins :  *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods : PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include '../../models/Post.php';
include '../../config/Database.php';
$databse = new Database();
$db = $databse->connect();
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;



if($post->update()){
    echo json_encode(['message' => 'Post Updated']);
}
else{
    echo json_encode(['message' => 'Post Not Updated']);
}