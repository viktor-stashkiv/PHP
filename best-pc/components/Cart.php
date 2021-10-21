<?php

/*
 * Клас Cart
 * Компонент для роботи з кошиком
 */
class Cart
{

    /**
     * Додавання товару в кошик (сесію)
      * @Param int $id id товару 
      * @Return integer Кількість товарів у кошику
     */
    public static function addProduct($id)
    {
        // Приводим $id до типу integer
        $id = intval($id);

        // Порожній масив для товарів в кошику
        $productsInCart = array();

        // Якщо в кошику вже є товари (вони зберігаються в сесії)
        if (isset($_SESSION['products'])) {
            //Заповнимо наш масив товарами
            $productsInCart = $_SESSION['products'];
        }

         // Перевіряємо чи є вже такий товар в кошику
        if (array_key_exists($id, $productsInCart)) 
        {
            // Якщо такий товар є в кошику, але був доданий ще раз, збільшимо кількість на 1
            $productsInCart[$id] ++;
        } else {
            // Якщо немає, додаємо id нового товару в корзину з кількістю 1
            $productsInCart[$id] = 1;
        }

        // Записуємо масив з товарами в сесію
        $_SESSION['products'] = $productsInCart;

        // Повертаємо кількість товарів в кошику
        return self::countItems();
    }

    /**
     * Підрахунок кількість товарів в кошику (в сесії)
     * @Return int Кількість товарів у кошику
     */
    public static function countItems()
    {
        // Перевірка наявності товарів в кошику
        if (isset($_SESSION['products'])) {
            // Якщо масив з товарами є
            // Підрахуємо і повернемо їх кількість
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            // Якщо товарів немає, повернемо 0
            return 0;
        }
    }

    /**
     * Повертає масив з ідентифікаторами і кількістю товарів в кошику 
     * Якщо товарів немає, повертаємо false;
     * @Return mixed: boolean or array
     */
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Отримуємо загальну вартість переданих товарів
     * @Param array $ products масив з інформацією про товари
     * @Return integer загальна вартість
     */
    public static function getTotalPrice($products)
    {
        // Отримуємо масив з ідентифікаторами і кількістю товарів в кошику
        $productsInCart = self::getProducts();

        // Підраховуємо загальну вартість
        $total = 0;
        if ($productsInCart) {
            // Якщо в кошику не порожньо
            // Проходимо по переданому в метод масиву товарів
            foreach ($products as $item) {
                // Знаходімо Загальну ВАРТІСТЬ: ціна товару * Кількість товару
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }


    /**
     *  Очищуємо кошик
     */
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    /**
     * Видаляє товар із зазначеним id з кошика
      * @Param integer $id id товару
     */
    public static function deleteProduct($id)
    {
        // Отримуємо масив з ідентифікаторами і кількістю товарів в кошику
        $productsInCart = self::getProducts();

        // Видаляємо з масиву елемент із зазначеним id
        unset($productsInCart[$id]);

        // Записуємо масив товарів з віддаленим елементом в сесію
        $_SESSION['products'] = $productsInCart;
    }

}
