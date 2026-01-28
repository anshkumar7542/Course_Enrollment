<?php
    $servername = getenv("DB_HOST") ?: "localhost";
    $username = getenv("DB_USER") ?: "root";
    $password = getenv("DB_PASS") ?: "";
    $database = getenv("DB_NAME") ?: "php_project";

    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn)
    {
        echo "Disconnected";
    }
?>
