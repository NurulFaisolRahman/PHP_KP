<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$NamaBidang = $_GET['NamaBidang'];
	$sql = "select * from $NamaBidang";
	$hasil = mysqli_query($koneksi,$sql);
	while($BarisData = mysqli_fetch_assoc($hasil)){
		$Data[] = $BarisData;
	}
	echo json_encode($Data);
	mysqli_close($koneksi);
 ?>
