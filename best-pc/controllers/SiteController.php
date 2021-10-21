<?php

/**
 * Контролер CartController
 */
class SiteController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        // Список останніх товарів
        $latestProducts = Product::getLatestProducts(9);

        // Список товарів для слайдера
        $sliderProducts = Product::getRecommendedProducts();

        // Підключаємо вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action для сторінки "Контакти"
     */
    public function actionContact()
    {

        // Змінні для форми
        $userEmail = false;
        $userText = false;
        $result = false;

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані з форми
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // Прапор помилок
            $errors = false;

            // Валідація полів
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {
                // Якщо помилок немає
                // Відправляємо лист адміністратору
                $adminEmail = 'stashkiv77@gmail.com';
                $message = "Текст: {$userText}. Від {$userEmail}";
                $subject = 'Тема повідомлення:';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
    
    /**
     * Action для сторінки "Про магазин"
     */
    public function actionAbout()
    {
        // Підключаємо вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}
