<?php

/**
 * Клас Search - модель для роботи з користувачами
 */
class Search
{

    /**
     * Пошук продуктів
     */
    public static function getSearch($search_n)
    {
        $search_name = $search_n; 
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT id, name, price, is_new FROM product WHERE name LIKE :name';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $search_name, PDO::PARAM_STR);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Виконуємо запит
        $result->execute();
         
        $getOrders = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $getOrders[$i]['id'] = $row['id'];
            $getOrders[$i]['name'] = $row['name'];
            $getOrders[$i]['price'] = $row['price'];
            $getOrders[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $getOrders;
    }
}

