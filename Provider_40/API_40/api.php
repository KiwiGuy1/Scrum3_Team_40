<?php
require_once '../classes/Book.php';
require_once '../classes/Member.php';
require_once '../classes/Loan.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['entity'])) {
            switch ($_GET['entity']) {
                case 'books':
                    $book = new Book();
                    $result = $book->read();
                    $books_arr = array();
                    while ($row = $result->fetch_assoc()) {
                        array_push($books_arr, $row);
                    }
                    echo json_encode($books_arr);
                    break;
                case 'members':
                    $member = new Member();
                    $result = $member->read();
                    $members_arr = array();
                    while ($row = $result->fetch_assoc()) {
                        array_push($members_arr, $row);
                    }
                    echo json_encode($members_arr);
                    break;
                case 'loans':
                    $loan = new Loan();
                    $result = $loan->read();
                    $loans_arr = array();
                    while ($row = $result->fetch_assoc()) {
                        array_push($loans_arr, $row);
                    }
                    echo json_encode($loans_arr);
                    break;
            }
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->entity)) {
            switch ($data->entity) {
                case 'books':
                    $book = new Book();
                    $book->title = $data->title;
                    $book->author = $data->author;
                    $book->genre = $data->genre;
                    $book->published_year = $data->published_year;
                    if ($book->create()) {
                        http_response_code(201);
                        echo json_encode(array('message' => 'Book Created'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Book Not Created'));
                    }
                    break;
                case 'members':
                    $member = new Member();
                    $member->name = $data->name;
                    $member->membership_date = $data->membership_date;
                    $member->email = $data->email;
                    $member->phone_number = $data->phone_number;
                    if ($member->create()) {
                        http_response_code(201);
                        echo json_encode(array('message' => 'Member Created'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Member Not Created'));
                    }
                    break;
                case 'loans':
                    $loan = new Loan();
                    $loan->book_id = $data->book_id;
                    $loan->member_id = $data->member_id;
                    $loan->loan_date = $data->loan_date;
                    $loan->return_date = $data->return_date;
                    if ($loan->create()) {
                        http_response_code(201);
                        echo json_encode(array('message' => 'Loan Created'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Loan Not Created'));
                    }
                    break;
            }
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->entity)) {
            switch ($data->entity) {
                case 'books':
                    $book = new Book();
                    $book->id = $data->id;
                    $book->title = $data->title;
                    $book->author = $data->author;
                    $book->genre = $data->genre;
                    $book->published_year = $data->published_year;
                    if ($book->update()) {
                        echo json_encode(array('message' => 'Book Updated'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Book Not Updated'));
                    }
                    break;
                case 'members':
                    $member = new Member();
                    $member->id = $data->id;
                    $member->name = $data->name;
                    $member->membership_date = $data->membership_date;
                    $member->email = $data->email;
                    $member->phone_number = $data->phone_number;
                    if ($member->update()) {
                        echo json_encode(array('message' => 'Member Updated'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Member Not Updated'));
                    }
                    break;
                case 'loans':
                    $loan = new Loan();
                    $loan->id = $data->id;
                    $loan->book_id = $data->book_id;
                    $loan->member_id = $data->member_id;
                    $loan->loan_date = $data->loan_date;
                    $loan->return_date = $data->return_date;
                    if ($loan->update()) {
                        echo json_encode(array('message' => 'Loan Updated'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Loan Not Updated'));
                    }
                    break;
            }
        }
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->entity)) {
            switch ($data->entity) {
                case 'books':
                    $book = new Book();
                    $book->id = $data->id;
                    if ($book->delete()) {
                        echo json_encode(array('message' => 'Book Deleted'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Book Not Deleted'));
                    }
                    break;
                case 'members':
                    $member = new Member();
                    $member->id = $data->id;
                    if ($member->delete()) {
                        echo json_encode(array('message' => 'Member Deleted'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Member Not Deleted'));
                    }
                    break;
                case 'loans':
                    $loan = new Loan();
                    $loan->id = $data->id;
                    if ($loan->delete()) {
                        echo json_encode(array('message' => 'Loan Deleted'));
                    } else {
                        http_response_code(500);
                        echo json_encode(array('message' => 'Loan Not Deleted'));
                    }
                    break;
            }
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(array('message' => 'Invalid Request Method'));
        break;
}
?>