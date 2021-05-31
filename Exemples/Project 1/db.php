<?php 
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

    $PDO = null;
    // create table
    try {
      //$conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
   
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
      $sql = "CREATE TABLE User (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      firstname VARCHAR(30) NOT NULL,
      lastname VARCHAR(30) NOT NULL,
      email VARCHAR(50),
      reg_date TIMESTAMP)";
   
      $conn->exec($sql);
      echo "<br>Таблиця User створена успішно";
      }
   catch(PDOException $e)
      {
      echo $sql . "<br>" . $e->getMessage();
      }
   

   // insert in table
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $sql = "INSERT INTO User (firstname, lastname, email)
    VALUES ('Андрій', 'Райтер', 'araiter@gmail.com'),
           ('Viktor', 'Stashkiv', 'stashkiv77@gmail.com'),
           ('Андрій', 'Райтер', 'araiter@gmail.com')";
 
    $conn->exec($sql);
    print($last_id = $conn->lastInsertId());

    echo "Успішно добавлені нові дані";
    }
    catch(PDOException $e)
    {
     echo $sql . "<br>" . $e->getMessage();
    }


// декілька запитів
try {
  // Почати транзакції
  $conn->beginTransaction();
  // Вставити записи
  $conn->exec("INSERT INTO User (firstname, lastname, email)
  VALUES ('Сергій', 'Вогер', 'shipunov@gmail.com')");
  $conn->exec("INSERT INTO User (firstname, lastname, email)
  VALUES ('Віктор', 'Качерай', 'petrov@gmail.com')");
  $conn->exec("INSERT INTO User (firstname, lastname, email)
  VALUES ('Іван', 'Брик', 'ivan-sig@gmail.com')");

  // Зафіксувати транзакцію
  $conn->commit();
  echo "Дані успішно додані";
  }
catch(PDOException $e)
   {
  // Відкат транзакції
  $conn->rollback();
  echo "Помилка: " . $e->getMessage();
  }

// insert any data
try{
  // Підготовка SQL та параметрів до прив'язки
  $stmt = $conn->prepare("INSERT INTO User (firstname, lastname, email)
  VALUES (:firstname, :lastname, :email)");
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':email', $email);

  // Вставити рядок
  $firstname = "Андрій";
  $lastname = "Дяк";
  $email = "fed@example.ru";
  $stmt->execute();

  // Вставити рядок
  $firstname = "Лев";
  $lastname = "Яшин";
  $email = "leva@example.ru";
  $stmt->execute();

  echo "Успішно додані нові записи";
  }
  catch(PDOException $e)
  {
  echo "Помилка: " . $e->getMessage();
  }

// data output 
foreach($conn->query('SELECT * FROM user') as $row) {
  echo $row['id'] . ' ' . $row['firstname'];
  print("<pre>");
  print_r($row);
  print("</pre>");
}

?>
