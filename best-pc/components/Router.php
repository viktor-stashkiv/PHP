<?php

/**
 * Клас Router
 * Компонент для роботи з маршрутами
 */
class Router
{

    /**
     * Властивість для зберігання масиву Роутів
     * @var array 
     */
    private $routes;

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Шлях до файлу з Роутами
        $routesPath = ROOT . '/config/routes.php';

        // Отримуємо Раути з файлу
        $this->routes = include($routesPath);
    }

    /**
     * Повертає рядок запиту
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Метод для обробки запиту
     */
    public function run()
    {
        // Отримуємо рядок запиту
        $uri = $this->getURI();

        // Перевіряємо наявність такого запиту в масиві маршрутів (routes.php)
        foreach ($this->routes as $uriPattern => $path) {

            // Порівнюємо $uriPattern та $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Отримуємо внутрішній шлях із зовнішнього згідно з правилом.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Визначити контролер, action, параметри

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                // Підключити файл класу-контролера
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                

                // Об'єкт, який викликає метод (тобто action)
                $controllerObject = new $controllerName;

                /* Викликаємо необхідний метод ($actionName) у певного
                 * Класу ($controllerObject) з заданими ($parameters) параметрами
                 */
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                
                //Якщо метод контролера успішно викликаний, завершуємо роботу роутера
                
                if ($result != null) {
                    break;
                }
            
            }
        }
    }

}
