<?php

/**
 * Абстрактний клас AdminBase містить загальну логіку для контролерів, які
 * використовуються в панелі адміністратора
 */
abstract class AdminBase
{

    /**
     * Метод, який перевіряє користувача на те, чи є він адміністратором
     * @Return boolean
     */
    public static function checkAdmin()
    {
        // Перевіряємо чи авторизований користувач. Якщо ні, він буде переадресований
        $userId = User::checkLogged();

        // Отримуємо інформацію про поточного користувача
        $user = User::getUserById($userId);

        // Якщо роль поточного користувача "admin", пускаємо його в адмінпанель
        if ($user['role'] == 'admin') {
            return true;
        }

        // Інакше завершуємо роботу з повідомленням про закритий доступ
        die('Access denied');
    }

}
