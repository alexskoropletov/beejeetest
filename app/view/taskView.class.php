<?php
namespace BeeJeeTest;

use BeeJeeTest\TaskModel;

class TaskView
{
    public static $fields = [
        'id'          => '#',
        'username'    => 'Имя пользователя',
        'email'       => 'E-mail',
        'description' => 'Описание',
        'image'       => 'Картинка',
        'status'      => 'Статус',
    ];

    public static function addTask($sort, \PDO $db)
    {
        $model = new TaskModel($db);
        $errors = [];
        if ($_POST['add']) {
            $errors = $model->addTask();
            if (empty($errors)) {

            }
        }
        $content = self::getForm($errors);
        self::showPage($content);
    }

    public static function showList($sort, \PDO $db)
    {
        $model = new TaskModel($db);
        $list = $model->getList($sort);
        $content = self::getTable($list, $sort);
        self::showPage($content);
    }

    private static function getTable($list, $sort)
    {
        $result = ['<table class="table table-striped"><tr>'];
        foreach (self::$fields as $field => $name) {
            $result[] = sprintf(
                '<th>%s</th>',
                $name
            );
        }
        $result[] = '</tr>';
        foreach ($list as $item) {
            $result[] = '<tr>';
            foreach ($item as $value) {
                $result[] = sprintf('<td>%s</td>', $value);
            }
            $result[] = '</tr>';
        }
        $result[] = '</table>';

        return implode(PHP_EOL, $result);
    }

    private static function getForm($errors)
    {
        $result = implode(PHP_EOL, file(dirname(__FILE__) . "/../theme/edit.php"));
        $result = str_replace('[errors]', self::getErrors($errors), $result);

        return $result;
    }

    private static function getErrors($errors)
    {
        $result = [];
        foreach ($errors as $error) {
            $result[] = sprintf(
                '<div class="alert alert-danger" role="alert">%s</div>',
                $error
            );
        }

        return implode(PHP_EOL, $result);
    }

    private static function getPreview()
    {
        $result = implode(PHP_EOL, file(dirname(__FILE__) . "/../theme/edit.php"));

        return $result;
    }

    private static function showPage($content)
    {
        $page = file(dirname(__FILE__) . "/../theme/index.php");
        echo str_replace("[content]", $content, implode(PHP_EOL, $page));
        exit;
    }
}