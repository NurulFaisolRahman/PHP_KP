<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$NomorSurat = $_GET["NomorSurat"];
	$NamaBidang = $_GET["NamaBidang"];
	$SubBidang = $_GET["SubBidang"];
	$sql = "UPDATE $NamaBidang SET $SubBidang = '1'";
	if(mysqli_query($koneksi,$sql)){
		echo json_encode(array("respon" => "sukses"));
	}
	mysqli_close($koneksi);
 ?>