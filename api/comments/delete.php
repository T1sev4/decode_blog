<?php
       include "../../config/db.php";
       include "../../config/baseurl.php";

       $id = $_GET["id"];
       mysqli_query($con, "DELETE FROM comments WHERE id = $id");

       mysqli_query($con, "INSERT INTO comments (user_id, blog_id, text) VALUES($user_id, $blog_id, '$text')");
       echo json_encode(true);