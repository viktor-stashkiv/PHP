<?php

/**
 * Клас Order - модель для роботи з замовленнями
 */
class Order
{

    /**
     * збереження замовлення
      * @Param string $userName Ім'я 
      * @Param string $userPhone Телефон
      * @Param string $userComment Коментар 
      * @Param integer $userId id користувача 
      * @Param array $products Масив з товарами 
      * @Return boolean Результат виконання методу
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $products = json_encode($products);

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Повертає список замовлень
     * @Return array Список замовлень 
     */
    public static function getOrdersList()
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Отримання і повернення результатів
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    /**
     * Повертає текст пояснення статусу для замовлення: 
      * 1 - Нове замовлення, 2 - В обробці, 3 - Доставляється, 4 - Закрито 
      * @Param integer $status Статус 
      * @Return string Текст пояснення 
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Нове замовлення';
                break;
            case '2':
                return 'В обробці';
                break;
            case '3':
                return 'Доставляється';
                break;
            case '4':
                return 'Закрите';
                break;
        }
    }

    /**
     * Повертає замовлення із зазначеним id
      * @Param integer $id id 
      * @Return array Масив з інформацією про замовлення 
     */
    public static function getOrderById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Виконуємо запит
        $result->execute();

        // Повертаємо дані
        return $result->fetch();
    }
    
     public static function getHistoryOrder()
    {
        $user_id = User::get_id_user(); 
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT * FROM product_order WHERE user_id = :user_id';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Виконуємо запит
        $result->execute();
         
        $getOrders = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $getOrders[$i]['id'] = $row['id'];
            $getOrders[$i]['user_name'] = $row['user_name'];
            $getOrders[$i]['user_phone'] = $row['user_phone'];
            $getOrders[$i]['date'] = $row['date'];
            $getOrders[$i]['user_comment'] = $row['user_comment'];
            $getOrders[$i]['status'] = $row['status'];
            $i++;
        }
        return $getOrders;
    }

    /**
     * Видаляє замовлення з заданим id
      * @Param integer $id id замовлення 
      * @Return boolean Результат виконання методу 
     */
    public static function deleteOrderById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'DELETE FROM product_order WHERE id = :id';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагує замовлення з заданим id
      * @Param integer $id <id товару 
      * @Param string $userName Ім'я клієнта 
      * @Param string $userPhone Телефон клієнта 
      * @Param string $userComment Коментар клієнта 
      * @Param string $date Дата оформлення 
      * @Param integer $status Статус (включено "1", вимкнено "0")
      * @Return boolean Результат виконання методу 
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
