<?php 
	define('HOST','localhost');
	define('USER','root');
	define('PASS','');
	define('DB','disposisi');
	$upload_path = 'data/';
 	$server_ip = "10.42.0.1";
 	$upload_url = 'http://'.$server_ip.'/disposisi/'.$upload_path; 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
 		$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect...');
 		$NomorSurat = $_POST['nomor_surat'];
 		$id_foto = $_POST['id_foto'];
		$fileinfo = pathinfo($_FILES['image']['name']);
 		$extension = $fileinfo['extension'];
		$file_url = $upload_url . $NomorSurat . "-" . $id_foto . '.' . $extension;
 		$file_path = $upload_path . $NomorSurat . "-" . $id_foto . '.'. $extension; 
		move_uploaded_file($_FILES['image']['tmp_name'],$file_path);
		$sql = "INSERT INTO `foto` (`nomor_surat`,`url`) VALUES ('$NomorSurat','$file_url');";
		mysqli_query($con,$sql);
		mysqli_close($con);
 	}
 ?>
