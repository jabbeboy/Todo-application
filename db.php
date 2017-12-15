<?php

require('conf.php');

class Database
{
    private $db;

    // Connection status
    private $conn_status = false;

    function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            $options  = array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            );
            // Creates a new PDO database connection
            $this->db = new PDO(DSN, DB_USER, DB_PASS, $options);

            $init = file_get_contents(DB_INIT_FILE);
            $this->db->exec($init);

            // Connection successful
            $this->conn_status = true;
        }
        catch (PDOException $e) {
            // Nothing is printed on purpose
        }
    }

    public function established_conn()
    {
        return $this->conn_status;
    }

    // Used for checking if user exist in table
    public function select_user($name)
    {
        $statement = "SELECT *  
                      FROM users 
                      WHERE name = :name";
        $param     = array(
            ':name' => $name
        );
        $stmt      = $this->db->prepare($statement);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Used for checking if tasks are added by user
    public function select_all_tasks($user)
    {
        $statement = "SELECT * 
                      FROM tasks
                      WHERE author = :author";
        $param     = array(
            ':author' => $user
        );
        $query     = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetchAll();
    }

    // Used for getting status specific tasks / Ordering with closest ending tasks DESC
    public function select_tasks($user, $status)
    {
        $statement = "SELECT id, title, description, author, added_date, end_date, status 
                      FROM tasks 
                      WHERE author = :author
                      AND status = :status ORDER BY end_date DESC";
        $param     = array(
            ':author' => $user,
            ':status' => $status
        );
        $query     = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetchAll();
    }

    public function select_tasks_by_priority($author)
    {
        $statement = "SELECT id,
                             status
                      FROM tasks
                      WHERE author = :author 
                      AND end_date <= CURDATE()
                      AND status IN ('todo', 'ongoing')";
        $param     = array(
            ':author' => $author
        );
        $query     = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetchAll();
    }

    // Used for getting specific task in edit mode.
    public function select_task($task_id, $user_id)
    {
        $statement = "SELECT id, title, description, author, added_date, end_date, status
                      FROM tasks
                      WHERE author = :author AND id = :task_id";
        $param     = array(
            ':task_id' => $task_id,
            ':author' => $user_id
        );
        $query     = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetch();
    }

    /*public function select_task($id, $user)
    {
        $statement = "SELECT id, title, description, author, added_date, end_date, status 
                      FROM tasks 
                      WHERE id = :id AND author = :author";
        $param     = array(
            ':id' => $id,
            ':author' => $user
        );
        $query     = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetch();
    }*/

    // Used for inserting using user into database-
    public function insert_user($user)
    {
        $statement = "INSERT INTO users (name) 
                      VALUES (:name)";
        $query     = $this->db->prepare($statement);
        $param     = array(
            ':name' => $user
        );
        return $query->execute($param);
    }

    // Used for creating new task
    public function insert_task(array $task)
    {
        $statement = "INSERT
                      INTO tasks (
                        title, 
                        description,
                        author,
                        added_date,
                        end_date,
                        status
                      ) 
                      VALUES (:title, :description, :author, :added_date, :end_date, :status)";
        $query     = $this->db->prepare($statement);
        $param     = array(
            ':title' => $task['title'],
            ':description' => $task['description'],
            ':author' => $task['author'],
            ':added_date' => $task['added_date'],
            ':end_date' => $task['end_date'],
            ':status' => $task['status']
        );
        return $query->execute($param);
    }

    // Used for updating task(start, finishe or edit).
    public function update_task(array $task)
    {
        $statement = "UPDATE tasks 
                      SET title = :title,
                          description = :description,
                          added_date = :added_date,
                          end_date = :end_date,
                          status = :status
                          WHERE id = :id 
                          AND author = :author";
        $query     = $this->db->prepare($statement);
        $param     = array(
            ':id' => $task['id'],
            ':title' => $task['title'],
            ':description' => $task['description'],
            ':author' => $task['author'],
            ':added_date' => $task['added_date'],
            ':end_date' => $task['end_date'],
            ':status' => $task['status']
        );
        return $query->execute($param);
    }

    // Used for deleting task DELETE FROM tasks WHERE id = :id AND author = :author
    public function delete_task($task_id, $user)
    {
        $statement = "DELETE FROM tasks WHERE id = :id AND author = :author";
        $query     = $this->db->prepare($statement);
        $param     = array(
            ':id' => $task_id,
            ':author' => $user
        );
        return $query->execute($param);
    }
}