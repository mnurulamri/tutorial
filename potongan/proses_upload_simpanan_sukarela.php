<?
include('../koneksi/conn.php');

if ($_POST) {
	$bulan = sanitasi($_POST['bulan']);
	$tahun = sanitasi($_POST['tahun']);
}

echo $bulan.' '.$tahun;
$sql = "SELECT b.bulan, c.nama, c.gender, a.*, substr(tgl_posting,4,2) as bulan, substr(tgl_posting,7,2) as tahun
		FROM x_pot a
		INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
		LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
		WHERE realisasi > 0 AND  simpanan_sukarela > 0 AND substr(tgl_posting,4,2) = '$bulan' AND substr(tgl_posting,7,2) = '$tahun'
		ORDER BY a.kd_bulan, a.tgl, c.nama";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$data_simp_sukarela[] = $row;
}

$i=1;
echo '
<table border="1" cellspacing="0">
	<tr>
		<td>ID Anggota</td>
		<td>Tgl Setor</td>
		<td>Simpanan Sukarela</td>
		<td>Realisasi</td>
	</tr>';
foreach ($data_simp_sukarela as $k => $v) {
	$id_anggota = $v['id_anggota'];
	$tgl_transaksi = post_date($v['tgl_posting']);
	$tgl_simpanan = post_date($v['tgl_posting']);
	$simp_sukarela = $v['simpanan_sukarela'];
	echo '
	<tr>
		<td>'.$i.'</td>
		<td>'.$id_anggota.'</td>
		<td class="item">'.$tgl_transaksi.'</td>
		<td class="item">'.number_format($v['simpanan_sukarela']).'</td>
		<td>'.$v['bulan'].'</td>
		<td>'.$v['tahun'].'</td>
	</tr>
	';

	$sql = "INSERT INTO x_simpanan (id_anggota, tgl_transaksi, jenis_id, dk, jumlah, tgl_simpanan)
			VALUES ('$id_anggota', '$tgl_transaksi', '32', 'D', '$simp_sukarela', '$tgl_transaksi')";
	$result = $mysqli->query($sql) or die($mysqli->error);

	$i++;
}
echo '</table>';


function post_date($string){
	$array = explode(" ", $string);
	$string = $array[0];
	$array = explode("/", $string);
	$tahun = '20'.$array[2];
	$bulan = $array[1];
	$tgl = $array[0];
	return $tahun.'-'.$bulan.'-'.$tgl;
}

function sanitasi($string){
	$string = stripslashes($string);
	$string = mysql_real_escape_string($string);
	return $string;
}
?>