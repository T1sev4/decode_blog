<?php
     include "../../config/db.php";
     include "../../config/baseurl.php";
     $id = $_GET["id"];
     $comments = mysqli_query($con, "SELECT * FROM comments WHERE id = $id");
     $comment = mysqli_fetch_assoc($comments);
     echo json_encode($comment);