<?php

/**
 * Контролер AdminController
 * Головна сторінка в адмінпанелі
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартової сторінки "Панель адміністратора"
     */
    public function actionIndex()
    {
        // Перевірка доступу
        self::checkAdmin();

        // Підключаємо вигляд
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
