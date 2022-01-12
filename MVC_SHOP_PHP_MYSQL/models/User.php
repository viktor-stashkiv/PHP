<?php

/**
 * Клас User - модель для роботи з користувачами
 */
class User
{

    /**
     * Реєстрація користувача
      * @Param string $name Ім'я 
      * @Param string $email E-mail 
      * @Param string $password Пароль 
      * @Return boolean Результат виконання методу 
     */
    public static function register($name, $email, $password)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (:name, :email, :password)';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Редагування даних користувача
      * @Param integer $id id користувача 
      * @Param string $name Ім'я 
      * @Param string $password Пароль 
      * @Return boolean Результат виконання методу 
     */
    public static function edit($id, $name, $password)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Перевіряємо чи існує користувач з заданими $email і $password
      * @Param string $email E-mail 
      * @Param string $password Пароль 
      * @Return mixed: integer user id or false
     */
    public static function checkUserData($email, $password)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        // Отримання результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        // Звертаємося до запису
        $user = $result->fetch();

        if ($user) {
            // Якщо запис існує, повертаємо id користувача
            return $user['id'];
        }
        return false;
    }

    /**
     * запам'ятовуємо користувача
     * @Param integer $userId id користувача 
     */
    public static function auth($userId)
    {
        // Записуємо ідентифікатор користувача в сесію
        $_SESSION['user'] = $userId;
    }

    /**
     * Повертає ідентифікатор користувача, якщо він авторизовані. 
      * Інакше перенаправляє на сторінку входу
      * @Return string Ідентифікатор користувача 
     */
    public static function checkLogged()
    {
        // Якщо сесія є, повернемо ідентифікатор користувача
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }
    
    public static function get_id_user()
    {
        // Якщо сесія є, повернемо ідентифікатор користувача
         if (isset($_SESSION['user'])) {
             return $_SESSION['user'];
        }
    }

    /**
     * Перевіряє чи користувач є гостем
      * @Return boolean Результат виконання методу 
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Перевіряє ім'я: не менше, аніж 2 символи
      * @Param string $name Ім'я 
      * @Return boolean Результат виконання методу 
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Перевіряє телефон: чи не менше, ніж 10 символів
      * @Param string $phone Телефон 
      * @Return boolean Результат виконання методу 
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Перевіряє ім'я: не менше, аніж 6 символів
      * @Param string $password Пароль 
      * @Return boolean Результат виконання методу 
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * перевіряє email
      * @Param string $email E-mail 
      * @Return boolean Результат виконання методу 
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Перевіряє чи не зайнятий email іншим користувачем
      * @Param type $email E-mail 
      * @Return boolean Результат виконання методу 
     */
    public static function checkEmailExists($email)
    {
        // З'єднання з БД        
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        // Отримання результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Повертає користувача з зазначеним id
      * @Param integer $id id користувача 
      * @Return array Масив з інформацією про користувача 
     */
    public static function getUserById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT * FROM user WHERE id = :id';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

}

