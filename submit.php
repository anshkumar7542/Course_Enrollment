<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $course = $_POST['course'] ?? '';

    // DB connection
    $dbHost = getenv("DB_HOST") ?: "localhost";
    $dbUser = getenv("DB_USER") ?: "root";
    $dbPass = getenv("DB_PASS") ?: "";
    $dbName = getenv("DB_NAME_COURSES") ?: "courses_db";
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "DB connection failed"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO enrollments (name, email, course) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $course);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Insert failed"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
