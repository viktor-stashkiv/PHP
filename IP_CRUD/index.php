
<?php

require_once('db.php');

$userAgent = $_SERVER['HTTP_USER_AGENT'];
$cookie = $_SERVER['HTTP_COOKIE'];
$ip = $_SERVER['SERVER_ADDR'];
$page = $_SERVER['PHP_SELF'];
    
DB::saveIP($userAgent,$cookie,$ip,$page);

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
    <div class="container">

    <p>Інформація про ІР<p>
        <table align="center">
            <tr>
            <td>IP</td>
            <td>USER_AGENT</td>
            <td>PAGE</td>
            <td>COOKIE</td>
            </tr>
            <tr>
            <td><? echo $ip; ?></td>
            <td><? echo $userAgent?></td>
            <td><? echo $page;?></td>
            <td><? echo $cookie?></td>
        </tr>
        </table>
        
        <p><a href="/ips.php">Переглянути всі IP</a></p>
    </div>
</body>
</html>