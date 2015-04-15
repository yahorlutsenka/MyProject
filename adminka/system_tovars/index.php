<?php

  error_reporting(E_ALL & ~E_NOTICE);

  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем блок авторизации
  require_once("../authorize.php");
  // Подключаем SoftTime FrameWork
  require_once("../../config/class.config.dmn.php");
  // Подключаем блок отображения текста в окне браузера
  require_once("../utils/utils.print_page.php");

  // Данные переменные определяют название страницы и подсказку.
  $title = 'Управление блоком "Текстовое наполнение сайта"';
  $pageinfo = '<p class=help>Здесь можно добавить
               новостной блок, отредактировать или
               удалить уже существующий блок.</p>';

  // Включаем заголовок страницы
  require_once("../utils/top.php");

  try
  {
	?>
	<table width=100% border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td width=50% class='menu_right'>
	<?
		// Добавить блок
		echo "<a href=newsadd.php?page=$_GET[page]
				title='Добавить товар'>
				<img border=0 src='../utils/img/add.gif' align='absmiddle' />
				Добавить	 товар</a>";
	?>
	</td>
	<td width=50%>
	</td>
	</tr>
	</table>
<?
	$page_link=3; //кол-во ссылок
	$pnumber=20; //кол-во позиций на стр
	$obj=new pager_mysql($tbl_pictures,"","ORDER BY id DESC",$pnumber,$page_link);
	$news=$obj->get_page();
	if(!empty ($news)) 
	{
		?>
		<table width=100% class='table' border=0>
		<tr class='heads' align='center'>
		<td>Изображение</td>
		<td>Наименование</td>
		<td>Описание</td>
		<td>Содержание</td>
		<td>Действие</td>		
		</tr>
		<?php
		for($i=0;$i < count($news);$i++)
		{
		$url="?id=".$news[$i]['id']."&page=" .$_GET['page'];
		if($news[$i]['showhide']=='hide')
		{
			$showhide="<a href='newsshow.php$url'
						title ='Отобразить'>
						<img src='../utils/img/show.gif'
						border=0 align='absmiddle'/>
						отобразить</0>";
		}
		else
		{
			$showhide="<a href='newshide.php$url'
						title='Скрыть'>
						<img src='../utils/img/folder_locked.gif'
						border=0 align='absmiddle'/>
						скрыть</0>";
		}
		if($news[$i]['picturesmall']!='-')
		{
			$pic="<img src='../../media/images/".$news[$i]['picturesmall']."' />";
		}else {
		 $pic = '-';
		}
		echo "<tr> 
				<td class='menu' valign='top'>".$pic."</td>
				<td class='menu' valign='top'>".$news[$i]['name']."</td>
				<td class='menu' valign='top'>".$news[$i]['body']."</td>
				<td class='menu' valign='top'> цена: ".$news[$i]['price']."</td>
				<td class='menu' valign='top'> $showhide 
				<a href = 'newsedit.php$url'
				title='редактировать'>
				<img src='../utils/img/Kedit.gif'
				border = 0 align='absmiddle'/>
				Редактировать</0>
				<a href ='#' onclick =\"delete_position(
										'newsdel.php$url',
										'Вы действительно хотите удалить?');\"
				tittle = 'удалить'>
				<img src='../utils/img/editdelete.gif'
				align='absmiddle'/> удалить </0> </td>
			</tr>";
		}
		echo "</table>";
	}
	echo $obj;
	
    

    
  }
  catch(ExceptionMySQL $exc)
  {
    require("../utils/exception_mysql.php"); 
  }

  // Включаем завершение страницы
  require_once("../utils/bottom.php");

echo "";
?>