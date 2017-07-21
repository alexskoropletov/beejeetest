<?php
namespace BeeJeeTest;

use BeeJeeTest\TaskView;

class RoutesController
{
    private $routes;

    public function __construct($config = [])
    {
        $this->routes = $config;
    }

    /**
     * Парсим строку запроса и выделяем адрес и параметры сортировки
     * @param $route string строка запроса
     * @return array
     */
    private function parseRoute($route)
    {
        // делим строку запроса по /
        // первый аргумент - путь
        // второй агрумент - поле для сортировки
        // третий аргумент - порядок сортировки
        // четвертый аргумент - страница
        // остальные игнорируются
        @list($route, $sort_by, $sort_order, $page) = explode("/", ltrim($route, "/"));

        return compact('route', 'sort_by', 'sort_order', 'page');
    }

    public function routeExists($route)
    {
        $result = false;
        // если в конфиге существует путь
        if (!empty($this->routes[$route])) {
            // возвращаем параметры
            $result = $this->routes[$route];
        }

        return $result;
    }

    public function run($route, $db, $config)
    {
        $route = $this->parseRoute($route);
        $route['on_page'] = $config['list']['on_page'];
        if ($run = $this->routeExists($route['route'])) {
            $run($route, $db);
        } else {
            throw new \Exception('404 Page not found');
        }
    }
}