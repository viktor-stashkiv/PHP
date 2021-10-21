<?php

/**
 * Контролер CatalogController
 * Каталог товарів
 */
class CatalogController
{

    /**
     * Action для сторінки "Каталог товарів"
     */
    public function actionIndex()
    {
        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        // Список останніх товарів 
        $latestProducts = Product::getLatestProducts(12);

        // Підключаємо вид
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для сторінки "Категорія товарів"
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // Список категорій для лівого меню
        $categories = Category::getCategoriesList();

        // Список товарів в категорії
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // Загальна кількість товарів (необхідно для посторінкового навігації)
        $total = Product::getTotalProductsInCategory($categoryId);

        // Створюємо об'єкт Pagination - посторінкова навігація
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Підключаємо вигляд
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
