<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$nama = $_GET["nama"];
	$sandi = $_GET["sandi"];
	$sql = "select nama,tingkatan from akun where nama = '$nama' and sandi = '$sandi'";
	$hasil = mysqli_query($koneksi,$sql);
	if (mysqli_num_rows($hasil) == 1) {
		$data = mysqli_fetch_assoc($hasil);
		$nama = $data['nama'];
		$tingkatan = $data['tingkatan'];
		$Status = "sukses";
		echo json_encode(array("respon" => $Status, "nama" => $nama, "tingkatan" => $tingkatan));
	}
	else {
		echo json_encode(array("respon" => "gagal"));
	}
	mysqli_close($koneksi);
 ?>
