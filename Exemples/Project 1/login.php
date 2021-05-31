<?php 
    $errors = [];

    function CheckUser($email,$pass){
        $servername = "localhost";
        $dbname = "users";
        $username = "root";
        $password = "root";
        
        try { // виконання підключення
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // встановлення режиму помилок PDO на виключення
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Підключення успішне";
        } catch(PDOException $e) { // обробник у виппадку помилки підключення
            echo "Помилка підключення: " . $e->getMessage();
        }

        try{
            // Отримання результатів. Використовується підготовлений запит
            $result = $conn->prepare("SELECT * FROM register_users WHERE email = :email AND password = :pass");
            $result->execute(['email'=>$email,'pass'=>$pass]);

            $user = $result->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return array($user);
            }
        
        } catch(PDOException $e) { // обробник у виппадку помилки підключення
            echo "Помилка: " . $e->getMessage();
            }
        return false;
    }

    function valid_data($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(!empty($_POST['email'])) {
            $email = valid_data($_POST['email']);
        } else $errors[] = "Невірне ім'я"; 

        if(!empty($_POST['pass'])) {
            $pass = valid_data($_POST['pass']);
        } else $errors[] = "Невірний пароль"; 
    } 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Верифікація</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php if(!CheckUser($email,$pass)){
    foreach($errors as $err){
        echo $err."<br>";}
    } else { ?>
    <table align="center" width="1050" bgcolor="#ffcc00" cellspacing="2" border="1" cellpadding="5">
    <?php $users = CheckUser($email,$pass);?>
    <tr><th>Ім'я</th><th>Прізвище</th><th>Email</th><th>Дата народження</th><th>Пароль</th><th>Фотографія</th><th>Дата реєстрації</th></tr>
    <?php foreach($users as $user){?>
    <tr><td><?php echo $user['name'];?></td><td><?php echo $user['surname'];?></td><td><?php echo $user['email'];?></td><td><?php echo $user['day']."-".$user['month']."-".$user['year'];?></td><td><?php echo $user['password'];?></td><td><?php echo $user['img'];?></td><td><?php echo $user['time'];?></td></tr>
    <?php }?>
    
    </table>
    <?php }?>

</body>
</html>