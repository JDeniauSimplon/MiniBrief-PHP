<?php 

require_once ('./src/DBManager.php');
require('TaskClass.php');

class ManagerTask extends DBManager {

    public function getAllTasks() {
        $res = $this->getConnexion()->query('SELECT * from task Order by task.id ASC');

        $tasks = [];

        foreach($res as $task) {
          $newTask = new Task();
          $newTask->setTitle($task['title']);
          $newTask->setDescription($task['description']);
          $newTask->setImportant($task['important']);
          $newTask->setId($task['id']);

          $tasks[] = $newTask;
        }
        return $tasks;
    }
    public function create($task) {
    $request = 'INSERT INTO task (title, description, important) VALUE (?, ?, ?)';
    $query = $this->getConnexion()->prepare($request);

    $query->execute([
        $task->getTitle(), $task->getDescription(), $task->getImportant()
    ]);

    // Rafraichie la page
    header('Refresh:0');
  }
  
  public function findById($taskId) {
    $request = 'SELECT * FROM task WHERE id = :id';
    $query = $this->getConnexion()->prepare($request);
    $query->execute([':id' => $taskId]);
    $row = $query->fetch();

    if ($row) {
        $task = new Task();
        $task->setId($row['id']);
        $task->setTitle($row['title']);
        $task->setDescription($row['description']);
        $task->setImportant($row['important']);
        return $task;
    }

    return null;
}


public function delete($taskId) {
  if (is_numeric($taskId)) {
      $taskToDelete = $this->findById((int)$taskId);

      if ($taskToDelete) {
          $request = 'DELETE FROM task WHERE id = ' . $taskId;
          $query = $this->getConnexion()->prepare($request);
          $query->execute();

          header('Location: index.php');
          exit();
      }
  }
}

}
   
?>