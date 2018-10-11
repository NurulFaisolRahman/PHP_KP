<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$nomor_surat = $_GET['nomor_surat'];
	$surat_dari = $_GET['surat_dari'];
	$tanggal_surat = $_GET['tanggal_surat'];
	$diterima_tanggal = $_GET['diterima_tanggal'];
	$nomor_agenda = $_GET['nomor_agenda'];
	$sifat = $_GET['sifat'];
	$perihal = $_GET['perihal'];
	$sql = "UPDATE surat SET surat_dari = '$surat_dari', tanggal_surat = '$tanggal_surat', diterima_tanggal = '$diterima_tanggal', nomor_agenda = '$nomor_agenda', sifat = '$sifat', perihal = '$perihal' WHERE nomor_surat = '$nomor_surat'";
	$hasil = mysqli_query($koneksi,$sql);
	echo json_encode(array("respon" => "sukses"));
	mysqli_close($koneksi);
 ?>