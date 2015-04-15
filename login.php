<?php 
require_once ("templates/top.php");
require_once('utils/utils.users.php');
$login = new field_text("login", "Login", true, $_POST['login']);
$pass = new field_password("pass", "Пароль", true, $_REQUEST['pass']);
$form = new form(array ('login'=>$login,'pass'=>$pass),'вход', 'field');

if ($_POST)
	{
		$error=($form->check());
		if(!$error)
		{
			enter($form->fields['login']->value,	$form->fields['pass']->value);
			?>
			<script>
			document.location.href='cabinet.php';
			</script>
			<?php
			
		}	
		
	}
$form->print_form();
require_once ('templates/bottom.php');
?>