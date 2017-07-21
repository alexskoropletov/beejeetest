<?php
namespace BeeJeeTest;

use BeeJeeTest\App;

/**
 * Loading config
 */
$config = require dirname(__FILE__) . "/config.php";


/**
 * Loading app
 */
spl_autoload_register(function ($class) {
    $class = lcfirst(str_replace("BeeJeeTest\\", "", $class));

    if (strstr($class, 'Model') != false) {
        $class = 'model/' . $class;
    } elseif (strstr($class, 'View') != false) {
        $class = 'view/' . $class;
    } elseif (strstr($class, 'Controller') != false) {
        $class = 'controller/' . $class;
    }

    require sprintf(dirname(__FILE__) . '/%s.class.php', $class);
});

$App = new App($config);
