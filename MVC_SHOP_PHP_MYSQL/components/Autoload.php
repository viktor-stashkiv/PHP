<?php

/**
 * Функція spl_autoload_register для автоматичного підключення класів (__autoload)
 */

function my_autoload($class_name) {
    
        $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    // Проходимо по масиву папок
    foreach ($array_paths as $path) {

        // Формулюєм ім'я до файла з класом
        $path = ROOT . $path . $class_name . '.php';

        // Якщо такий файл існує, підключаємо його
        if (is_file($path)) {
            include_once $path;
        }
    }
    }
    spl_autoload_register("my_autoload");
