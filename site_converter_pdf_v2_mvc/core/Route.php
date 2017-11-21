<?php

namespace core;

/**
 * Route - класс маршрутизатора для работы с запросами.
 */
class Route
{
    /**
     * Запуск маршрутизатора.
     */
    public static function start()
    {
        // Установка контроллера и действия по умолчанию:
        $controllerName = 'MainController';
        $actionName = 'actionIndex';
        $parameters = '';

        // Получение массива из компонентов запроса:
        $routes = $_SERVER['REQUEST_URI'];
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        array_pop($scriptName);
        $webName = implode('/', $scriptName);
        $routes = str_replace($webName, '', $routes);
        $routes = explode('/', $routes);
        array_shift($routes);

        // Получение контроллера:
        if (!empty($routes[0])) {
            $controllerName = $routes[0];
        }

        // Получение действия:
        if (!empty($routes[1])) {
            $actionName = $routes[1];
        }

        // Получение параметров:
        if (!empty($routes[2])) {
            $parameters = $routes[2];
        }

        // Определение имен модели, контроллера и действия:
        $modelName = ucfirst($controllerName);
        $controllerName = ucfirst($controllerName).'Controller';
        $actionName = 'action'.ucfirst($actionName);

        // Подключение файла с классом модели:
        $modelFile = $modelName.'.php';
        $modelPath = "../models/".$modelFile;
        if (file_exists($modelPath)) {
            // Модель существует:
            // действия с моделью
        }

        // Подключение файла с классом контроллера:
        $controllerFile = $controllerName.'.php';
        $controllerPath = "../controllers/".$controllerFile;
        if (file_exists($controllerPath)) {
            // Контроллер существует:

            // Создание объекта контроллера:
            $controllerClassName = 'controllers\\'.$controllerName;
            $controller = new $controllerClassName();

            // Проверка существования действия:
            if (method_exists($controller, $actionName)) {
                // Действие существует.
                // Вызов действия контроллера:
                $controller->$actionName($parameters);
            } else {
                // Действие не существует:
                $controller->actionIndex();
            }
        } else {
            // Контроллер не существует:
            $controllerClassName = 'controllers\\'.'MainController';
            $controller = new $controllerClassName();
            $controller->actionIndex();
        }
    }
}
