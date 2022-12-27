<?php
require_once("./models/Todo.php");
session_start();
function printTodos($status)
{
    if (isset($_SESSION['todo-list'])) {
        $todos = $_SESSION['todo-list'];

        for ($i = 0; $i < count($todos); $i++) {
            if ($todos[$i]->status === $status) {
                $todoId = $todos[$i]->todoId;
                $body = $todos[$i]->body;
                $status = $todos[$i]->status;
                print "<div class='todo-item' postId=$todoId status=$status draggable=true>";
                print "<p class='todo-text'>";
                print $body;
                print "</p>";
                print "<div class='buttons-container'>";
                print "<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Edit_icon_%28the_Noun_Project_30184%29.svg/1024px-Edit_icon_%28the_Noun_Project_30184%29.svg.png' postId=$todoId status=$status class='update-todo-btn update-icon'>";
                print "<a href='./modules/deletePost.php?todoId=$todoId'><img class='delete-icon' src='https://icons.veryicon.com/png/o/commerce-shopping/read/delete-181.png'></a>";
                print "</div>";
                print "</div>";
            }
        }
    }
}
