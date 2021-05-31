<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <? include 'register.php';?>
    <div class="container">
        <div class="container_inside">
            <div class="flex-c">
                <form action="login.php" method="POST">
                    <div class="mb-15"><input type="text" class="pole" name="email" placeholder="Телефон або email"></div>
                    <div class="mb-15"><input type="password" class="pole" name="pass" placeholder="Пароль"></div>
                    <div>
                        <input type="submit" class="btn" value="Увійти">
                        <a href="#" class="forget_pass">Забули пароль?</a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="container_inside">
            <div class="flex-c">
                <div class="title">Вперше на сайті?</div>
                <div class="subtext">Моментальна реєстрація</div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-15"><input type="text" class="pole" name="name_register" placeholder="Ваше ім'я"></div>
                        <div class="mb-15"><input type="text" class="pole" name="lastname_register" placeholder="Ваше прізвище"></div>
                        <div class="mb-15"><input type="email" class="pole" name="email_register" placeholder="Ваша пошта"></div>
                        <div class="mb-15">
                            <select name="day_register" size="1" class="list-day">
                            <option selected disabled hidden>День</option>
                                <?php
                                    for($i=1;$i<=31;$i++){ ?>
                                    <option value="<?php echo $i ?>"><?php echo $i?></option>
                                <?php } ?>
                            </select>
                                
                            <select name="mounth_register" size="1" class="list-mounth">
                                <option selected disabled hidden>Місяць</option>
                                <option value="01">Січня</option>
                                <option value="02">Лютого</option>
                                <option value="03">Березня</option>
                                <option value="04">Квітня</option>
                                <option value="05">Травня</option>
                                <option value="06">Червня</option>
                                <option value="07">Липня</option>
                                <option value="08">Серпня</option>
                                <option value="09">Вересня</option>
                                <option value="10">Жовтня</option>
                                <option value="11">Листопада</option>
                                <option value="12">Грудня</option> 
                            </select>

                            <select name="year_register" size="1" class="list-year">
                            <option selected disabled hidden>Рік</option>
                                <?php
                                for($i=2021;$i>=1900;$i--){ ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        
                        <div class="mb-15"><input type="password" class="pole" name="pass_register" placeholder="Придумайте пароль"></div>
                        <div class="mb-15"><input type="file" name="photo_register"></div>
                        <div><input type="submit" class="btn-register" value="Зареєструватись"></div>

                        <? 
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                                foreach($errors as $err){
                                    echo "$err <br>";
                            }
                        ?>
                    </form>
            </div>
        </div>
    </div>
    
</body>
</html>