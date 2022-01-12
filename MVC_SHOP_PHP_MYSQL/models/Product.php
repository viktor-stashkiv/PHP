<?php

/**
 * Клас Product - модель для роботи з товарами
 */
class Product
{

    // Кількість відображуваних товарів за замовчуванням
    const SHOW_BY_DEFAULT = 6;

    /**
     * Повертає масив останніх товарів
      * @Param type $count [optional] Кількість 
      * @Param type $page [optional] Номер поточної сторінки 
      * @Return array Масив з товарами 
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status = "1" ORDER BY id DESC '
                . 'LIMIT :count';

        // Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // виконання команди
        $result->execute();

        // Отримання і повернення результатів
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Повертає список товарів у зазначеній категорії
      * @Param type $categoryId id категорії 
      * @Param type $page [optional] Номер сторінки 
      * @Return type Масив з товарами 
     */
    public static function getProductsListByCategory($categoryId, $page = 1)
    {
        $limit = Product::SHOW_BY_DEFAULT;
        // Зсув (для запиту)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status = 1 AND category_id = :category_id '
                . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

        // Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // виконання команди
        $result->execute();

        // Отримання і повернення результатів
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }

    /**
     * Повертає продукт із зазначеним id
      * @Param integer $id id товару 
      * @Return array Масив з інформацією про товар 
     */
    public static function getProductById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT * FROM product WHERE id = :id';

        // Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // виконання команди
        $result->execute();

        // Отримання і повернення результатів
        return $result->fetch();
    }

    /**
     * Повертаємо кількість товарів у зазначеній категорії
      * @Param integer $categoryId
      * @Return integer
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        // Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // виконання команди
        $result->execute();

        // Повертаємо значення count - кількість
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * овертає список товарів з зазначеними індентіфікторамі
      * @Param array $idsArray Масив з ідентифікаторами 
      * @Return array Масив зі списком товарів 
      */
    
    public static function getProdustsByIds($idsArray)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Перетворюємо масив в рядок для формування умови в запиті
        $idsString = implode(',', $idsArray);

        // Текст запиту до БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Отримання і повернення результатів
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    /**
     * Повертає список рекомендованих товарів
     * @Return array Масив з товарами 
     */
    public static function getRecommendedProducts()
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Отримання і повернення результатів
        $result = $db->query('SELECT id, name, price, is_new FROM product '
                . 'WHERE status = "1" AND is_recommended = "1" '
                . 'ORDER BY id DESC');
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Повертає список товарів
      * @Return array Масив з товарами 
     */
    public static function getProductsList()
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Отримання і повернення результатів
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Видаляє товар із зазначеним id
      * @Param integer $id id товару 
      * @Return boolean Результат виконання методу 
     */
    public static function deleteProductById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'DELETE FROM product WHERE id = :id';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагує товар із заданим id
      * @Param integer $id id товару 
      * @Param array $options Масив з інформацією про товар 
      * @Return boolean Результат виконання методу 
     */
    public static function updateProductById($id, $options)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Додає новий товар
      * @Param array $options Масив з інформацією про товар 
      * @Return integer id доданої в таблицю записи 
     */
    public static function createProduct($options)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Текст запиту до БД
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Якщо запит виконанню успішно, повертаємо id доданої записи
            return $db->lastInsertId();
        }
        // Інакше повертаємо 0
        return 0;
    }

    /**
     * Повертає текст пояснення наявності товару: 
      * 0 - Під замовлення, 1 - В наявності 
      * @Param integer $availability Статус 
      * @Return string Текст пояснення 
     */
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наявності';
                break;
            case '0':
                return 'Під замовлення';
                break;
        }
    }

    /**
     * Повертає шлях до зображення
      * @Param integer $id
      * @Return string Шлях до зображення 
     */
    public static function getImage($id)
    {
        // Назва зображення-пустушки
        $noImage = 'no-image.jpg';

        // Шлях до папки з товарами
        $path = '/upload/images/products/';

        // Шлях до зображення товару
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Якщо зображення для товара існує
            // Повертаємо шлях зображення товару
            return $pathToProductImage;
        }

        // Повертаємо шлях зображення
        return $path . $noImage;
    }

}
