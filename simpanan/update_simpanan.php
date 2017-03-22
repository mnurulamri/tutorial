<?
if ($_POST) 
{
	include('../koneksi/conn.php');
	include('../sanitasi.php');

	if (isset($_POST['id_wajib'])){
		$id_wajib = sanitasi($_POST['id_wajib']);
	} else {
		$id_wajib = 0;
	}
	if (isset($_POST['id_sukarela'])){
		$id_sukarela = sanitasi($_POST['id_sukarela']);
	}  else {
		$id_sukarela = 0;
	}
	if (isset($_POST['id_anggota'])){
		$id_anggota = sanitasi($_POST['id_anggota']);
	} 
	if (isset($_POST['tgl'])){
		$tgl = sanitasi($_POST['tgl']);
	} 
	if (isset($_POST['wajib'])){
		$wajib = sanitasi($_POST['wajib']);
		$wajib = str_replace(',', '', $wajib);
	} 
	if (isset($_POST['sukarela'])){
		$sukarela = sanitasi($_POST['sukarela']);
		$sukarela = str_replace(',', '', $sukarela);
	} 

	/*
	$id_anggota = $_POST['id_anggota'];
	$tgl = $_POST['tgl'];
	$wajib = $_POST['wajib'];
	$sukarela = $_POST['sukarela'];

	$id_anggota = stripslashes($id_anggota);
	$tgl = stripslashes($tgl);
	$wajib = stripslashes($wajib);
	$sukarela = stripslashes($sukarela);
	$id_anggota = mysql_real_escape_string($id_anggota);
	$tgl = mysql_real_escape_string($tgl);
	$wajib = mysql_real_escape_string($wajib);
	$sukarela = mysql_real_escape_string($sukarela);
	*/
	//setor simpanan
	if($_POST['crud'] == 1)
	{
		//echo $id_anggota.'<br>';
		//echo cek_tgl_dobel($tgl, $id_anggota);
		if(cek_tgl_dobel($tgl,$id_anggota) > 0){
			echo '
			<script>
			alert("Data simpanan sudah ada!..")
			</script>
			';			
			include('data_simpanan.php');
			exit();
		} else {
			$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
					VALUES 
						($id_anggota, '$tgl', 41, 'D', $wajib),
						($id_anggota, '$tgl', 32, 'D', $sukarela)";
			//echo $sql;
			query($sql);
		}

	//edit simpanan
	} elseif($_POST['crud'] == 2) {
		
		//echo $id_wajib.' '.$id_sukarela;
		//jika id simpanan wajib = 0 atau recordnya tidak ada di dalam tabel, maka insert record baru
		if ($id_wajib == 0 AND $id_sukarela == 0) {
			//tambah simpanan wajib
			$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
					VALUES ($id_anggota, '$tgl', 41, 'D', $wajib)";
			//echo $sql.'<br>';
			query($sql);
			//tambah simpanan sukarela
			$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
					VALUES ($id_anggota, '$tgl', 32, 'D', $sukarela)";
			//echo $sql.'<br>';
			query($sql);		
		} elseif($id_wajib != 0 AND $id_sukarela == 0){
			//update simpanan wajib
			$sql = "UPDATE x_simpanan SET tgl_transaksi = '$tgl', jumlah = $wajib
					WHERE id = $id_wajib";
			//echo $sql.'<br>';
			query($sql);
			//tambah simpanan sukarela
			$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
					VALUES ($id_anggota, '$tgl', 32, 'D', $sukarela)";
			//echo $sql.'<br>';
			query($sql);
		} elseif($id_wajib == 0 AND $id_sukarela != 0){  //jika id simpanan wajib > 0 atau recordnya sudah ada di dalam tabel, maka update record
			//tambah simpanan wajib
			$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
					VALUES ($id_anggota, '$tgl', 41, 'D', $wajib)";
			//echo $sql.'<br>';
			query($sql);			
			//update simpanan sukarela
			$sql = "UPDATE x_simpanan SET tgl_transaksi = '$tgl', jumlah = $sukarela
					WHERE id = $id_sukarela";
			//echo $sql.'<br>';
			query($sql);
		} elseif($id_wajib != 0 AND $id_sukarela != 0){  //jika id simpanan wajib > 0 atau recordnya sudah ada di dalam tabel, maka update record
			$sql = "UPDATE x_simpanan SET tgl_transaksi = '$tgl', jumlah = $wajib
					WHERE id = $id_wajib";
			//echo $sql.'<br>';
			query($sql);
			$sql = "UPDATE x_simpanan SET tgl_transaksi = '$tgl', jumlah = $sukarela
					WHERE id = $id_sukarela";
			//echo $sql.'<br>';
			query($sql);
		}

	//ambil simpanan
	} elseif($_POST['crud'] == 3) {
		if(cek_tgl_dobel($tgl,$id_anggota) != 0){
			echo '
			cek_tgl_dobel($tgl,$id_anggota)
			<script>
			alert("Data simpanan sudah ada!..")
			</script>
			';			
			include('data_simpanan.php');
			exit();
		} else {
			$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
					VALUES 
						($id_anggota, '$tgl', 41, 'K', $wajib),
						($id_anggota, '$tgl', 32, 'K', $sukarela)";
			
				//echo $sql.'<br>';
				query($sql);			
		}


	//delete simpanan
	} elseif($_POST['crud'] == 4) {
		$sql = "DELETE FROM x_simpanan WHERE id in ($id_wajib, $id_sukarela)";
			//echo $sql.'<br>';
			query($sql);
	}
}

function query($sql){
	mysql_query($sql) or die(mysql_error());	
}

function cek_tgl_dobel($tgl, $id_anggota){
	$sql = "SELECT count(id) as numrow FROM x_simpanan WHERE id_anggota = '$id_anggota' AND tgl_transaksi = '$tgl'";
	$result = mysql_query($sql) or die('error: '.mysql_errno());
	while ($row = mysql_fetch_assoc($result)) {
		$num_row = $row['numrow'];
	}
	//$num_row = mysql_num_rows($result);
	return $num_row;
}

include('data_simpanan.php');
?>