<?php
function table($cursor){

	echo '<table border="1" id="table">';
	foreach ($cursor as $document) {
		echo '<tr>';
		echo '<td>'.$document['_id'].'</td>';
		echo '<td>'.$document['CPU'].'</td>';
		echo '<td> RAM:'.$document['RAM'].'</td>';
		echo '<td> HDD:'.$document['HDD'].'</td>';
		echo '<td> ПО:';
		foreach ($document['software'] as $item) {
			echo $item.', ';
		}
		echo '</td>';
		$date_purchase = $document['purchase']->toDateTime()->format('Y-m-d');
		echo '<td> куплен: '.$date_purchase.'</td>';
		$date_guarantee = $document['guarantee']->toDateTime()->format('Y-m-d');
		echo '<td> гарантия до: '.$date_guarantee.'</td>';
		echo '</tr>';
	}
	echo '</table>';

}

?>