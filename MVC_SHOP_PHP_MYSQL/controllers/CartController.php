<?php

/**
 * Контролер CartController
 * Кошик
 */
class CartController
{

    /**
     * Action для додавання товару в корзину синхронним запитом 
      * @Param integer $id id товару 
     */
    public function actionAdd($id)
    {
        // Додаємо товар в корзину
        Cart::addProduct($id);

        // Повертаємо користувача на сторінку з якої він прийшов
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    /**
     * Action для додавання товару в кошик за допомогою асинхронного запиту (ajax)
     * @Param integer $id id товару 
     */
    public function actionAddAjax($id)
    {
        // Додаємо товар в корзину і друкуємо результат: кількість товарів в кошику
        echo Cart::addProduct($id);
        return true;
    }
    
    /**
     * Action для додавання товару в корзину синхронним запитом
     * @Param integer $id <id товару 
     */
    public function actionDelete($id)
    {
        // Видаляємо заданий товар з кошика
        Cart::deleteProduct($id);

        // Повертаємо користувача в кошик
        header("Location: /cart");
    }

    /**
     * Action для сторінки "Кошик"
     */
    public function actionIndex()
    {
        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        // Отримаємо ідентифікатори і кількість товарів в кошику
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Якщо в кошику є товари, отримуємо повну інформацію про товари для списку
            // Отримуємо масив тільки з ідентифікаторами товарів
            $productsIds = array_keys($productsInCart);

            // Отримуємо масив з повною інформацією про необхідні товари
            $products = Product::getProdustsByIds($productsIds);

            // Отримуємо загальну вартість товарів
            $totalPrice = Cart::getTotalPrice($products);
        }

        // Підключаємо вид
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    /**
     * Action для сторінки "Оформлення покупки"
     */
    public function actionCheckout()
    {
        // Отримати дані з кошика      
        $productsInCart = Cart::getProducts();

        // Якщо товарів немає, відправляємо користувачі шукати товари на головну
        if ($productsInCart == false) {
            header("Location: /");
        }

        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        // Знаходимо загальну суму
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        // Кількість товарів
        $totalQuantity = Cart::countItems();

        // Поля для форми
        $userName = false;
        $userPhone = false;
        $userComment = false;

        // Статус успішного оформлення замовлення
        $result = false;

        // Перевіряємо чи є користувач гостем
        if (!User::isGuest()) {
            // Якщо користувач не гість
            // Отримуємо інформацію про користувача з БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            // Если гість, поля форми залішаються порожніми
            $userId = false;
        }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Отримуємо дані із форми
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Прапор помилок
            $errors = false;

            // Валідація полів
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное ім\'я';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильний номер телефону';
            }


            if ($errors == false) {
                // Якщо помилок немає
                // Зберігаємо замовлення в базі даних
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Якщо замовлення успішно збережений
                    // Оповіщаємо адміністратора про нове замовлення поштою               
                    $adminEmail = 'stashkiv77@gmail.com';
                    $message = '<a href="http://best-pc.zzz.com.ua/admin/orders">Список замовлень</a>';
                    $subject = 'Нове замовлення!';
                    mail($adminEmail, $subject, $message);

                    // Очищуєм кошик
                    Cart::clear();
                }
            }
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

}
