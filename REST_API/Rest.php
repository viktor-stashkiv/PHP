<?php 

require('Db.php');

class Rest {

    public static function getURL(){

        $url = [];

        $params = explode('/', $_GET['q']);  // перетворює стрічку в масив [0 => 'posts',1 => '1']

        $url['method'] = $_SERVER['REQUEST_METHOD'];
        $url['type'] = $params[0];
        $url['id'] = $params[1];

        return $url;
    }

    public static function getPosts(){

        $connect = Db::Connection();
        $posts = mysqli_query($connect,"SELECT * FROM `posts`");
        $postsList = [];

        while($post = mysqli_fetch_assoc($posts)){
            $postsList[] = $post;
        }
    
        echo json_encode($postsList);
    }

    public static function getPost($id){

        $connect = Db::Connection();
        $post = mysqli_query($connect,"SELECT * FROM `posts` WHERE `id` = '$id'");
    
        if(mysqli_num_rows($post) === 0){
            http_response_code(404);
            $res = [
                "status" => false,
                "message" => "Post not found"
            ];
            
            echo json_encode($res);
        } else {
            $post = mysqli_fetch_assoc($post);
            echo json_encode($post);
        }
    }

    public static function addPost($data){
        
        $connect = Db::Connection();
        $title = $data['title'];
        $body = $data['body'];
    
        mysqli_query($connect,"INSERT INTO `posts` (`id`,`title`,`body`) VALUES (NULL,'$title','$body')");
        
        http_response_code(201);
        $res = [
            "status" => true,
            "post_id" => mysqli_insert_id($connect),
        ];
    
        echo json_encode($res);
    }

    public static function updatePost($id,$data){
        
        $connect = Db::Connection();
        $title = $data['title'];
        $body = $data['body'];
    
        mysqli_query($connect,"UPDATE `posts` SET `title` = '$title',`body` = '$body' WHERE `posts` . `id` = '$id'");
        
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Post is updated',
        ];
    
        echo json_encode($res);
    }
    
    public static function deletePost($id){
    
        $connect = Db::Connection();
        mysqli_query($connect,"DELETE FROM `posts` WHERE `posts` . `id` = '$id'");
        
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => 'Post is deleted',
        ];
    
        echo json_encode($res);
    }

}


