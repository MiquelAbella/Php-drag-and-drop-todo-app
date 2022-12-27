<?php 
class User {
    public $username;
    public $userId;
    public $todoList;
    
    function __construct($username, $userId, $todoList)
    {
     $this->username = $username;
     $this->userId = $userId;
     $this->todoList = $todoList;
    }
 
    function get_todos(){
     return $this->todoList;
    }
 }
