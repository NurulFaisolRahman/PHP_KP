<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$NomorSurat = $_GET["NomorSurat"];
	$SubBidang = $_GET["SubBidang"];
	$NamaBidang = $_GET["NamaBidang"];
	$BidangTujuan = explode("/", $SubBidang);
	$sub1=$sub2=$sub3="";
	foreach ($BidangTujuan as $NamaKolom) {
		if($NamaKolom == "spkp"){
			$sub1 = "spkp";
		}else if($NamaKolom == "spip"){
			$sub2 = "spip";
		}else if($NamaKolom == "spmk"){
			$sub3 = "spmk";
		}
		else if($NamaKolom == "sst"){
			$sub1 = "sst";
		}else if($NamaKolom == "set"){
			$sub2 = "set";
		}else if($NamaKolom == "sds"){
			$sub3 = "sds";
		}
		else if($NamaKolom == "skp"){
			$sub1 = "skp";
		}else if($NamaKolom == "spe"){
			$sub2 = "spe";
		}else if($NamaKolom == "sijt"){
			$sub3 = "sijt";
		}
	}
	$query = "DELETE FROM `$NamaBidang` WHERE nomor_surat='$NomorSurat'";
	mysqli_query($koneksi,$query);
	if(sizeof($BidangTujuan)==1){
		if (!empty($sub1)) {
			$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub1`) values ('$NomorSurat', 'Disposisi', '0');";
		} 
		else if (!empty($sub2)) {
			$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub2`) values ('$NomorSurat', 'Disposisi', '0');";
		}
		else if (!empty($sub3)) {
			$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub3`) values ('$NomorSurat', 'Disposisi', '0');";
		} 
	}else if(sizeof($BidangTujuan)==2){
		if (empty($sub3)) {
			$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub1`, `$sub2`) values ('$NomorSurat', 'Disposisi', '0', '0');";
		}
		else if (empty($sub2)) {
			$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub1`, `$sub3`) values ('$NomorSurat', 'Disposisi', '0', '0');";
		}
		else if (empty($sub1)) {
			$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub2`, `$sub3`) values ('$NomorSurat', 'Disposisi', '0', '0');";
		}
	}else if(sizeof($BidangTujuan)==3){
		$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub1`, `$sub2`, `$sub3`) values ('$NomorSurat', 'Disposisi', '0', '0', '0');";
	}
	if(mysqli_query($koneksi,$sql)){
		echo json_encode(array("respon" => "sukses"));
	}
	mysqli_close($koneksi);
 ?>