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
} 
catch (PDOException $e) {echo "Error!: " . $e->getMessage() . "<br/>"; die();}

$sql_processor='SELECT * FROM computer WHERE fid_processor = :processor';
$sql_software='SELECT * FROM computer WHERE id_computer IN (SELECT fid_computer FROM computer_software WHERE fid_software = :software)';
$sql_guarantee='SELECT * FROM computer WHERE guarantee < :guarantee';

$sth=$dbh->prepare($sql_software, array (PDO::ATTR_CURSOR=> PDO::CURSOR_FWDONLY));
$sth->execute(array(':software'=>$_POST['software']));
$res=$sth->fetchAll();
$result = []; $x = 0;
foreach ($res as $row){
 	$result[$x] = $row;
}
echo json_encode($result);
?>
