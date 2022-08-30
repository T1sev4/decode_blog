<?php 
	include "config/db.php";
	include "config/baseurl.php";
	$id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Профиль</title>
    <?php include "views/head.php"; ?>
	<?php include "views/header.php"; ?>
</head>
<body data-baseurl="<?=$BASE_URL?>">

<section class="container page">
	<div class="page-content">
		<div class="blogs">
			<?php 
				$blogs = mysqli_query($con, "SELECT b.*, u.nickname, c.name FROM blogs b INNER JOIN users u ON b.user_id = u.id INNER JOIN categories c ON b.category_id = c.id WHERE b.id = $id");
				$blog = mysqli_fetch_assoc($blogs);
			?>
			<div class="blog-item">
				<img class="blog-item--img" src="images/1.png" alt="">

                <div class="blog-info">
					<span class="link">
						<img src="images/date.svg" alt="">
						26.06.2020
					</span>
					<span class="link">
						<img src="images/visibility.svg" alt="">
						21
					</span>
					<a class="link">
						<img src="images/message.svg" alt="">
						<div class="comments-number">
							
						</div>					
					</a>
					<span class="link">
						<img src="images/forums.svg" alt="">
						<?=$blog["name"]?>
					</span>
					<a class="link">
						<img src="images/person.svg" alt="">
						<?=$blog["nickname"]?>
					</a>
				</div>

				<div class="blog-header">
					<h3><?=$blog["title"]?></h3>
				</div>
				<p class="blog-desc">
					<?=$blog["description"]?>
				</p>
			</div>
		</div>

        <div class="comments"></div>
		<div>

			<?php 
				if(isset($_SESSION["id"])){
			?>
            <span class="comment-add">
                <textarea name="" class="comment-textarea" placeholder="Введит текст комментария"></textarea>
				<div class="text-button">
					<button class="add-button">Отправить</button>
				</div>
            </span>
			<?php }else{ ?>
            <span class="comment-warning">
                Чтобы оставить комментарий <a href="">зарегистрируйтесь</a> , или  <a href="">войдите</a>  в аккаунт.
            </span>
			<?php }?>
        </div>
	</div>
	

    <div class="page-info">
		<div class="page-header">
            <h2>Категории</h2>
        </div>

		<?php
			$categories = mysqli_query($con, "SELECT * FROM categories");
			if(mysqli_num_rows($categories) > 0){
				while($categ = mysqli_fetch_assoc($categories)){
			
		?>
			<a class = "list-item" href="<?= $BASE_URL?>/?category=<?= $categ["id"]?>"><?=$categ["name"]?></a>
		<?php
				}
			}
		?>	

		<a class='list-item' href=''></a>
       
	</div>
</section>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
<script src = "js/comment.js"></script>
</body>
</html>