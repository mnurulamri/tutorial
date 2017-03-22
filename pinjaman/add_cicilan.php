<?
if ($_POST) 
{
	include('../koneksi/conn.php');

	$id_anggota = $_POST['id_anggota'];
	$tgl = $_POST['tgl'];
	$pokok = $_POST['pokok'];
	$jasa = $_POST['jasa'];

	$id_anggota = stripslashes($id_anggota);
	$tgl = stripslashes($tgl);
	$pokok = stripslashes($pokok);
	$jasa = stripslashes($jasa);
	$id_anggota = mysql_real_escape_string($id_anggota);
	$tgl = mysql_real_escape_string($tgl);
	$pokok = mysql_real_escape_string($pokok);
	$jasa = mysql_real_escape_string($jasa);

	$sql = "INSERT INTO x_pinjaman_koperasi (id_anggota, tgl_transaksi, kd_pinjam, kredit)
			VALUES 
				($id_anggota, '$tgl', 2, $pokok),
				($id_anggota, '$tgl', 3, $jasa)";
	mysql_query($sql) or die(mysql_error());

	include('data_pinjaman.php');

} else {
	echo 'something error..';
}

?>