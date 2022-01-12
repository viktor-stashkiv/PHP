
<?php

require_once('db.php');


$fetch = DB::showIP();

?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>IPs</title>
</head>
<body>
<a href="/index.php">Назад</a>
<table align="center">
 <tr>
  <td>ID</td>
  <td>IP</td>
  <td>USER_AGENT</td>
  <td>PAGE</td>
  <td>COOKIE</td>
  <td>DATE</td>
  <td>ДІЇ</td>
 </tr>
<? foreach($fetch as $fet):?>
<tr>
  <td><? echo $fet['id'];?></td>
  <td><? echo $fet['IP'];?></td>
  <td><? echo $fet['USER_AGENT'];?></td>
  <td><? echo $fet['PAGE'];?></td>
  <td><? if(empty($fet['COOKIE'])){echo 'Відстутні';} else echo $fet['COOKIE'];?></td>
  <td><? echo $fet['DATE'];?></td>
  <td><a href="/delete.php?id=<?echo $fet['id'];?>"><img src="img/close.png" width="25" height="25"></a><a href="/update.php?id=<?echo $fet['id'];?>"><img src="img/update.png" width="20" height="20"></a></td>
</tr>
<?php endforeach; ?>
 </table>
    
</body>
</html>