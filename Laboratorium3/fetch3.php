<?php

header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");

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
} 

catch (PDOException $e) {echo "Error!: " . $e->getMessage() . "<br/>"; die();}

echo '<?xml version="1.0" encoding="utf8" ?>';

$sql_processor='SELECT * FROM computer WHERE fid_processor = :processor';
$sql_software='SELECT * FROM computer WHERE id_computer IN (SELECT fid_computer FROM computer_software WHERE fid_software = :software)';
$sql_guarantee='SELECT * FROM computer WHERE guarantee < :guarantee';

echo "<root>";

echo $_POST["date"];
$sth=$dbh->prepare($sql_guarantee, array (PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
$sth->execute(array(':guarantee'=>$_POST['date']));
$res=$sth->fetchAll();
foreach ($res as $row){
	echo "<row>";
	echo "<Netname>{$row['netname']}</Netname>";
	echo "<motherboard>{$row['motherboard']}</motherboard>";
	echo "<guarantee>{$row['guarantee']}</guarantee>";
	echo "</row>";
}

echo "</root>";

?>