<?php
require_once 'DB.php';

class Loan {
    private $conn;
    private $table = 'loans';

    public $id;
    public $book_id;
    public $member_id;
    public $loan_date;
    public $return_date;

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
        $query = 'INSERT INTO ' . $this->table . ' (book_id, member_id, loan_date, return_date) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iiss', $this->book_id, $this->member_id, $this->loan_date, $this->return_date);
        return $stmt->execute();
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET book_id = ?, member_id = ?, loan_date = ?, return_date = ? WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iissi', $this->book_id, $this->member_id, $this->loan_date, $this->return_date, $this->id);
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