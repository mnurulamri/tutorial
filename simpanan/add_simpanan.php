<?
if ($_POST) 
{
	include('../koneksi/conn.php');

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

	$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah)
			VALUES 
				($id_anggota, '$tgl', 41, 'D', $wajib),
				($id_anggota, '$tgl', 32, 'D', $sukarela)";
	mysql_query($sql) or die(mysql_error());

	include('data_simpanan.php');

} else {
	echo 'something error..';
}

?>