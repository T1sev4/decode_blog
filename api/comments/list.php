<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    $blog_id = $_GET["id"];
    $comments_query = mysqli_query($con, "SELECT c.*, u.full_name FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.blog_id = $blog_id");
    
    $comments = array();
    if(mysqli_num_rows($comments_query) > 0){
        while($row = mysqli_fetch_assoc($comments_query)){
            $comments[] = $row;
        }
    }
    echo json_encode($comments);