<?php 
	$PathFoto = $_GET["PathFoto"];
	unlink($PathFoto);
	echo json_encode("Sukses");
	$Pecah = explode("/", $PathFoto);
	$Pecah1 = explode("-", $Pecah[2]);
	$NomorSurat = $Pecah1[0];
	$HapusFoto = "DELETE from foto WHERE nomor_surat = '$NomorSurat'";
	$hasil = mysqli_query($koneksi,$HapusFoto);
 ?>