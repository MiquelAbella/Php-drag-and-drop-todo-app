<?php
require_once('../models/Todo.php');
session_start();


function updateTodo()
{
    $postId = $_REQUEST['todoId'];
    $body = $_REQUEST['todo-body'];
    $status = $_REQUEST['status'];

    $todos = $_SESSION['todo-list'];

    for ($i = 0; $i < count($todos); $i++) {
        if ($todos[$i]->todoId === $postId) {
            $todos[$i]->body = $body;
            $todos[$i]->status = $status;
        }
    }
}

updateTodo();
header("Location: ../index.php");
