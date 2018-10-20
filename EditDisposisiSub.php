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
		$CekBidang = "select ikp,aptika,sdtik from sekretaris where nomor_surat = '$NomorSurat'";
		$Cek = mysqli_query($koneksi,$CekBidang);
		$Cek = mysqli_fetch_row($Cek);
		$Pilihan = array();
		if ($Cek[0] == '0') {
			array_push($Pilihan, "ikp");
		}
		if ($Cek[1] == '0') {
			array_push($Pilihan, "aptika");
		}
		if ($Cek[2] == '0') {
			array_push($Pilihan, "sdtik");
		}
		$Bidang = "select bidang from surat where nomor_surat = '$NomorSurat'";
		$DataBidang = mysqli_query($koneksi,$Bidang);
		$Data = $DataBidang->fetch_object()->bidang;
		$PecahBidang = explode("/", $Data);
		$BidangKadis = array_diff($PecahBidang, $Pilihan);
		$BidangBaru = "";
		for ($i=0; $i < sizeof($BidangKadis); $i++) { 
			if ($i == 0) {
				$BidangBaru .= $BidangKadis[$i];
			} 	
			else {
				$BidangBaru .= "/".$BidangKadis[$i];
			}
		} 
		$ArrayBidang = array("sekretaris","ikp","aptika","sdtik");
		foreach ($sub as $data) {
			if (in_array($data, $ArrayBidang) && !in_array($data, $BidangKadis)) {
				$BidangBaru .= "/".$data;
			}
		}
		$update = "UPDATE surat SET bidang = '$BidangBaru' WHERE nomor_surat = '$NomorSurat'";
		mysqli_query($koneksi,$update);
		foreach ($Pilihan as $bidang) {
			if (!in_array($bidang, $sub)) {
				$Hapus = "DELETE from $bidang WHERE nomor_surat = '$NomorSurat'";
				mysqli_query($koneksi,$Hapus);
			}
		}
	}
	$query = "DELETE FROM `$NamaBidang` WHERE nomor_surat='$NomorSurat'";
	mysqli_query($koneksi,$query);
	if(mysqli_query($koneksi,$sql)){
		echo json_encode(array("respon" => "sukses"));
	}
	mysqli_close($koneksi);
 ?>