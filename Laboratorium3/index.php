<!DOCTYPE html>
<html>
<head>
	<title>Lab 3, V 9</title>
	<script type="text/javascript">
		function fetch1(){
			var ajax= new XMLHttpRequest ();
			var input = document.getElementById("software").value;
			ajax.onreadystatechange = function()
			{
				if (ajax.readyState== 4)  { 
					if(ajax.status== 200) {
						var result = "";
						result += "JSON:"+
						"<table>"+
						"<tr>"+
						"<td>Netname</td>"+
						"<td>motherboard</td>"+
						"<td>guarantee</td>"+
						"</tr>";
						var rows = JSON.parse(ajax.responseText);
						for (var i= 0; i< rows.length; i++) {
							result += "<tr>";
							result += "<td>" + rows[i]['netname']+ "</td>";
							result += "<td>" + rows[i]['motherboard']+ "</td>";
							result += "<td>" + rows[i]['guarantee']+ "</td>";
							result += "</tr>";
						}

						result += "</table>";
						document.getElementById("result").innerHTML = result;
					}
					else {
						alert(ajax.status+ " -" + ajax.statusText);
						ajax.abort();
					}
				}
			}
			ajax.open("POST", "fetch1.php", true);
			params = "software=" +input;
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send(params);
		}

		function fetch2(){
			var ajax= new XMLHttpRequest ();
			var input = document.getElementById("processor").value;
			ajax.onreadystatechange = function()
			{
				if (ajax.readyState== 4)  { 
					if(ajax.status== 200) {// если ошибок нет
						document.getElementById("result").innerHTML = ajax.responseText;
					}
					else {
						alert(ajax.status+ " -" + ajax.statusText);
						ajax.abort();
					}
				}
			}
			ajax.open("POST", "fetch2.php", true);
			params = "processor=" +input;
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send(params);
		}

		function fetch3(){
			var ajax= new XMLHttpRequest ();
			var input = document.getElementById("date").value;
			ajax.onreadystatechange = function()
			{
				if (ajax.readyState== 4)  { 
					if(ajax.status== 200) {// если ошибок нет
						var result = "";	// формирование таблицы
						result += "XML:"+
						"<table>"+
						"<tr>"+
						"<td>Netname</td>"+
						"<td>motherboard</td>"+
						"<td>guarantee</td>"+
						"</tr>";
						var rows = ajax.responseXML.firstChild.children; // firstChild = <root>, children = table rows
						for (var i= 0; i< rows.length; i++) {
							result += "<tr>";
							result += "<td>" + rows[i].children[0].firstChild.nodeValue+ "</td>";
							result += "<td>" + rows[i].children[1].firstChild.nodeValue+ "</td>";
							result += "<td>" + rows[i].children[2].firstChild.nodeValue+ "</td>";
							result += "</tr>";
						}

						result += "</table>";
						document.getElementById("result").innerHTML = result;
					}
					else {
						alert(ajax.status+ " -" + ajax.statusText);
						ajax.abort();
					}
				}
			}
			ajax.open("POST", "fetch3.php", true);
			params = "date=" +input;
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send(params);
		}
	</script>
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
	echo "<select id=\"processor\">";
	echo "<option selected></option>";
foreach ($dbh->query($sql) as $row) {
 	echo "<option value=\"{$row['id_processor']}\">{$row['name']}, {$row['frequency']}</option>";
}
echo "</select>";
}

function getSoftware($dbh)
{
	$sql = "SELECT * FROM software";
	echo "<select id=\"software\">";
	echo "<option selected></option>";
foreach ($dbh->query($sql) as $row) {
 	echo "<option value=\"{$row['id_software']}\">{$row['name']}</option>";
 }
 	echo "</select>";
}

echo "<div id=\"result\"></div>";
echo "<form>";
echo "Software: <br>";
getSoftware($dbh);
echo "<br>";
echo "<input type=\"button\" value=\"Далее\" onclick=\"fetch1();\">";
echo "</form>";
echo "<form>";
echo "Processor: <br>";
getCPU($dbh);
echo "<br>";
echo "<input type=\"button\" value=\"Далее\" onclick=\"fetch2();\">";
echo "</form>";
echo "<form>";
echo "По дате:";
echo "<input id=\"date\" type=\"date\" value=\"2017-06-01\">";
echo "<br>";
echo "<input type=\"button\" value=\"Далее\" onclick=\"fetch3();\">";
//echo "<input type=\"submit\">";
echo "</form>";

?>
</body>
</html>