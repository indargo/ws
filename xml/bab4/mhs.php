<?php

header('Content-Type: text/xml; charset=ISO-8859-1');
include "koneksi.php";

$path = $_SERVER(PATH_INFO);
if ($path != null) {
	$path_params = explode ("/", $path);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($path_params[1] != null){
		$query = "select
			nim,
			nama,
			alamat,
			prodi
			from mahasiswa where nim = $path_params[1]";
	} else {
		$query = "select
			nim,
			nama,
			alamat,
			prodi
			from mahasiswa";
	}
	$result = mysql_query($query) or die ('Query failed: ' . mysql_error());
	
	echo "<data>";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "<mahasiswa>";
		foreach ($line as $key => $col_value) {
	echo "</data>";
	
	mysql_free_result($result);
}


}
mysql_close($link);
?>