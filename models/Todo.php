<?php 
class Todo {
    public $body;
    public $todoId;
    public $status;

    function __construct($body, $todoId, $status)
    {
        $this->body = $body;
        $this->todoId = $todoId;
        $this->status = $status;
    }
}
