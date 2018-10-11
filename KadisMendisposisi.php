<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$NomorSurat = $_GET["NomorSurat"];
	$Bidang = $_GET["Bidang"];
	$IsiDisposisi = $_GET["IsiDisposisi"];
	$sql = "UPDATE surat SET status = 'Disposisi', isi_disposisi = '$IsiDisposisi', bidang = '$Bidang' WHERE nomor_surat = '$NomorSurat'";
	$hasil = mysqli_query($koneksi,$sql);
	echo json_encode(array("respon" => "sukses"));
	mysqli_close($koneksi);
 ?>