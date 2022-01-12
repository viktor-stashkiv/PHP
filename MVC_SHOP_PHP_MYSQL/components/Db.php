<?php
/**
 * Класс Db
 * Компонент для роботи з БД
 */
class Db
{
    /**
     * Встановлюємо з'єднання з БД
     * @return \PDO об'єкт класа PDO для работи з БД
     */
    public static function getConnection()
    {
        // Отримуємо параметри підключення із файла db_params.php
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        // Встановлюємо з'єднання 
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Задаємо кодування UTF-8 - кирилиця 
        $db->exec("set names utf8");

        return $db;
    }

}
