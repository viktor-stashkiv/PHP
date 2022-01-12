<?php
require_once('db.php');

function validation($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripcslashes($data);
    return $data;
}

$id = validation($_GET['id']);

if($id) {
    $fetch = DB::showIPtoID($id);

    if(!empty($_POST)){
        $idUpdate = validation($_POST['ip']);
        $userAgentUpdate = validation($_POST['user_agent']);
        $pageUpdate = validation($_POST['page']);
        $cookieUpdate = validation($_POST['cookie']);

        DB::updateIP($id,$idUpdate,$userAgentUpdate,$pageUpdate,$cookieUpdate);
        header("Location: /ips.php");
    }
    ?>
<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>IP</title>
</head>
<body>
    <div class="container_update">
    <a href="/ips.php">Назад</a>

    <p>Інформація про ІР<p>
    <form action="<? echo $_SERVER['PHP_SELF']."?id=$id";?>" method="POST">
        <label for="ip" class="text-field__label">IP:</label><br>
        <input class="text-field__input" type="text type="text" id="ip" name="ip" value="<? echo $fetch['IP'];?>"><br>
        <label for="user_agent" class="text-field__label">User agent:</label><br>
        <input class="text-field__input" type="text type="text" id="user_agent" name="user_agent" value="<? echo $fetch['USER_AGENT'];?>"><br>
        <label for="page" class="text-field__label">Page:</label><br>
        <input class="text-field__input" type="text type="text" id="page" name="page" value="<? echo $fetch['PAGE'];?>"><br>
        <label for="page" class="text-field__label">Cookie:</label><br>
        <input class="text-field__input" type="text type="text" id="cookie" name="cookie" value="<? echo $fetch['COOKIE'];?>"><br>
        <input type="submit" value="Оновити дані">
    </form>
        
    
    </div>
</body>
</html>
<?
   
}else {
    header("Location: /index.php");
}
?>