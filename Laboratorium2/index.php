<!DOCTYPE html>
<html>
<head>
	<title>Laboratorium 2</title>
</head>
<body>
<?php
require_once __DIR__."/vendor/autoload.php";
$mongo_client = new MongoDB\Client();
$db = $mongo_client->laboratorium2;
$pc_collection = $db->pc;
?>
<form action="res1.php" method="POST">
	<label>Выбрать по типу процессора</label><br>
	<select name="CPU" onchange="changedCPU(this.options[this.selectedIndex].value);">
		<?php
		//$cursor = $pc_collection->find([],[]);
		$cursor = $pc_collection->distinct('CPU');// уникальные значения CPU
		foreach ($cursor as $cpu) {
			echo "<option value=\"{$cpu}\">";
			echo "{$cpu}";
			echo "</option>";
		}
		?>
	</select>
	<input type="submit">
</form>

<form action="res2.php" method="POST">
	<label>Выбрать по Software</label><br>
	<select name="software" onchange="changedSoftware(this.options[this.selectedIndex].value);">
		<?php
		$cursor = $pc_collection->distinct('software');// уникальные значения software
		foreach ($cursor as $software) {
			echo "<option value=\"{$software}\">";
			echo "{$software}";
			echo "</option>";
		}
		?>
	</select>
	<input type="submit">
</form>

<form action="res3.php" method="POST">
	<label>Выбрать по истекшей гарантии</label><br>
	<input type="date" name="guarantee" onchange="changedDate(this.value);">
	<input type="submit">
</form>

<table border="1" id="localStorageDisplay"></table>

<script type="text/javascript">

	function changedCPU(value){
		var item = localStorage.getItem('CPU='+value);
		var div = document.getElementById('localStorageDisplay');
		if(item == null){
			div.innerHTML = '';
		}else{
			div.innerHTML = item;
		}
	}


	function changedSoftware(value){
		var item = localStorage.getItem('Software='+value);
		var div = document.getElementById('localStorageDisplay');
		if(item == null){
			div.innerHTML = '';
		}else{
			div.innerHTML = item;
		}
	}

	function changedDate(value){
		var item = localStorage.getItem('Date='+value);
		var div = document.getElementById('localStorageDisplay');
		if(item == null){
			div.innerHTML = '';
		}else{
			div.innerHTML = item;
		}
	}
</script>

</body>
</html>