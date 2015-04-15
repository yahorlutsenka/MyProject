<?php session_start()?>
<?php require_once('config/config.php')?>
<?php require_once('config/class.config.php')?>

<!Doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Прект 1</title>
    <meta name="description">
    <meta name="keywords">
    <link type="text/css" rel="stylesheet" href="media/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="style.css">
	<script src='media/js/jquery-1.11.2.min.js'>
	</script>
	<script>
	$(function()
	{
		$('.topmenu a:eq(0)') .bind('mouseover',function()
												{
													$('#header').css({
													'background':'red'});
												});
		$('.topmenu a:eq(1)') .bind('mouseover',function()
												{
													$('#header').css({
													'background':'blue'});
												});
		$('.topmenu a:eq(2)') .bind('mouseover',function()
												{
													$('#header').css({
													'background':'url(media/img/1.jpg)'});
												});
		$('.topmenu a:eq(3)') .bind('mouseover',function()
												{
													$('#header').css({
													'background':'white'});
												});
		$('.topmenu a:eq(4)') .bind('mouseover',function()
												{
													$('#header').css({
													'background':'pink'});
												});	
		$('.topmenu').bind('mouseout', function()
										{
											$('#header').css({
											'background':'url(media/img/fon.jpg'});
										});											
	});
	</script>
  </head>
    <body>
     <div id="header">
       <div id="logo">
         <img src="media/img/logo.png" height="150px">
       </div>
       <div id="headlink">
        
		
		
		<?php
			if($_SESSION['id_usr_position'])
				{
					?>
					<a href="logout.php">Выход</a>		
					<a href="cabinet.php">Кабинет</a>
					<?php
				}
				else 
					{
						?>
						<a href="login.php">Вход</a>		
						<a href="reg.php">Регистрация</a>
						<?php
					}
		?>
       </div>
      </div>
	  <?php
			if($_SESSION['id_usr_position'])
				{
					?>
					<div class="topmenu">
					<a href="index.php?url=index">Главная</a>
					<a href="index.php?url=comp">О компании</a>
					<a href="index.php?url=vacan">Вакансии </a>
					<a href="index.php?url=cont">Контакты </a>
					<a href="comment.php">Отзывы </a>
					<?php
				}
				else
					{
						?>
						<div class="topmenu">
						<a href="index.php?url=index">Главная</a>
						<a href="index.php?url=comp">О компании</a>
						<a href="index.php?url=vacan">Вакансии </a>
						<a href="index.php?url=cont">Контакты </a>
						<?php
					}
		?>			
     </div>
       <div>
        <div class="col-md-2">
        <div a class="menu">
<?php
$query = "SELECT * FROM $tbl_catalog
			where showhide = 'show'";
			$cat = mysql_query($query);
			if (!$cat){
			exit($query);
			}
			while($category=mysql_fetch_array($cat))
		
				echo "<a href = 'category.php?url=".$category['url']."&id=".$category['id']."'class='btn btn-success'>".$category ['name']."</a>"	
?>
      
           </div>
        </div>
		
        <div class="col-md-8">