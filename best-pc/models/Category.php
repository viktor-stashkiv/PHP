<?php

/**
 * Клас Category - модель для роботи з категоріями товарів
 */
class Category
{

    /**
     * Повертає масив категорій для списку на сайті
      * @Return array масив з категоріями 
      */
    public static function getCategoriesList()
    {
        // З'єднання БД
        $db = Db::getConnection();

        // Запит до БД
        $result = $db->query('SELECT id, name FROM category WHERE status = "1" ORDER BY sort_order, name ASC');

        // Отримання і повернення результатів
        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Повертає масив категорій для списку в адмінпанелі 
      * (При цьому в результат потрапляють і включені і вимкнені категорії)
      * @Return array масив категорій
      */
    public static function getCategoriesListAdmin()
    {
        // З'єднання БД
        $db = Db::getConnection();

        // Запит до БД
        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');

        // Отримання і повернення результатів
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Видаляє категорії по id
     * @param integer $id
     * @return boolean результат виконання метода
     */
    public static function deleteCategoryById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Запит до БД
        $sql = 'DELETE FROM category WHERE id = :id';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редагування категорії з заданим id
      * @Param integer $ id id категорії <
      * @Param string $ name Назва 
      * @Param integer $ sortOrder Порядковий номер 
      * @Param integer $ status Статус (включено "1", вимкнено "0") 
      * @Return boolean Результат виконання методу 
      */
    public static function updateCategoryById($id, $name, $sortOrder, $status)
    {
        // З'єнання з БД
        $db = Db::getConnection();

        // Запит до БД
        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Повертає категорію з зазначеним id
      * @Param integer $id id категорії 
      * @Return array Масив з інформацією про категорії 
      */
    public static function getCategoryById($id)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Запит до БД
        $sql = 'SELECT * FROM category WHERE id = :id';

        // Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Зазначаємо, що хочемо отримати дані у вигляді масиву
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Виконуємо запит
        $result->execute();

        // Повертаєм дані
        return $result->fetch();
    }

    /**
     * Повертає текст пояснення статусу для категорії: 
      * 0 - Таємниця, 1 - Відображається 
      * @Param integer $status Статус 
      * @Return string Текст пояснення 
      */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Відображається';
                break;
            case '0':
                return 'Сховано';
                break;
        }
    }

    /**
     * Додати нову категорію
      * @Param string $name Назва 
      * @Param integer $sortOrder Порядковий номер 
      * @Param integer $status Статус (включено "1", вимкнено "0") 
      * @Return boolean Результат додавання запису в таблицю 
      */
    public static function createCategory($name, $sortOrder, $status)
    {
        // З'єднання з БД
        $db = Db::getConnection();

        // Запит до БД
        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';

        // Отримання і повернення результатів. Використовується підготовлений запит
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
