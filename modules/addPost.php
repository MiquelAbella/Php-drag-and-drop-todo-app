<?php

require_once('../models/Todo.php');

$todoBody = $_REQUEST['todo-body'];
$todoStatus = $_REQUEST['todo-status'];

$newTodo = new Todo($todoBody, uniqid(rand(), true), $todoStatus);

session_start();

if (!isset($_SESSION['todo-list'])) {
    $_SESSION['todo-list'] = array();
}
array_push($_SESSION['todo-list'], $newTodo);

header("Location: ../index.php");
