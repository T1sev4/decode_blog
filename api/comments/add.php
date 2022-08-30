<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    $text = $data["text"];
    $blog_id = $data["blog_id"];
    $user_id = $_SESSION["id"];

    mysqli_query($con, "INSERT INTO comments (user_id, blog_id, text) VALUES($user_id, $blog_id, '$text')");
    echo json_encode(true);