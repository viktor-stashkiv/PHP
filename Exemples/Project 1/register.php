<?php 
        $errors = [];
        $confirm = false;

        function valid_data($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($_POST['name_register'])) {
                $name_register = valid_data($_POST['name_register']);
                $confirm = true;
            } else {$errors[] = "Невірне ім'я"; $confirm = false;}

            if(!empty($_POST['lastname_register'])) {
                $lastname_register = valid_data($_POST['lastname_register']);
                $confirm = true;
            } else {$errors[] = "Невірне прізвище"; $confirm = false;}

            if(!empty($_POST['day_register'])){
                $day_register = valid_data($_POST['day_register']);
                $confirm = true;
            } else {$errors[] = "Виберіть день народження"; $confirm = false;}

            if(!empty($_POST['mounth_register'])){
                $mounth_register = valid_data($_POST['mounth_register']);
                $confirm = true;
             } else {$errors[] = "Виберіть місяць народження"; $confirm = false;}

            if(!empty($_POST['year_register'])){
                $year_register = valid_data($_POST['year_register']);
                $confirm = true;
            } else {$errors[] = "Виберіть рік народження"; $confirm = false;}

            if(!empty($_POST['email_register'])){
                $email_register = valid_data($_POST['email_register']);
                $confirm = true;
            } else {$errors[] = "Невірний email"; $confirm = false;}

            if(!empty($_POST['pass_register'])){
                $pass_register = valid_data($_POST['pass_register']);
                $confirm = true;
            } else {$errors[] = "Невірний пароль"; $confirm = false;}

            // завантаження фала
            if ($_FILES && $_FILES['filename']['error'] == UPLOAD_ERR_OK) 
            {
                $uploaddir = 'D:\\Programs\\OpenServer\\domains\\ts\\upload\\';
                $uploadfile = $uploaddir . $_FILES['photo_register']['name'];
                
                if (move_uploaded_file($_FILES['photo_register']['tmp_name'], $uploadfile) && $_FILES['photo_register']['type']=="image/png"){
                    echo "Фото завантажене.\n";
                
                } else {$errors[] = "Виберіть фото"; $confirm = false;}
            } 
        }

        if($confirm){
            $servername = "localhost";
            $dbname = "users";
            $username = "root";
            $password = "root";
            
            try { // виконання підключення
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // встановлення режиму помилок PDO на виключення
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Підключення успішне";
            } catch(PDOException $e) { // обробник у виппадку помилки підключення
            echo "Помилка підключення: " . $e->getMessage();
            }

            try{
                // Підготовка SQL та параметрів до прив'язки
                $stmt = $conn->prepare("INSERT INTO register_users(name,surname,email,day,month,year,password,img) VALUES (:name,:surname,:email,:day,:month,:year,:password,:img)");
                $stmt->bindParam(':name', $name_register);
                $stmt->bindParam(':surname', $lastname_register);
                $stmt->bindParam(':email', $email_register);
                $stmt->bindParam(':day', $day_register);
                $stmt->bindParam(':month', $mounth_register);
                $stmt->bindParam(':year', $year_register);
                $stmt->bindParam(':password', $pass_register);
                $stmt->bindParam(':img', $uploadfile);
        
                $stmt->execute();
              
                echo " Ви успішно зареєструвалися!";
                }
                catch(PDOException $e)
                {
                echo "Помилка: " . $e->getMessage();
                }
        }

    ?>