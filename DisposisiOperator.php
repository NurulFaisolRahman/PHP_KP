<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$nomor_surat = $_GET['nomor_surat'];
	$surat_dari = $_GET['surat_dari'];
	$tanggal_surat = $_GET['tanggal_surat'];
	$diterima_tanggal = $_GET['diterima_tanggal'];
	$nomor_agenda = $_GET['nomor_agenda'];
	$sifat = $_GET['sifat'];
	$perihal = $_GET['perihal'];
	$sql = "INSERT INTO `surat` (`nomor_surat`, `surat_dari`,`tanggal_surat` ,`diterima_tanggal`,`nomor_agenda`,`sifat`,`perihal`) VALUES ('$nomor_surat', '$surat_dari', '$tanggal_surat','$diterima_tanggal','$nomor_agenda','$sifat','$perihal');";
	$hasil = mysqli_query($koneksi,$sql);
	echo json_encode(array("respon" => "sukses"));
	mysqli_close($koneksi);
 ?>
