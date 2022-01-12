<?php

/**
 * Контролер ProductController
 * Товар
 */
class ProductController
{

    /**
     * Action для сторінки перегляду товару
     * @Param integer $productId id товару 
     */
    public function actionView($productId)
    {
        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        // Отримуємо інфомрацію про товар
        $product = Product::getProductById($productId);

        // Підключаємо вигляд
        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}
