<?php
namespace BeeJeeTest;

use BeeJeeTest\RoutesController;
use BeeJeeTest\TaskView;

/**
 * Class App
 * @package BeeJeeTest
 */
class App
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var \BeeJeeTest\RoutesController
     */
    private $router;

    /**
     * @var \PDO
     */
    private $db;

    public function __construct(array $config)
    {
        $this->config = $config;
        $dsn = sprintf(
            "mysql:host=%s;dbname=%s;charset=%s",
            $config['db']['host'],
            $config['db']['database'],
            $config['db']['charset']
        );
        try {
            $this->db = new \PDO(
                $dsn,
                $config['db']['user'],
                $config['db']['password']
            );
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
        $this->router = new RoutesController($config['routes']);
    }

    public function run($q = '')
    {
        $this->router->run($q, $this->db, $this->config);
    }
}