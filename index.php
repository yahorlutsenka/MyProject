<?php require_once ('templates/top.php');
if($_GET['url']) {
	$file = $_GET['url'];
}
else  {
$file = 'index';
}
$query = "SELECT * FROM $lbl_maintexts
				WHERE url = '".$file."'";
	$cat = mysql_query($query);
	if(!$cat) exit($query);
	if(mysql_num_rows($cat)) 
	{
		$catalog = mysql_fetch_array($cat); 
	}
	?>
		<h2><?php echo $catalog[name];?><h2>
		<div class="maintext"> 
		<?php echo $catalog[body]; ?>
		</div>
		</div>
	<?php require_once ('templates/bottom.php');?>