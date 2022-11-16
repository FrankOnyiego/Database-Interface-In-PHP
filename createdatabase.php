<?php
	require_once("connection.php");
if(!empty($_GET)){
	$databasename = $_GET["db"];
	
	//CODE TO CREATE THE DATABASE;
	$qry="CREATE DATABASE $databasename";
	mysqli_query($conn,$qry) or die(mysqli_error($conn));
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>MS</title>
</head>
<body>
<h4>CREATE NEW DATABASE</h4>

		<form action="" method="GET">
			Database Name: <input type="text" name="db" placeholder="Type database name" required/>
		<br /><br/>	
			<input type="submit" value="CREATE DATABASE" />
		</form>
		
<h1>AVAILABLE DATABASES</h1>
<?php

//code to list database tables
$tables=$conn->prepare("SHOW DATABASES");
$tables->execute() or die("server error");

$results=$tables->get_result();
while($row=$results->fetch_assoc())
{
?>
<ul>
<li><?php foreach($row as $r) echo $r; ?>
</ul>
<?php } ?>

</body>
</html>
