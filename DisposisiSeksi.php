<?php 
	$NamaBidang = $_GET["NamaBidang"];
	$NamaSub = $_GET["NamaSub"];
	$Status = $_GET["Status"];
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$sql = "SELECT * FROM surat WHERE nomor_surat in (SELECT nomor_surat FROM $NamaBidang WHERE $NamaSub='$Status')";
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
