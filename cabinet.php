<?php 
	require_once('templates/top.php');
	if($_SESSION['id_usr_position'])
	{
		$query = "SELECT * FROM $tbl_user WHERE id = " .$_SESSION['id_usr_position'];
		$usr = mysql_query($query);
	 if(!$usr) exit($query);
	 
	 
		$tbl_user = mysql_fetch_array($usr);
		
		echo 'Вы вошли под именем: ' , $tbl_user['name'];
		?>		
		<br \>
		<?php
		echo 'Вы вошли: ' , $tbl_user['lastvisit'];	
	} else {
		echo 'ошибка входа';
	}

 require_once('templates/bottom.php')
 ?>