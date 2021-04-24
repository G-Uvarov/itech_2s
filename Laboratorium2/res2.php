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

$cursor = $pc_collection->find(['software'=>$_POST['software']],[]);

require_once __DIR__.'/table.php';
table($cursor);

?>
<script type="text/javascript">
	var html = document.getElementById('table').innerHTML;
	var value = <?php echo '"'.$_POST['software'].'"'; ?>;
	localStorage.setItem('Software='+value, html);
</script>

</body>
</html>