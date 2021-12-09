<?php 

//header('Content-type: json/application');

require 'Rest.php';

$url = Rest::getURL();

switch($url['method']){
    case 'GET': 
        if($url['type'] === 'posts'){
            if(isset($url['id'])){
                Rest::getPost($url['id']);
            } else {
                Rest::getPosts();
            }  
        } else {
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "Post not found"
            ];
            
            echo json_encode($res);
        }
        break;
    case 'POST':
        if($url['type'] === 'posts'){
            Rest::addPost($_POST);
        }
        break;
    case 'PATCH':
        if($url['type'] === 'posts'){
            if(isset($id)){
                $data = json_decode(file_get_contents('php://input'),true);
                Rest::updatePost($url['id'],$data);
            } 
        }
        break;
    case 'DELETE':
        if($url['type'] === 'posts'){
            if(isset($url['id'])){
                Rest::deletePost($url['id']);
            } 
        }
        break;
}

?>