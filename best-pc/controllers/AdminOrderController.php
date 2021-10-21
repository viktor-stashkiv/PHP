<?php

/**
 * Контролер AdminOrderController
 * Управління замовленнями в адмінпанелі
 */
class AdminOrderController extends AdminBase
{

    /**
     * Action для сторінки "Управління замовленнями"
     */
    public function actionIndex()
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо список замовлень
        $ordersList = Order::getOrdersList();

        // Підключаємо вид
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    /**
     * Action для сторінки "Редагування замовлення"
     */
    public function actionUpdate($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо дані про конкретний замовленні
        $order = Order::getOrderById($id);

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Если форма отправлена   
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Зберігаємо зміни
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            // Перенаправляємо користувача на сторінку управліннями замовленнями
            header("Location: /admin/order/view/$id");
        }

        // Підключаємо вид
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    /**
     * Action для сторінки "Перегляд замовлення"
     */
    public function actionView($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Отримуємо дані про конкретний замовленні
        $order = Order::getOrderById($id);

        // Отримуємо масив з ідентифікаторами і кількістю товарів
        $productsQuantity = json_decode($order['products'], true);

        // Отримуємо масив з ідентифікатори товару
        $productsIds = array_keys($productsQuantity);

        // Отримуємо список товарів в замовленні
        $products = Product::getProdustsByIds($productsIds);

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action для сторінки "Видалити замовлення"
     */
    public function actionDelete($id)
    {
        // Перевірка доступу
        self::checkAdmin();

        // Обробка форми
        if (isset($_POST['submit'])) {
            // Якщо форма відправлена
            // Видаляємо замовлення
            Order::deleteOrderById($id);

            // Перенаправляємо користувача на сторінку управліннями товарами
            header("Location: /admin/order");
        }

        // Підключаємо вигляд
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

}
