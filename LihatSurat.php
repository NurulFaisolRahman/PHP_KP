<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$NomorSurat = $_GET["NomorSurat"];
	$sql = "SELECT url from foto WHERE nomor_surat = '$NomorSurat'";
	$hasil = mysqli_query($koneksi,$sql);
	while($BarisData = mysqli_fetch_assoc($hasil)){
		$Data[] = $BarisData['url'];
	}
	echo json_encode($Data);
	mysqli_close($koneksi);
 ?>