<?php

/**
 * Контролер CabinetController
 * Кабінет користувача
 */
class CabinetController
{
    
    /**
     * Action для сторінки "Кабінет користувача"
     */
    public function actionIndex()
    {
        // Отримуємо ідентифікатор користувача з сесії
        $userId = User::checkLogged();

        // Отримуємо інформацію про користувача з БД
        $user = User::getUserById($userId);
        
         

        // Підключаємо вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для сторінки "Редагування даних користувача"
     */
    public function actionEdit()
    {
        // Отримуємо ідентифікатор користувача з сесії
        $userId = User::checkLogged();

        // Отримуємо інформацію про користувача з БД
        $user = User::getUserById($userId);

        // Заповнюємо змінні для полів форми
        $name = $user['name'];
        $password = $user['password'];

        // Прапор результату
        $result = false;

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми редагування
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Прапор помилок
            $errors = false;

            // Валідуємо значення
            if (!User::checkName($name)) {
                $errors[] = 'Ім\'я не повинно бути коротше 2-х символів';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не повинен бути коротше 6-ти символів';
            }

            if ($errors == false) {
                // Якщо помилок немає, зберігає зміни профілю
                $result = User::edit($userId, $name, $password);
            }
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }
    
    public function actionHistory()
    {
        // Отримуємо історію замовлень
         User::checkLogged();
        
        $getOrders = Order::getHistoryOrder();

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/history.php');
        return true; 
    }

}
