<?php

if(!session_id()) session_start();

$tgl = $_SESSION['tgl'];
$bulan = $_SESSION['bulan'];
$tahun = $_SESSION['tahun'];

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
			WHERE a.tgl = '$tgl' AND a.kd_bulan = '$bulan' AND a.tahun = '$tahun'
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
		$realisasi = $value->realisasi;
		$metode = $value->metode;
		$tgl_posting = $value->tgl_posting;
		$no_cabang = $value->no_cabang;
		$no_jurnal = $value->no_jurnal;
		$admin_bank = $value->admin_bank;
		$cicilan_kop_ke = $value->cicilan_kop_ke;
		$cicilan_kop_jml = $value->cicilan_kop_jml;

		$sql ="UPDATE x_pot 
				SET realisasi = '$realisasi', 
					metode = '$metode',
					tgl_posting = '$tgl_posting',
					no_cabang = '$no_cabang',
					no_jurnal = '$no_jurnal',
					admin_bank = '$admin_bank',
					cicilan_kop_ke = '$cicilan_kop_ke',
					cicilan_kop_jml = '$cicilan_kop_jml'
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

