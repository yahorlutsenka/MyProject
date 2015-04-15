<?php
$dblocatior='localhost';
$dbname='qwerty';
$dbuser='root';
$dbpasswordrd='';
$tbl_catalog='catalogs';
$tbl_user='users';
$tbl_pictures='pictures';
$tbl_accounts='system_accounts';

//таблицы
$lbl_maintexts='qwerty';
$dbcnx=mysql_connect($dblocatior,$dbuser,$dbpasswordrd);
if (!$dbcnx){
exit('no connect to server MySQL ');}
$dbuse=mysql_select_db($dbname,$dbcnx);
if(!$dbuse){
exit('no DB');}
@mysql_query("set names='utf8'");
