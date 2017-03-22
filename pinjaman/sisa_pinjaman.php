<?
include('../koneksi/conn.php');

if ($_POST) 
{
	$id_anggota = $_POST['id_anggota'];
	$sql = "SELECT SUM(debet) - SUM(kredit) as sisa_pinjaman
			FROM x_pinjaman_koperasi
			WHERE kd_pinjam in (1, 2) AND id_anggota = $id_anggota";
	$result = mysql_query($sql) or die(mysql_error());

	while ($row = mysql_fetch_assoc($result)) {
		$data = $row['sisa_pinjaman'];
	}

	if ($data) {
		echo $data;
	} else {
		echo '0';
	}
	
}

?>