<?php 
	$Status = $_GET["status"];
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$sql = "select * from surat where status='$Status'";
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
