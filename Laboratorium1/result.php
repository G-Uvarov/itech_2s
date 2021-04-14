<!DOCTYPE html>
<html>
<head>
	<title>Lab 1, V 5</title>
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
catch (PDOException $e) {echo "Error!: " . $e->getMessage() . "<br/>"; die();}

$sql_processor='SELECT * FROM computer WHERE fid_processor = :processor';
$sql_software='SELECT * FROM computer WHERE id_computer IN (SELECT fid_computer FROM computer_software WHERE fid_software = :software)';
$sql_guarantee='SELECT * FROM computer WHERE guarantee < :guarantee';

echo "<br>";
if($_POST['processor'] != ""){
echo "Processor:" . $_POST['processor'] . ".";
$sth=$dbh->prepare($sql_processor, array (PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
$sth->execute(array(':processor'=>$_POST['processor']));
$res=$sth->fetchAll();
foreach ($res as $row)
 	echo "{$row['netname']}, {$row['motherboard']}, {$row['guarantee']} <br>";

}elseif ($_POST['software'] != "") {
echo "Software:" . strval($_POST['software']). ".";
$sth=$dbh->prepare($sql_software, array (PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
$sth->execute(array(':software'=>$_POST['software']));
$res=$sth->fetchAll();
foreach ($res as $row)
 	echo "{$row['netname']}, {$row['motherboard']}, {$row['guarantee']} <br>";
}
else{
echo $_POST["date"];
$sth=$dbh->prepare($sql_guarantee, array (PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
$sth->execute(array(':guarantee'=>$_POST['date']));
$res=$sth->fetchAll();
foreach ($res as $row)
 	echo "{$row['netname']}, {$row['motherboard']}, {$row['guarantee']} <br>";

}


?>
</body>
</html>