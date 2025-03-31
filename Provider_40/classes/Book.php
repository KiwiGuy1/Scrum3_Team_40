<?php
require_once 'DB.php';

class Book {
    private $conn;
    private $table = 'books';

    public $id;
    public $title;
    public $author;
    public $genre;
    public $published_year;

    public function __construct() {
        $database = new DB();
        $this->conn = $database->connect();
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $result = $this->conn->query($query);
        return $result;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (title, author, genre, published_year) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssi', $this->title, $this->author, $this->genre, $this->published_year);
        return $stmt->execute();
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET title = ?, author = ?, genre = ?, published_year = ? WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssii', $this->title, $this->author, $this->genre, $this->published_year, $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }
}
?>