<?php

require ('conf.php');

class Database {
    private $db;

    // Connection status
    private $conn_status = false;

    function __construct() {
        $this->connect();
    }

    public function connect() {
        try {
            $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT);
            // Creates a new PDO database connection
            $this->db = new PDO(
                DSN,
                DB_USER,
                DB_PASS,
                $options);

            $init = file_get_contents(DB_INIT_FILE);
            $this->db->exec($init);

            // Connection successful
            $this->conn_status = true;
        }
        catch (PDOException $e) {
            // Nothing is printed on purpose
        }
    }

    public function established_conn() {
        return $this->conn_status;
    }

    public function select_user($name) {
        $statement = "SELECT name FROM users WHERE name = :name";
        $param = array(
            ':name' => $name
        );
        $stmt = $this->db->prepare($statement);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function select_tasks($user) {
        $statement = "SELECT id, title, description, author, added_date, end_date, finished FROM tasks WHERE author = :author"; //ORDER BY end_date DESC";
        $param = array(':author' => $user);
        $query = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetchAll();
    }

    public function select_task($id, $user) {
        $statement = "SELECT id, title, description, author, added_date, end_date, finished 
                      FROM tasks 
                      WHERE id = :id AND author = :author";
        $param = array(':id' => $id, ':author' => $user);
        $query = $this->db->prepare($statement);
        $query->execute($param);
        return $query->fetch();
    }

    public function insert_user($user) {
        $statement = "INSERT INTO users (name) VALUES (:name)";
        $query = $this->db->prepare($statement);
        $param = array(
            ':name' => $user);
        return $query->execute($param);
    }

    public function insert_task(array $task) {
        $statement = "INSERT INTO tasks (title, description, author, added_date, end_date, finished) 
                      VALUES (:title, :description, :author, :added_date, :end_date, :finished)";
        $query = $this->db->prepare($statement);
        $param = array(
            ':title' => $task['title'],
            ':description' => $task['description'],
            ':author' => $task['author'],
            ':added_date' => $task['added_date'],
            ':end_date' => $task['end_date'],
            ':finished' => $task['finished']
        );
        return $query->execute($param);
    }

    public function update_task(array $task) {
        $statement = "UPDATE tasks SET title = :title,
                          description = :description,
                          added_date = :added_date,
                          end_date = :end_date,
                          finished = :finished
                          WHERE id = :id AND author = :author";
        $query = $this->db->prepare($statement);
        $param = array(
            'id' => $task['id'],
            ':title' => $task['title'],
            ':description' => $task['description'],
            ':author' => $task['author'],
            ':added_date' => $task['added_date'],
            ':end_date' => $task['end_date'],
            ':finished' => $task['finished'],
        );
            var_dump($query);
        return $query->execute($param);
    }

    public function update_task_status(array $task) {
        $statement = "UPDATE tasks SET finished = :finished
                          WHERE id = :id AND author = :author";
        $query = $this->db->prepare($statement);
        $param = array(
            'id' => $task['id'],
            ':author' => $task['author'],
            ':finished' => $task['finished']
        );
        return $query->execute($param);
    }

    //TODO DELETE FROM tasks WHERE id = :id AND author = :author
    public function delete_task($task_id, $user) {
        $statement = "DELETE FROM tasks WHERE id = :id AND author = :author";
        $query = $this->db->prepare($statement);
        $param = array(
            ':id' => $task_id,
            ':author' => $user
        );
        return $query->execute($param);
    }
}
