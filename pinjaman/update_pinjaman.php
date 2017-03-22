<?
if ($_POST) 
{
	
	include('../koneksi/conn.php');
	include('../sanitasi.php');

	if (isset($_POST['id_anggota'])){
		$id_anggota = sanitasi($_POST['id_anggota']);
	}
	if (isset($_POST['id_pinjam'])){
		$id_pinjam = sanitasi($_POST['id_pinjam']);
	} else {
		$id_pinjam = 0;
	}
	if (isset($_POST['id_pokok_cicilan'])){
		$id_pokok_cicilan = sanitasi($_POST['id_pokok_cicilan']);
	} else {
		$id_pokok_cicilan = 0;
	}
	if (isset($_POST['id_jasa'])){
		$id_jasa = sanitasi($_POST['id_jasa']);
	}  else {
		$id_jasa = 0;
	}
	if (isset($_POST['id_anggota'])){
		$id_anggota = sanitasi($_POST['id_anggota']);
	} 
	if (isset($_POST['tgl'])){
		$tgl = sanitasi($_POST['tgl']);
	} 
	if (isset($_POST['pinjam'])){
		$pinjam = sanitasi($_POST['pinjam']);
	} 
	if (isset($_POST['pokok_cicilan'])){
		$pokok_cicilan = sanitasi($_POST['pokok_cicilan']);
	} 
	if (isset($_POST['jasa'])){
		$jasa = sanitasi($_POST['jasa']);
	} 
	/*
	$id_anggota = stripslashes($id_anggota);
	$tgl = stripslashes($tgl);
	$wajib = stripslashes($wajib);
	$sukarela = stripslashes($sukarela);
	$id_anggota = mysql_real_escape_string($id_anggota);
	$tgl = mysql_real_escape_string($tgl);
	$wajib = mysql_real_escape_string($wajib);
	$sukarela = mysql_real_escape_string($sukarela);
	*/
	
	
	if($_POST['crud'] == '1') //input data cicilan dan jasa koperasi
	{
		cek_tgl_dobel_cicilan($tgl);

		$sql = "INSERT INTO x_pinjaman_koperasi (id_anggota, tgl_transaksi, kd_pinjam, kredit)
				VALUES 
					($id_anggota, '$tgl', 2, $pokok_cicilan),
					($id_anggota, '$tgl', 3, $jasa)";
		//echo $sql;
		query($sql);
	
	} elseif($_POST['crud'] == 2) {  //tambah pinjaman
		if ( $pokok_cicilan == 0 OR $jasa == 0 ) {
			cek_tgl_dobel_pinjaman($tgl);
			$sql = "INSERT INTO x_pinjaman_koperasi (id_anggota, tgl_transaksi, kd_pinjam, debet)
					VALUES 
						($id_anggota, '$tgl', 1, $pinjam)";
			//echo $sql;
			query($sql);
		}
	
	//ambil simpanan
	} elseif($_POST['crud'] == 3) {
		$sql = "INSERT INTO x_pinjaman_koperasi (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
				VALUES 
					($id_anggota, '$tgl', 41, 'K', $wajib),
					($id_anggota, '$tgl', 32, 'K', $sukarela)";
		
		echo $sql;
		//query($sql);

	//delete simpanan
	} elseif($_POST['crud'] == 4) {
		if($id_pokok_cicilan > 0 AND $id_jasa == 0){  //hapus data pinjaman
			$sql = "DELETE FROM x_pinjaman_koperasi WHERE id  = $id_pokok_cicilan";
		} elseif($id_pokok_cicilan > 0 AND $id_jasa > 0){  //hapus data cicilan dan jasa
			$sql = "DELETE FROM x_pinjaman_koperasi WHERE id in ($id_pokok_cicilan, $id_jasa)";
		}
		
		//echo $sql;
		query($sql);
	}
}

function query($sql){
	mysql_query($sql) or die(mysql_error());
}

function cek_tgl_dobel_pinjaman($tgl){
	$sql = "SELECT id FROM x_pinjaman_koperasi WHERE tgl_transaksi = '$tgl' AND id_anggota = '$id_anggota' AND kd_pinjam = '1'";
	$result = mysql_query($sql) or die(mysql_error());
	$num_row = mysql_num_rows($result);
	if($num_row > 0){
		echo 'Tanggal sudah ada!';
		exit;
	}
}

function cek_tgl_dobel_cicilan($tgl){
	$sql = "SELECT id FROM x_pinjaman_koperasi WHERE tgl_transaksi = '$tgl' AND id_anggota = '$id_anggota' AND kd_pinjam = '2'";
	$result = mysql_query($sql) or die(mysql_error());
	$num_row = mysql_num_rows($result);
	if($num_row > 0){		
		echo 'Tanggal sudah ada!';
		include('data_pinjaman_03.php');
		exit;
	}
}

include('data_pinjaman_03.php');

/*
if ($_POST) 
{

} else {
	echo 'something error..';
}
*/
?>