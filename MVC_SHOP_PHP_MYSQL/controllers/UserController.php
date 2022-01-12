<?php

/**
 * Контролер UserController
 */
class UserController
{
    /**
     * Action для сторінки "Реєстрація"
     */
    public function actionRegister()
    {
        // Змінні для форми
        $name = false;
        $email = false;
        $password = false;
        $result = false;

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Прапор помилок
            $errors = false;

            // Валідація полів
            if (!User::checkName($name)) {
                $errors[] = 'Ім\'я не повинно бути коротше 2-х символів';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильний email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не повинен бути коротше 6-ти символів';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такий email вже використовується';
            }
            
            if ($errors == false) {
                // Якщо помилок немає
                // Реєструємо користувача
                $result = User::register($name, $email, $password);
            }
        }

        // Підключаємо вид
        require_once(ROOT . '/views/user/register.php');
        return true;
    }
    
    /**
     * Action для сторінки "Вхід на сайт"
     */
    public function actionLogin()
    {
        // Змінні для форми
        $email = false;
        $password = false;
        
        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Прапор помилок
            $errors = false;

            // Валідація полів
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильний email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не повинен бути коротше 6-ти символів';
            }

            // Перевіряємо чи існує користувач
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                // Якщо дані неправильні - показуємо помилку
                $errors[] = 'Неправильні дані для входу на сайт';
            } else {
                // Якщо дані правильні, запам'ятовуємо користувача (сесія)
                User::auth($userId);

                // Перенаправляємо користувача в закриту частину - кабінет
                header("Location: /cabinet");
            }
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Видаляємо дані про користувача з сесії
     */
    public function actionLogout()
    {   
        // Видаляємо інформацію про користувача з сесії
        unset($_SESSION["user"]);
        
        // Перенаправляємо користувача на головну сторінку
        header("Location: /");
    }

}
