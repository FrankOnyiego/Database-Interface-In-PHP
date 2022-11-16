<!DOCTYPE HTML>
<html>
<head>
<title>MS</title>
</head>
<body>

<h4>Add Table</h4>

<form action="addtable.php" method="GET" />
<?php
if(!empty($_GET)){
	$no=$_GET["nofields"];
	$tablename=$_GET['tablename'];
	$db=$_GET['db'];
	
	//let us set a cookie;
	setcookie("tbl", $tablename, time() + (86400 * 30), "/");
	setcookie("db", $db, time() + (86400 * 30), "/");

	for($i=0; $i< $no; $i++){
?>

<br />
		Field Name: <input type="text" name="field<?php echo $i; ?>" required />
		
		Data Type:
		<select id="cars" name="option<?php echo $i; ?>"  required>
		  <option value="INT,">Interger</option>
		  <option value="TEXT,">String</option>
		  <option value="DATE,">Date</option>
		</select>
<br /><br />	
<?php }} ?>
		<input type="submit" value="SAVE TABLE" />
		</form>

</body>
</html>
