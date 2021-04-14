<!DOCTYPE html>
<html>
<head>
	<title>Lab 1, V 9</title>
</head>
<body>
<?php
$db_driver="mysql";
$host = "localhost";
$database = "laboratorium1";
$dsn = "$db_driver:host=$host; dbname=$database";
$username = "root";
$password = "";

try { 
$dbh = new PDO ($dsn, $username, $password,
	[PDO::ATTR_PERSISTENT => true,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
);
echo "Connected to database<br>"; 
} 
catch (PDOException $e) {echo "Error!: " . $e->getMessage() . "<br/>"; die();
}

function getCPU($dbh)
{
	$sql = "SELECT * FROM processor";
	echo "<select name=\"processor\">";
	echo "<option selected></option>";
foreach ($dbh->query($sql) as $row) {
 	echo "<option value=\"{$row['id_processor']}\">{$row['name']}, {$row['frequency']}</option>";
}
echo "</select>";
}

function getSoftware($dbh)
{
	$sql = "SELECT * FROM software";
	echo "<select name=\"software\">";
	echo "<option selected></option>";
foreach ($dbh->query($sql) as $row) {
 	echo "<option value=\"{$row['id_software']}\">{$row['name']}</option>";
 }
 	echo "</select>";
}

echo "<form method=\"POST\" action=\"result.php\">";
echo "Software: <br>";
getSoftware($dbh);
echo "<br>";
echo "Processor: <br>";
getCPU($dbh);
echo "<br>";
echo "<input name=\"date\" type=\"date\" value=\"2017-06-01\">";
echo "<br>";
echo "<input type=\"submit\">";
echo "</form>";

?>
</body>
</html>