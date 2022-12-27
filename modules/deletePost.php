<?php
require_once("../models/Todo.php");
session_start();

function deleteTodo()
{
    $todoId = $_REQUEST['todoId'];
    $todos = $_SESSION['todo-list'];
    $filteredTodos = [];
    for ($i = 0; $i < count($todos); $i++) {
        if ($todos[$i]->todoId !== $todoId) {
            array_push($filteredTodos, $todos[$i]);
        }
    }
    $_SESSION['todo-list'] = $filteredTodos;
}

deleteTodo();
header("Location: ../index.php");