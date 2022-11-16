<?php
error_reporting(1);
require_once("connection.php");
if(!empty($_GET) && empty($_GET["tbl"])){
	$len=count($_GET);
	$array_len=$len-1;
	
	$data=array();
	
	foreach($_GET as $g){
		$data[]=$g;
	}
	
	$table=$_COOKIE["itbl"];
	$db=$_COOKIE["idb"];
	
	$query = "INSERT INTO `$db`.$table VALUES(".implode(",", $data).")";
	 
	 echo $query;
	mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	header("location: index.php");
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>MS</title>
</head>
<body>

<h1>Table Data</h1>
<?php
$tablename=$_GET["tbl"];
$databasename=$_GET["db"];
//code to get row data
$table_data=$conn->prepare("SELECT * FROM $tablename");
$table_data->execute() or die("error retrieving table data");
$data=$table_data->get_result();

setcookie("itbl", $tablename, time() + (86400 * 30), "/");
setcookie("idb", $databasename, time() + (86400 * 30), "/");

//code to fetch field data;
$fields=$data->fetch_fields();

?>

<?php echo "Table Name: $tablename  \r\n";  ?>
<?php echo "Database Name: $databasename "; ?>

<form action="insert.php" method="GET">
<h3>INSERT DATA</h3>
<?php
	foreach ($fields as $val){
		$fieldname=$val->name;
		$fieldtype=$val->def;
		
		?>
		
		<?php echo $fieldname; ?><input type="text" name="<?php echo $fieldname; ?>" /><br /><br />
		
		<?php
	}

?>

<input type="submit" VALUE="INSERT DATA" />
</form>

</body>
</html>