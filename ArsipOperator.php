<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$sql = "select * from surat";
	$hasil = mysqli_query($koneksi,$sql);
	while($BarisData = mysqli_fetch_assoc($hasil)){
		$Data[] = $BarisData;
	}
	echo json_encode($Data);
	mysqli_close($koneksi);
 ?>
