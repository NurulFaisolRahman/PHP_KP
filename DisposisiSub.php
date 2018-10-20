<?php 
	$koneksi = mysqli_connect('localhost','root','','disposisi');
	$NomorSurat = $_GET["NomorSurat"];
	$SubBidang = $_GET["SubBidang"];
	$NamaBidang = $_GET["NamaBidang"];
	$BidangTujuan = explode("/", $SubBidang);
	$sub = array();
	foreach ($BidangTujuan as $NamaKolom) {
		if($NamaKolom == "spkp"){
			array_push($sub, "spkp");
		}else if($NamaKolom == "spip"){
			array_push($sub, "spip");
		}else if($NamaKolom == "spmk"){
			array_push($sub, "spmk");
		}else if($NamaKolom == "sst"){
			array_push($sub, "sst");
		}else if($NamaKolom == "set"){
			array_push($sub, "set");
		}else if($NamaKolom == "sds"){
			array_push($sub, "sds");
		}else if($NamaKolom == "skp"){
			array_push($sub, "skp");
		}else if($NamaKolom == "spe"){
			array_push($sub, "spe");
		}else if($NamaKolom == "sijt"){
			array_push($sub, "sijt");
		}else if($NamaKolom == "spk"){
			array_push($sub, "spk");
		}else if($NamaKolom == "suk"){
			array_push($sub, "suk");
		}else if($NamaKolom == "ikp"){
			array_push($sub, "ikp");
		}else if($NamaKolom == "aptika"){
			array_push($sub, "aptika");
		}else if($NamaKolom == "sdtik"){
			array_push($sub, "sdtik");
		}
	}

	if(sizeof($BidangTujuan)==1){
		$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub[0]`) values ('$NomorSurat', 'Disposisi', '0');";
	}else if(sizeof($BidangTujuan)==2){
		$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub[0]`, `$sub[1]`) values ('$NomorSurat', 'Disposisi', '0', '0');";
	}else if(sizeof($BidangTujuan)==3){
		$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub[0]`, `$sub[1]`, `$sub[2]`) values ('$NomorSurat', 'Disposisi', '0', '0', '0');";
	}
	else if(sizeof($BidangTujuan)==4){
		$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub[0]`, `$sub[1]`, `$sub[2]`, `$sub[3]`) values ('$NomorSurat', 'Disposisi', '0', '0', '0', '0');";
	}
	else if(sizeof($BidangTujuan)==5){
		$sql = "insert into `$NamaBidang` (`nomor_surat`, `status`, `$sub[0]`, `$sub[1]`, `$sub[2]`, `$sub[3]`, `$sub[4]`) values ('$NomorSurat', 'Disposisi', '0', '0', '0', '0', '0');";
	}
	if ($NamaBidang == "sekretaris") {
		$Bidang = "select bidang from surat where nomor_surat = '$NomorSurat'";
		$DataBidang = mysqli_query($koneksi,$Bidang);
		$Data = $DataBidang->fetch_object()->bidang;
		$PecahBidang = explode("/", $Data);
		$ArrayBidang = array("sekretaris","ikp","aptika","sdtik");
		foreach ($sub as $data) {
			if (in_array($data, $ArrayBidang) && !in_array($data, $PecahBidang)) {
				$Data .= "/".$data;
			}
		}
		$update = "UPDATE surat SET bidang = '$Data'";
		mysqli_query($koneksi,$update);
	}
	if(mysqli_query($koneksi,$sql)){
		echo json_encode(array("respon" => "sukses"));
	}
	mysqli_close($koneksi);
 ?>