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

echo "Processor:" . $_POST['processor'] . ".";
$sth=$dbh->prepare($sql_processor, array (PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
$sth->execute(array(':processor'=>$_POST['processor']));
$res=$sth->fetchAll();
foreach ($res as $row)
 	echo "{$row['netname']}, {$row['motherboard']}, {$row['guarantee']} <br>";


?>