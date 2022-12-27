<?php
require_once('./modules/getPosts.php');
require_once('./models/Todo.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos app - Main</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css?<?php echo time(); ?>">
</head>

<body>
    <img src="https://www.nicepng.com/png/full/251-2519428_0-add-icon-white-png.png" class="add-todo-btn" />
    <!-- addTodo form -->
    <form class="add-todo-form hidden" action="./modules/addPost.php" method="POST">
        <p class="close-btn">X</p>
        <p>ADD TODO</p>
        <textarea name="todo-body" maxlength="30" required></textarea>
        <fieldset>
            <legend>Staus</legend>
            <label for="pending">Pending</label>
            <input type="radio" name="todo-status" value="pending" id="pending" checked>
            <label for="in-progress">In progress</label>
            <input type="radio" name="todo-status" value="in-progress" id="in-progress">
            <label for="finished">Finished</label>
            <input type="radio" name="todo-status" value="finished" id="finished">
        </fieldset>
        <button type="submit">Add</button>
    </form>
    <!-- addTodo form -->
    <!-- updateTodo form -->
    <form class="update-todo-form hidden" action="./modules/updatePost.php" method="POST">
        <p class="close-btn">X</p>
        <p>EDIT TODO</p>
        <textarea name="todo-body" maxlength="30" required></textarea>
        <button type="submit">Update</button>
    </form>
    <!-- updateTodo form -->
    <section class="app-container">
        <div class="todos-group">
            <h2>Pending</h2>
            <div class="todos-container" status="pending">
                <?php
                printTodos('pending');
                ?>
            </div>
        </div>
        <div class="todos-group">
            <h2>In progress</h2>
            <div class="todos-container" status="in-progress">
                <?php
                printTodos('in-progress');
                ?>
            </div>
        </div>
        <div class="todos-group">
            <h2>Completed</h2>
            <div class="todos-container" status="finished">
                <?php
                printTodos('finished');
                ?>
            </div>
        </div>
    </section>
</body>

</html>

<script>
    const openAddForm = document.querySelector('.add-todo-btn')
    const addForm = document.querySelector('.add-todo-form')
    const openUpdateForm = document.querySelectorAll('.update-todo-btn')
    const updateForm = document.querySelector('.update-todo-form')
    const closeBtns = document.querySelectorAll('.close-btn')

    const toggleAddFormVisibility = () => {
        addForm.classList.toggle('hidden')
    }
    const toggleUpdateFormVisibility = (e) => {
        let postId = e.target.getAttribute('postId')
        let status = e.target.getAttribute('status')
        updateForm.action = `./modules/updatePost.php?todoId=${postId}&status=${status}`
        updateForm.classList.toggle('hidden')
    }

    const closeForms = () => {
        addForm.classList.add('hidden')
        updateForm.classList.add('hidden')
    }

    openAddForm.addEventListener('click', toggleAddFormVisibility)

    for (let btn of openUpdateForm) {
        btn.addEventListener('click', toggleUpdateFormVisibility)
    }
    for (let btn of closeBtns) {
        btn.addEventListener('click', closeForms)
    }

    // draganddrop
    const items = document.querySelectorAll('.todo-item')
    const columns = document.querySelectorAll('.todos-container')

    items.forEach(item => {
        item.addEventListener('dragstart', dragStart)
    });

    function dragStart(e) {
        e.dataTransfer.setData("postId", e.target.getAttribute('postId'));
        // e.dataTransfer.setData("status", e.target.getAttribute('status'));
        e.dataTransfer.setData("body", e.target.firstChild.textContent);
    }

    columns.forEach(column => {
        column.addEventListener('dragenter', dragEnter);
        column.addEventListener('dragover', (e) => e.preventDefault());
        column.addEventListener('dragleave', dragLeave);
        column.addEventListener('drop', dragDrop);
    });

    function dragEnter(e) {
        if (e.target.classList[0] === "todos-container") {
            e.target.style.backgroundColor = 'rgb(60, 60, 60)';
            e.target.style.border = '1px dashed rgba(255, 255, 255, 0.5)';
        }
    }

    function dragLeave(e) {
        if (e.target.classList[0] === "todos-container") {
            e.target.style.backgroundColor = 'rgb(50, 50, 50)';
            e.target.style.border = '1px solid transparent';
        }
    }

    function dragDrop(e) {
        let status = e.target.getAttribute('status');
        let postId = e.dataTransfer.getData("postId");
        console.log(e.target.classList[0])
        let body = e.dataTransfer.getData("body");
        if (e.target.classList[0] === "todos-container") {
            window.location.href = `./modules/updatePost.php?todoId=${postId}&todo-body=${body}&status=${status}`;
        }
    }
    // draganddrop
</script>