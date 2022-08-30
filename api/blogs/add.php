<?php
    include "../../config/db.php";
    include "../../config/baseurl.php";

    if(isset($_POST["title"], $_POST["description"], $_POST["category_id"]) && 
    strlen($_POST["title"]) > 0 && 
    strlen($_POST["description"]) > 0 &&
    intval($_POST["category_id"]))
    {
        $title = $_POST["title"];
        $desc = $_POST["description"];
        $categ_id = $_POST["category_id"];
        session_start();
        $user_id = $_SESSION["id"];
        if(isset($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 0){
            $ext = end(explode('.', $_FILES["image"]["name"]));
            $image_name = time().'.'.$ext;
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/blogs/$image_name");
            $path = "images/blogs/$image_name";
            $prep = mysqli_prepare($con, "INSERT INTO blogs (title, description, category_id, user_id, image) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($prep, "ssiis", $title, $desc, $categ_id, $user_id, $path);
            mysqli_stmt_execute($prep);
        }
        else{
            $prep = mysqli_prepare($con, "INSERT INTO blogs (title, description, category_id, user_id) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($prep, "ssii", $title, $desc, $categ_id, $user_id);
            mysqli_stmt_execute($prep);
        }
        $nickname = $_SESSION["nickname"];
        header("Location:$BASE_URL/profile.php?nickname=$nickname");
    }
    else{
        header("Location:$BASE_URL/newblog.php?error=5");
    }