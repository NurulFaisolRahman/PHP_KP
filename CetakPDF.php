<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			font-family: "Times New Roman", Times, serif;
		}
	</style>
	<title></title>
</head>
<body>
	<?php
		$tanggal_disposisi = $_GET["Tanggal"];
		$surat_dari=$tanggal_surat=$nomor_surat=$diterima_tanggal=$nomor_agenda=$sifat=$perihal=$bidang=$isi= "";
		$conn = mysqli_connect("localhost", "root", "", "disposisi");
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$NomorSurat = $_GET['NomorSurat'];
		$sql = "SELECT * FROM surat where nomor_surat = '$NomorSurat'";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) == 1) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$surat_dari = $row["surat_dari"];
		    	$tanggal_surat = $row["tanggal_surat"];
		    	$nomor_surat = $row["nomor_surat"];
		    	$diterima_tanggal = $row["diterima_tanggal"];
		    	$nomor_agenda = $row["nomor_agenda"];
		    	$sifat = $row["sifat"];
		    	$perihal = $row["perihal"];
		    	$bidang = $row["bidang"];
		    	$isi = $row["isi_disposisi"];
		    	$NamaBidang = explode("/", $bidang);
		    }
		}
		mysqli_close($conn);
	?> 
	<form>
		<table style="margin: auto;">
			<tr>
				<td style="width: 110px; vertical-align: middle; padding-bottom: 10px; " rowspan="2" height="10" > <img src="logo.jpg" alt="logo"></td>
				<td style="width: 470px; vertical-align: middle;"><b style="font-size: 20px;">PEMERINTAH KABUPATEN BANGKALAN</b><br><b style="font-size: 20px;">DINAS KOMUNIKASI DAN INFORMATIKA</b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;"></td>
			</tr>
		</table>
		<span><hr style="margin-top: -25px;" ></span>
		<div style="text-align: center; font-size: 15px;"><b><u>LEMBAR DISPOSISI</u></b></div>
		<?php session_start(); ?>
		<table border="1px" style="margin: auto; ">

			<tr>
				<td style="width: 85px;padding: 5px;">Surat Dari</td>
				<td>:</td>
				<td style="width: 150px;padding: 5px;"><? echo $surat_dari; ?></td>
				<td style="width: 115px;padding: 5px;">Diterima Tanggal</td>
				<td>:</td>
				<td style="width: 150px;padding: 5px;"><? echo $diterima_tanggal; ?></td>
			</tr>
			<tr>
				<td style="padding: 5px;">Tanggal Surat</td>
				<td>:</td>
				<td style="padding: 5px;"><? echo $tanggal_surat; ?></td>
				<td style="padding: 5px;">Nomor Agenda</td>
				<td>:</td>
				<td style="padding: 5px;"><? echo $nomor_agenda; ?></td>
			</tr>
			<tr>
				<td style="padding: 5px;">Nomor Surat</td>
				<td>:</td>
				<td style="padding: 5px;"><? echo $nomor_surat; ?></td>
				<td style="padding: 5px;">Sifat</td>
				<td>:</td>
				<td style="padding: 5px;"><? echo $sifat; ?></td>
			</tr>
			<tr>
				<td style="padding: 5px; vertical-align: top;">Perihal</td>
				<td style=" vertical-align: top;">:</td>
				<td colspan="4" style=" padding: 5px; height: vertical-align: top;"><? echo $perihal; ?></td>
			</tr>
			<tr>
				<td colspan="3" style="padding: 5px;">Diteruskan kepada sdr. : </td>
				<td colspan="3" style="text-align: center;">ISI DISPOSISI : </td>
			</tr>
			<tr>
				<td colspan="3" style="padding: 5px; height: 70px; vertical-align: top; "><?php 
						foreach ($NamaBidang as $data) {
							if ($data == "sekretaris") {
								echo "Bidang Sekretaris"."<br>";
							} 
							else if ($data == "ikp") {
								echo "Bidang IKP"."<br>";
							} 
							else if ($data == "aptika") {
								echo "Bidang Aplikasi dan Informatika"."<br>";
							}
							else if ($data == "sdtik") {
								echo "Bidang SD-TIK"."<br>";
							}
						}
					 ?>	
				</td>
				<td colspan="3" rowspan="4" style="vertical-align: top; padding: 5px;"><?php 
					 echo $isi."<br>"."<img src='logo.jpg' style='width: 50px;height: 50px;'>".$tanggal_disposisi; ?>	</td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php
	$filename="Disposisi_".$nomor_surat.".pdf";
	$content = ob_get_clean();
	$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
	require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	try{
		$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(20, 0, 20, 0));
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { 
		echo $e; 
	}
?>

