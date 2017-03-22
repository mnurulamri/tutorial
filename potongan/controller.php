<?php

if(!session_id()) session_start();

$tgl = $_SESSION['tgl'];
$bulan = $_SESSION['bulan'];
$tahun = $_SESSION['tahun'];
$pegawai = $_SESSION['pegawai'];

include('../koneksi/conn.php');

//include("bulan.php");

//include("flag.php");

header('Content-type:text/javascript;charset=UTF-8');

$json=json_decode(stripslashes($_POST["_gt_json"]));//$pageNo = $json->{'pageInfo'}->{'pageNum'};

if($json->{'action'} == 'load'){

	$sql = "SELECT b.bulan, c.norek, c.nama, c.gender, a.*
			FROM x_pot a
			INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
			LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
			WHERE a.tgl = '$tgl' AND a.kd_bulan = '$bulan' AND a.tahun = '$tahun' AND c.flag_pegawai = '$pegawai'
			ORDER BY a.kd_bulan, a.tgl, c.nama";

	$handle = $mysqli->query($sql)  or die($mysqli->error) ;

	$retArray = array();

	while ($row = $handle->fetch_object()) {
		$retArray[] = $row;
	}

	$data = json_encode($retArray);
	$ret = "{data:" . $data .",\n";
	$ret .= "recordType : 'object'}";
	echo $ret;
}

else if($json->{'action'} == 'save'){

	$sql = "";
	$params = array();
	$errors = "geblek";

	/*deal with those deleted
	$deletedRecords = $json->{'deletedRecords'};
	foreach ($deletedRecords as $value){
	$sql = "delete from data where ...  ='".$value->... ."'";
	$mysqli->query($sql)  or die($mysqli->error) ;
	}*/
	//deal with those updated

	$sql = "";
	$updatedRecords = $json->{'updatedRecords'};
	foreach ($updatedRecords as $value){
		$id = $value->id;
		$dplk = $value->dplk;
		$simpanan_wajib = $value->simpanan_wajib;
		$simpanan_sukarela = $value->simpanan_sukarela;
		$cicilan_koperasi = $value->cicilan_koperasi;
		$jasa = $value->jasa;
		$bkc = $value->bkc;
		$bsm = $value->bsm;
		$bke = $value->bke;
		$danamon = $value->danamon;
		$bri = $value->bri;
		$bukopin = $value->bukopin;
		$amal = $value->amal;
		$total = $value->total;
		$realisasi = $value->realisasi;
		$cicilan_kop_ke = $value->cicilan_kop_ke;
		$cicilan_kop_jml = $value->cicilan_kop_jml;

		$sql ="UPDATE x_pot 
				SET dplk = $dplk, 
					simpanan_wajib = $simpanan_wajib,
					simpanan_sukarela = $simpanan_sukarela,
					cicilan_koperasi = $cicilan_koperasi,
					jasa = $jasa,
					bkc = $bkc,
					bsm = $bsm,
					bke = $bke,
					danamon = $danamon,
					bri = $bri,
					bukopin = $bukopin,
					amal = $amal,
					total = $total,
					realisasi = $realisasi,
					cicilan_kop_ke = $cicilan_kop_ke,
					cicilan_kop_jml = $cicilan_kop_jml
				WHERE id = $id";
		
		$mysqli->query($sql)  or die($mysqli->error) ;
	}

	//deal with those inserted
	$sql = "";
	$insertedRecords = $json->{'insertedRecords'};

	foreach ($insertedRecords as $value){
		$sql = "insert into data (`...`, `...`) VALUES ('".$value->NamaPengajar."','".$value->KodeKelas."')";
		$mysqli->query($sql) or die($mysqli->error) ;
	}

	$ret = "{success : true,exception:''}";
	echo $ret;  
} 

?>

