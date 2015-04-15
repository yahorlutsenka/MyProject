<?php
require_once ("templates/top.php");
$login = new field_text('login', 'Login',true, $_POST['login']);
$name = new field_text('name', 'Имя',true, $_POST['name']);
$email = new field_text_email('email','E-mail', true, $_POST['email']);
$pass = new field_password('pass','Пароль', true, $_REQUEST['pass']);
$pass2 = new field_password('pass2','Повтор пароля', true, $_REQUEST['pass2']);
$form = new form(array ('login'=>$login,'email'=>$email, 'name'=>$name,'pass'=>$pass,'pass2'=>$pass2),'регестрация', 'field');

if($_POST) 
{ 
  $error=$form->check();        
  if($form->fields['pass']->value!= $form->fields['pass2']->value){
     
     $error[] = 'Введенные вами пароли не совпали!';
     }
     $query="SELECT COUNT(*) FROM $tbl_user WHERE login='{$form->fields['login']->value}'";
     $cat=mysql_query($query);
     if(!$cat) exit($query);
     if(mysql_result($cat,0)) $error[]='Пользователь с таким именем уже существует';
     
     $query="SELECT COUNT(*) FROM $tbl_user WHERE email='{$form->fields['email']->value}'";
     $cat=mysql_query($query);
     if(!$cat) exit($query);
     if(mysql_result($cat,0)) $error[]='Пользователь с таким email уже существует';
     
     
  if(!$error)
      {
         $query = "INSERT INTO $tbl_user VALUES(NULL, '{$form->fields['email']->value}',
                                                      '{$form->fields['login']->value}',
                                                      '{$form->fields['name']->value}',
													  '{$form->fields['pass']->value}',
													  'unblock',
													  NOW())";
       $cat= mysql_query($query);
       if(!$cat)
       exit($query);
 ?>
  <script>
  document.location.href="login.php";
  </script>
  <?php
  }
  if($error)
  {
  foreach($error as $err)
    {
      echo "<span style='color:red'>";
      echo $err;
      echo "</span><br/>";
    }
  }
}
$form-> print_form();
require_once ('templates/bottom.php');?>