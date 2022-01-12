<?php
require_once('db.php');

function validation($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$id = validation($_GET['id']);

if($id) {
    DB::deleteIP($id);
    header("Location: /ips.php");
}else {
    header("Location: /index.php");
}
?>