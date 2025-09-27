<?php

require_once __DIR__ . '/../config/database.php';


function check_login() {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: " . BASE_PATH . "login.php");
        exit;
    }
}


function check_role($role) {
    check_login();
    if ($_SESSION["role"] !== $role) {
        header("location: " . BASE_PATH . $_SESSION["role"] . "/index.php");
        exit;
    }
}


function get_all_books($conn) {
    $sql = "SELECT * FROM books ORDER BY title";
    $result = $conn->query($sql);
    return $result;
}


function get_book_by_id($conn, $book_id) {
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


function get_all_users($conn) {
    $sql = "SELECT id, full_name, email, role, is_active FROM users ORDER BY full_name";
    $result = $conn->query($sql);
    return $result;
}

function get_teacher_recommendations($conn) {
    $sql = "SELECT u.full_name AS teacher_name, r.book_title, r.reason, r.created_at
            FROM recommendations r
            JOIN users u ON r.teacher_id = u.id
            WHERE u.role = 'teacher'
            ORDER BY u.full_name, r.created_at DESC";

    $result = $conn->query($sql);
    $recommendations = [];

    while ($row = $result->fetch_assoc()) {
        $recommendations[$row['teacher_name']][] = $row;
    }

    return $recommendations;
}


function get_book_reviews($conn, $book_id) {
    $stmt = $conn->prepare(
        "SELECT r.*, u.full_name AS teacher_name
         FROM reviews r
         JOIN users u ON r.teacher_id = u.id
         WHERE r.book_id = ?
         ORDER BY r.created_at DESC"
    );
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    return $reviews;
}


?>