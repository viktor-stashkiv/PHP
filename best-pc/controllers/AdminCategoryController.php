<?php

/**
 * Контролер AdminCategoryController
  * Управління категоріями товарів в адмінпанелі
 */
class AdminCategoryController extends AdminBase
{

    /**
     * Action для сторінки "Управління категоріями"
     */
    public function actionIndex()
    {
        // Провірка доступу
        self::checkAdmin();

        // Отримуєм список категорій
        $categoriesList = Category::getCategoriesListAdmin();

        // Подключаєм вигляд
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    /**
     * Action для сторінки "Додати категорію"
     */
    public function actionCreate()
    {
        // Перевірка доступу
        self::checkAdmin();

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані із форми
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Прапор помилок у формі
            $errors = false;

            // При необхідності можна затверджувати значення потрібним способом
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заповніть поля';
            }


            if ($errors == false) {
                // Якщо помилок немає
                // Добавлення нової категорії
                Category::createCategory($name, $sortOrder, $status);

                //Перенаправляємо користувача на сторінку управліннями категоріями
                header("Location: /admin/category");
            }
        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    /**
     * Action для сторінки "Редагувати категорію"
     */
    public function actionUpdate($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо дані про конкретну категорії
        $category = Category::getCategoryById($id);

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена   
            // Отримуємо дані із форми
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Зберігаєм зміни
            Category::updateCategoryById($id, $name, $sortOrder, $status);

            // Перенаправляємо користувача на сторінку управліннями категоріями
            header("Location: /admin/category");
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

    /**
     * Action для сторінки "Видалити категорію"
     */
    public function actionDelete($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена 
            // Видаляємо категорію
            Category::deleteCategoryById($id);

            // Перенаправляємо користувача на сторінку управліннями товарами
            header("Location: /admin/category");
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }

}
