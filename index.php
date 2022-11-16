<?php
error_reporting(0);
	require_once("connection.php");
if(!empty($_GET)){
	$tablename=$_GET["tableadd"];
	$selectdb=$_GET["selecteddb"];
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>MS</title>
</head>
<body>
<h1><a href="createdatabase.php" style="color:red; font-weight: bold;">CREATE AND VIEW DATABASES</a></h1>


<h1><a href="databasetablecreationhome.php" style="color:red; font-weight: bold;">CREATE NEW TABLE</a></h1>
<h1>OPEN AND DISPLAY TABLE</h1>

<p style="color:red; font-weight: bold;">Note: To be able to insert data to a table you must be able to display it using the form below!!!</p>

		<form action="" method="GET">
		<?php

//code to list database tables
$tables=$conn->prepare("SHOW DATABASES");
$tables->execute() or die("server error");

$results=$tables->get_result();

?>
Please select your database:
<select name="selecteddb" required>
		<?php
		while($row=$results->fetch_assoc())
		{
		?>
		<option  value="<?php foreach($row as $r) echo $r; ?>"><?php foreach($row as $r) echo $r; ?></option>
		<?php } ?>
</select>

		Table Name: <input type="text" name="tableadd" placeholder="enter the name of the table" required />
		<br /><br/>
		<input type="submit" value="DISPLAY TABLE" />
		</form>

<h4>Table View</h4>
<?php
//code to get row data
$table_data=$conn->prepare("SELECT * FROM `$selectdb`.$tablename") or die("Please choose a table first, take care with the spelling and case.");
$table_data->execute() or die("error retrieving table data");
$data=$table_data->get_result();


//code to fetch field data;
$fields=$data->fetch_fields();

?>

<?php echo "Table Name: $tablename "; ?>

<table border="1">
<tr>

<?php
//CODE TO DISPLAY TABLE HEADERS
	foreach ($fields as $val){
    echo "<th>$val->name</th>";
  }

?>
</tr>


<?php
//CODE TO DISPLAY TABLE DATA
$qry=$conn->prepare("SELECT * FROM `$selectdb`.$tablename") or die("error retrieving data");
$qry->execute() or die("try again");
$res=$qry->get_result();

while($col=$res->fetch_assoc())
{
	echo "<tr>";
	foreach ($fields as $val){
		$fieldname=$val->name;
		echo "<td>$col[$fieldname]</td>";
	}
	echo "</tr>";
}

?>
</table>

<p>
<a href="insert.php?tbl=<?php echo $tablename ?>&db=<?php echo $selectdb ?>" style="color:red; font-weight:bold;">INSERT DATA</a>
</p>

</body>
</html>
