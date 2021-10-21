<?php

/**
 * Контролер AdminProductController
 * Управління товарами в адмінпанелі
 */
class AdminProductController extends AdminBase
{

    /**
     * Action для сторінки "Управління товарами"
     */
    public function actionIndex()
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо список товарів
        $productsList = Product::getProductsList();

        // Підключаємо вид
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
     * Action для сторінки "Додати товар"
     */
    public function actionCreate()
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо список категорій для списку
        $categoriesList = Category::getCategoriesListAdmin();

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Прапор помилок у формі
            $errors = false;

            // При необхідності можна затверджувати значення потрібним способом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Якщо помилок немає
                // Додаємо новий товар
                $id = Product::createProduct($options);

                // Якщо запис додана
                if ($id) {
                    // Перевіримо, чи завантажилося через форму зображення
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Якщо завантажувалося, перемістимо його в потрібну папку, і дамо нове ім'я
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };

                // Перенаправляємо користувача на сторінку управліннями товарами
                header("Location: /admin/product");
            }
        }

        // Підключаємо вид
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action для сторінки "Редагувати товар"
     */
    public function actionUpdate($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо список категорій для списку
        $categoriesList = Category::getCategoriesListAdmin();

        // Отримуємо дані про конкретний замовленні
        $product = Product::getProductById($id);

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми редагування. При необхідності можна затверджувати значення
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // зберігаємо зміни
            if (Product::updateProductById($id, $options)) {


                // Якщо запис збережено
                // Перевіримо, завантажувалося чи через форму зображення
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                    // Якщо завантажувалося, перемістимо його в потрібну папку, дамо нове ім'я
                   move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }

            // Перенаправляємо користувача на сторінку управліннями товарами
            header("Location: /admin/product");
        }

        // Підключаємо вид
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

    /**
     * Action для сторінки "Видалити товар"
     */
    public function actionDelete($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Видаляємо товар
            Product::deleteProductById($id);

            // Перенаправляємо користувача на сторінку управліннями товарами
            header("Location: /admin/product");
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}
