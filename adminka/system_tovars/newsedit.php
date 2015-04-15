<?php

  error_reporting(E_ALL & ~E_NOTICE);
  require_once("../../utils/utils.resizeimg.php");
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем блок авторизации
  require_once("../authorize.php");
  // Подключаем классы формы
  require_once("../../config/class.config.dmn.php");

  // Предотвращаем SQL-инъекцию
  $_GET['id'] = intval($_GET['id']);

  try
  {
    // Извлекаем из таблицы news запись, соответствующую
    // исправляемому новостному сообщению
    $query = "SELECT * FROM $tbl_pictures
              WHERE id=$_GET[id]";
    $new = mysql_query($query);
    if(!$new)
    {
      throw new ExceptionMySQL(mysql_error(), 
                               $query,
                              "Ошибка при обращении
                               к таблице новостей");
    }
    $news = mysql_fetch_array($new);
    if(empty($_POST))
    {
      // Берем информацию для оставшихся переменных из базы данных
      $_REQUEST = $news;
	  $_REQUEST['editor1'] = $_REQUEST['body'];
      $_REQUEST['date']['month']  = substr($news['putdate'],5,2);
      $_REQUEST['date']['day']    = substr($news['putdate'],8,2);
      $_REQUEST['date']['year']   = substr($news['putdate'],0,4);
      $_REQUEST['date']['hour']   = substr($news['putdate'],11,2);
      $_REQUEST['date']['minute'] = substr($news['putdate'],14,2);
      // Определяем, скрыто поле или нет
      if($news['hide'] == 'show') $_REQUEST['hide'] = true;
      else $_REQUEST['hide'] = false;
    }
    $name        = new field_text("name",
                                  "Название",
                                  true,
                                  $_REQUEST['name']);
    $editor1        = new field_textarea("editor1",
                                  "Содержимое",
                                  true,
                                  $_REQUEST['editor1']);
								  
								  
	$price = new field_text("price",
                                  "Цена",
                                  true,
                                  $_REQUEST['price']);
								  
								  
	$urlpict = new field_file('urlpict','Фото',true,$_FILES,"../../media/images/");
	
	
								  
	
    // Инициируем форму массивом из двух элементов
    // управления - поля ввода name и текстовой области
    // textarea
      $form = new form(array(
	                        "name" => $name, 
							"price" => $price,
                            "editor1" => $editor1,
							"urlpict" => $urlpict), 
                    "Редактировать",
                    "field");
					
	$var=$form->fields['urlpict']->get_filename();	
	
	if($var){
		@unlink("../../media/images/".$news['picture']); 
		@unlink("../../media/images/".$news['picturesmall']); 
	   $picture=date('y_m_d_h_i_').$var;
	   $picturesmall="s_".$picture;
	   resizeimg("../../media/images/".$picture,"../../media/images/".$picturesmall,200,200);

	   }else{
	   $picture='-';
	   $picturesmall='-';
	   }
	
    // Обработчик HTML-формы
    if(!empty($_POST))
    {
      // Проверяем корректность заполнения HTML-формы
      // и обрабатываем текстовые поля
      $error = $form->check();
      if(empty($error))
      {
        // Скрытый или открытый каталог
        if($form->fields['hide']->value) $showhide = "show";
        else $showhide = "hide";

        // Формируем SQL-запрос на добавление новости
        $query = "UPDATE $tbl_pictures
                  SET name = '{$form->fields['name']->value}',
                      body = '{$form->fields['editor1']->value}', 
                      price = '{$form->fields['price']->value}',
					picture = '$picture',
					picturesmall = '$picturesmall'
                  WHERE id=".$_GET['id'];
        if(!mysql_query($query))
        {
          throw new ExceptionMySQL(mysql_error(), 
                                   $query,
                                  "Ошибка при редактировании 
                                   новостного сообщения");
        }
        // Осуществляем переадресацию на главную страницу
        // администрирования
        ?>
		<script>
		 document.location.href="index.php?page=<?php echo $_GET['page'] ?>";
		</script>
		<?php
      }
    }

    // Данные переменные определяют название страницы и подсказку.
    $title = "Редактирование";
    $pageinfo='<p class="help"></p>';
    // Включаем заголовок страницы
    require_once("../utils/top.php");
  
?>
<div align=left>
<FORM>
<INPUT class="button" TYPE="button" VALUE="На предыдущую страницу" 
onClick="history.back()">
</FORM> 
</div>
<?
    // Выводим сообщения об ошибках, если они имеются
    if(!empty($error))
    {
      foreach($error as $err)
      {
        echo "<span style=\"color:red\">$err</span><br>";
      }
    }
?>
<table width=100%>
<tr>
<td>
<div class="table_user">
<?
    // Выводим HTML-форму 
    $form->print_form();
?>
</div>
</td>
</tr>
</table>
<?
  }
  catch(ExceptionObject $exc) 
  {
    require("../utils/exception_object.php"); 
  }
  catch(ExceptionMySQL $exc)
  {
    require("../utils/exception_mysql.php"); 
  }
  catch(ExceptionMember $exc)
  {
    require("../utils/exception_member.php"); 
  }

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
?>
