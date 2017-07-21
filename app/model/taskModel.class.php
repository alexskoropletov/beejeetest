<?php

namespace BeeJeeTest;

class TaskModel
{
    private $db;

    private $fields = [
        'id',
        'username',
        'email',
        'description',
        'image',
    ];

    public function __construct(\PDO $db)
    {
        return $this->db = $db;
    }

    public function getList($sort)
    {
        $result = [];
        $max = $this->getTotalTasks();
        if(empty($sort['sort_by']) || !in_array($sort['sort_by'], $this->fields)) {
            $sort['sort_by'] = 'id';
        }
        if(empty($sort['sort_order']) || !in_array(strtoupper($sort['sort_order']), ['ASC', 'DESC'])) {
            $sort['sort_order'] = 'ASC';
        }
        if(empty($sort['page']) || !(int)$sort['page'] || (int)$sort['page'] > ceil($max/$sort['on_page']) ) {
            $sort['page'] = 0;
        }
        $sort['start'] = $sort['on_page'];
        $sort['finish'] = $sort['on_page'];

        $this->db->prepare(
            'SELECT id, username, email, description, image FROM `task` ORDER BY :sort_by :sort_order LIMIT :start, :finish'
        );
        $this->db->execute($sort);

        return $result;
    }

    public function getTotalTasks()
    {
        return $this->db->query('SELECT COUNT(id) FROM `task`')->fetchColumn(); ;
    }
}