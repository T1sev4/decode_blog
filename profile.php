<!DOCTYPE html>
<html lang="en">
<head>
	<title>Профиль</title>
	<?php include "views/head.php";
		include "config/baseurl.php";
	?>
	
</head>
<body data-baseurl="<?=$BASE_URL?>">
<?php 
	include "views/header.php";
	if(isset($_SESSION["id"])){
		$id = $_SESSION["id"];
		$currentUSer = $_SESSION["nickname"];
	}
	$nickname = $_GET["nickname"];
?>

<section class="container page">
	<div class="page-content">
		<div class="page-header">
			<?php 
				if($nickname == $currentUSer){ 
			?>
				<h2>Мои блоги</h2>
				<a class="button" href="<?=$BASE_URL?>/newblog.php">Новый блог</a>
			<?php }else{ ?>
				<h2>Блоги пользователя</h2>
			<?php }?>
		</div>

		<div class="blogs">
			
		</div>
	</div>
	<div class="page-info">
		<div class="user-profile">
			<?php
				
				$user_info = mysqli_query($con, "SELECT * FROM users WHERE nickname = '$nickname'");
				if(mysqli_num_rows($user_info) > 0){
					$user = mysqli_fetch_assoc($user_info);
				
			?>
				<img class="user-profile--ava" src="images/avatar.png" alt="">

				<h1><?=$user["full_name"]?></h1>
				<h2>В основном пишу про веб - разработку, на React & Redux</h2>
				<p>285 постов за все время</p>
				<?php
					if($id == $user["id"]){
				?>
				<a href="" class="button">Редактировать</a>
				<a href="<?=$BASE_URL?>/api/users/signout.php" class="button button-danger"> Выход</a>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</section>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
<script src = "js/profile.js"></script>
</body>
</html>