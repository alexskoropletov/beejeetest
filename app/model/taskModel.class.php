<?php

namespace BeeJeeTest;

class TaskModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        return $this->db = $db;
    }

    public function getList($sort)
    {
        $max = $this->getTotalTasks();
        if (empty($sort['sort_by']) || !in_array($sort['sort_by'], array_keys(\BeeJeeTest\TaskView::$fields))) {
            $sort['sort_by'] = 'id';
        }
        if (empty($sort['sort_order']) || !in_array(strtoupper($sort['sort_order']), ['ASC', 'DESC'])) {
            $sort['sort_order'] = 'ASC';
        }
        if (empty($sort['page']) || !(int)$sort['page'] || (int)$sort['page'] > ceil($max / $sort['on_page'])) {
            $sort['page'] = 1;
        }

        $query = $this->db->prepare(
            sprintf(
                'SELECT id, username, email, description, image, status FROM `task` ORDER BY %s %s LIMIT :start, :finish',
                $sort['sort_by'],
                $sort['sort_order']
            )
        );
        $query->bindValue(":start", ($sort['page'] - 1) * $sort['on_page'], \PDO::PARAM_INT);
        $query->bindValue(":finish", $sort['page'] * $sort['on_page'], \PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalTasks()
    {
        return $this->db->query('SELECT COUNT(id) FROM `task`')->fetchColumn();
    }

    public function addTask()
    {
        $result = [];
        $fields = \BeeJeeTest\TaskView::$fields;
        $query = $this->db->prepare(
            'INSERT INTO `task` (username, email, description, image, status) 
            VALUES(:username, :email, :description, :image, 0)'
        );
        foreach ($_POST as $key => $value) {
            if (in_array($key, array_keys($fields))) {
                if (!empty(trim($value))) {
                    $query->bindValue(":" . $key, trim($this->db->quote(trim(htmlspecialchars($value))), "'"));
                } else {
                    $result[] = sprintf("Поле <b>%s</b> обязательно для заполения", $fields[$key]);
                }
            }
        }
        $query->bindValue(":image", '');
        $query->execute();

        return $result;
    }
}