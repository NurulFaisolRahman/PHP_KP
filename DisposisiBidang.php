<?php 
	$NamaBidang = $_GET["NamaBidang"];
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$sql = "SELECT * FROM `surat` WHERE nomor_surat NOT IN (SELECT nomor_surat from $NamaBidang) AND bidang LIKE '%$NamaBidang%'";
	$hasil = mysqli_query($koneksi,$sql);
	while($BarisData = mysqli_fetch_assoc($hasil)){
		$Data[] = $BarisData;
	}
	if (empty($Data)) {
		echo json_encode(array("respon" => "gagal", "data" => null));
	} 
	else {
		echo json_encode(array("respon" => "sukses", "data" => $Data));
	}
	mysqli_close($koneksi);
 ?>
