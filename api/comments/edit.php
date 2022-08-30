<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";
    $data = json_decode(file_get_contents('php://input'), true);
    $text = $data["text"];
    $id = $data["id"];

    mysqli_query($con, "UPDATE comments SET text = '$text' WHERE id = $id");
    echo json_encode(true);