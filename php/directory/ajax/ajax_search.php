<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.11.2017
 * Time: 10:39
 */
include('../../config.php');
include('../../function.php');
$search = $_POST['search'];
$search = cleanText($search, $db_c);

   if($search == ''){
	   exit(" ");
   }
$query = $db_c->query('SELECT * FROM '.DBP.'domain WHERE domain LIKE "%'.$search.'%" ORDER BY domain');
if($query->num_rows > 0){
	$sql = $query->fetch_array();
	do{
		echo '<a href="'.HOME.urlencode($sql['domain']).'.html">'.$sql['domain'].'</a></br>';
	}while($sql = $query->fetch_array());
}else{
	echo "Ничего(";
}
?>