<?php

/**
 * Контролер SearchController
 */
class SearchController
{
    /**
     * Action для сторінки "Пошук"
     */
    public function actionIndex()
    {
        
    $categories = Category::getCategoriesList();
    
     if($_SERVER['REQUEST_METHOD'] == 'POST') {
         $srch = $_POST['search'];
         $getPoisk = Search::getSearch($srch);
     }
        // Підключаємо вигляд
        require_once(ROOT . '/views/search/index.php');
        return true;
    }
}
