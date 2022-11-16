<?php
	require_once("connection.php");
if(!empty($_GET)){

	$tablename=$_GET["tableadd"];

	//lets check if table exists
	if ( mysqli_query($conn, "DESCRIBE $tablename" ) ) {
		echo "table exists";
	}else{
		//Code to create a new MySqli table;
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>MS</title>
</head>
<body>

<h4>ADD A NEW TABLE</h4>

<form action="createtable.php" method="GET">
<?php

//code to list database tables
$tables=$conn->prepare("SHOW DATABASES");
$tables->execute() or die("server error");

$results=$tables->get_result();

?>
Please select your database:
<select name="db" required>
		<?php
		while($row=$results->fetch_assoc())
		{
		?>
		<option  value="<?php foreach($row as $r) echo $r; ?>"><?php foreach($row as $r) echo $r; ?></option>
		<?php } ?>
</select>
<br />
<br />
		Table Name: <input type="text" name="tablename" placeholder="Enter table name" required/>
		<br /><br/>
		
		
		Number of Fields: <input type="number" name="nofields" min="3" placeholder="Enter number of fields" required/>
			<br /><br />	
		<input type="submit" value="PROCEED" />
		</form>

</body>
</html>
