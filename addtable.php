<?php
if(!empty($_GET)){
	$table = $_COOKIE["tbl"];
	$db = $_COOKIE["db"];
	require_once("connection.php");
	$data=array();
	
	foreach($_GET as $g)
	{
		$data[]=$g;
	}
	
	$val=implode(" ", $data);
	$val = substr($val, 0, -1);;
	
	$query = "CREATE TABLE `$db`.$table ($val)";
	
	$successful=mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	header("location: index.php");

}

?>