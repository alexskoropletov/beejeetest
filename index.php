<?php
error_reporting(E_ALL);

require_once "app/bootstrap.php";

$App->run($_GET['q']);
