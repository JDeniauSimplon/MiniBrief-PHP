<?php
require './src/task/ManagerTask.php';

$managerTask = new ManagerTask();
$allTasks = $managerTask->getAllTasks();

if (!empty($_POST['title']) && isset($_POST['description'])) {
    $newTask = new Task();

    $newTask->setTitle($_POST['title']);
    $newTask->setDescription($_POST['description']);
    $newTask->setImportant(isset($_POST['important']) ? 1 : 0);

    $managerTask->create($newTask);
}

// Gère la suppression
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $managerTask->delete(intval($_GET['delete']));
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/task/task.css">
    <title>TodoList</title>
</head>
<body>
    <section class="page">
        <form method="POST" action="">
           <h1>Task</h1>
           <div class="séparation">
            <div class="corps-formulaire">
                <div class="contenu">
                    <div class="boite">
                        <label for="title">Title</label>
                        <input type="text" name="title" maxlength="50">
                    </div>
                    <div class="boite">
                        <label for="description">Description</label>
                        <input type="text" name="description" maxlength="500">
                    </div>
                    <div class="boite">
                        <label for="important">Important</label>
                        <input type="checkbox" name="important">
                    </div>
                </div>
            </div>
           </div>
           <div class="button">
          <button type="submit">Add new task</button>
        </div>
        </form>
   

    <div class="tab">
          <table> 
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Important</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($allTasks as $task) { ?>
  <tr>
    <td class="title"><?php echo $task->getTitle(); ?></td>
    <td class="description"><?php echo $task->getDescription(); ?></td>
    <td>
    <?php if ($task->getImportant()) { ?>
        &#9745;
    <?php } else { ?>
        &#9744;
    <?php } ?>
</td>
    <td><a href="index.php?delete=<?php echo $task->getId(); ?>" class="trash" data-task-id="<?php echo $task->getId(); ?>"></a></td>
  </tr>
<?php } ?>
            </tbody>
          </table>
        </div>
        </section>
</body>


</html>
