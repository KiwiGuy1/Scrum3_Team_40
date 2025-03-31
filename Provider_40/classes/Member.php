<?php
require_once 'DB.php';

class Member {
    private $conn;
    private $table = 'members';

    public $id;
    public $name;
    public $membership_date;
    public $email;
    public $phone_number;

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
        $query = 'INSERT INTO ' . $this->table . ' (name, membership__date, email, phone_number) VALUES (?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssss', $this->name, $this->membership_date, $this->email, $this->phone_number);
        return $stmt->execute();
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET name = ?, membership__date = ?, email = ?, phone_number = ? WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssssi', $this->name, $this->membership_date, $this->email, $this->phone_number, $this->id);
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