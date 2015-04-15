<?php require_once ('templates/top.php');
$query ="SELECT * FROM $tbl_catalog WHERE id=".$_GET['id'];
$cat=mysql_query($query);
if(!$cat) 
	exit($query);
$catalog=mysql_fetch_array($cat);
echo "<h2>".$catalog['name']."</h2>";
$query="SELECT * FROM $tbl_pictures WHERE cat_id=".$_GET['id'];
$tov=mysql_query($query);
if(!$tov) exit($query);
while($pictures=mysql_fetch_array($tov)){
if($pictures['picture']){
	$picture="<a href='#' data=".$pictures['id']."
								class 'pict'>
								<img src='media/images/".$pictures['picturesmall']."'/></a>";
}else{

	$picture = '-';
}

	echo "<div class='tov'>";
	echo $picture;
	echo $pictures['name'];
	echo "</div>";

};


 require_once ('templates/bottom.php');?>