Cek:
<form name="formInquiry" method="post" action="<?=htmlentities($_SERVER['PHP_SELF'])?>">
	<select name="bulan">
		<option value="05">Mei</option>
		<option value="06">Juni</option>
		<option value="07">Juli</option>
		<option value="08">Agustus</option>
		<option value="09">September</option>
		<option value="10">Oktober</option>
		<option value="11">Nopember</option>
		<option value="12">Desember</option>
	</select>
	<select name="tahun">
		<option value="16">2016</option>
		<option value="15">2015</option>
	</select>
	<input type="submit" value="submit">
</form>

Upload Simpanan Wajib:
<form name="formUploadSimpananWajib" method="post" action="proses_upload_simpanan.php">
	<select name="bulan">
		<option value="05">Mei</option>
		<option value="06">Juni</option>
		<option value="07">Juli</option>
		<option value="08">Agustus</option>
		<option value="09">September</option>
		<option value="10">Oktober</option>
		<option value="11">Nopember</option>
		<option value="12">Desember</option>
	</select>
	<select name="tahun">
		<option value="16">2016</option>
		<option value="15">2015</option>
	</select>
	<input type="submit" value="submit">
</form>

Upload Simpanan Sukarela:
<form name="formUploadSimpananSukarela" method="post" action="proses_upload_simpanan_sukarela.php">
	<select name="bulan">
		<option value="05">Mei</option>
		<option value="06">Juni</option>
		<option value="07">Juli</option>
		<option value="08">Agustus</option>
		<option value="09">September</option>
		<option value="10">Oktober</option>
		<option value="11">Nopember</option>
		<option value="12">Desember</option>
	</select>
	<select name="tahun">
		<option value="16">2016</option>
		<option value="15">2015</option>
	</select>
	<input type="submit" value="submit">
</form>

<?
include('../koneksi/conn.php');

if ($_POST) {
	$bulan = sanitasi($_POST['bulan']);
	$tahun = sanitasi($_POST['tahun']);
}

$sql = "SELECT b.bulan, c.nama, c.gender, a.*, substr(tgl_posting,4,2) as bulan, substr(tgl_posting,7,2) as tahun
		FROM x_pot a
		INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
		LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
		WHERE realisasi > 0 AND  simpanan_wajib > 0 AND substr(tgl_posting,4,2) = '$bulan' AND substr(tgl_posting,7,2) = '$tahun'
		ORDER BY a.kd_bulan, a.tgl, c.nama";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$data_simp_wajib[] = $row;
}

$sql = "SELECT b.bulan, c.nama, c.gender, a.*
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
$html_simp_wajib= '
<table border="1" cellspacing="0">
	<tr>
		<td>ID Anggota</td>
		<td>Tgl Setor</td>
		<td>Simpanan Wajib</td>
		<td>Realisasi</td>
	</tr>';
foreach ($data_simp_wajib as $k => $v) {
	$html_simp_wajib.= '
	<tr>
		<td>'.$i.'</td>
		<td>'.$v['id_anggota'].'</td>
		<td class="item">'.post_date($v['tgl_posting']).'</td>
		<td class="item">'.number_format($v['simpanan_wajib']).'</td>
		<td>'.$v['bulan'].'</td>
		<td>'.$v['tahun'].'</td>
	</tr>
	';
	$i++;
}
$html_simp_wajib.= '</table>';

$i=1;
$html_simp_sukarela= '
<table border="1" cellspacing="0">
	<tr>
		<td>ID Anggota</td>
		<td>Tgl Setor</td>
		<td>Simpanan Sukarela</td>
		<td>Realisasi</td>
	</tr>';
foreach ($data_simp_sukarela as $k => $v) {
	$html_simp_sukarela.= '
	<tr>
		<td>'.$i.'</td>
		<td>'.$v['id_anggota'].'</td>
		<td class="item">'.$v['tgl_posting'].'</td>
		<td class="item">'.number_format($v['simpanan_sukarela']).'</td>
		<td>'.$v['realisasi'].'</td>
	</tr>
	';
	$i++;
}
$html_simp_sukarela.= '</table>';

echo '
<table>
	<tr>
		<td style="vertical-align:top">'.$html_simp_wajib.'</td>
		<td style="vertical-align:top">'.$html_simp_sukarela.'</td>
	</tr>
</table>
';

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

/* untuk upload
SELECT case when simpanan_wajib > 0 then '' else '' end as id_in, id_anggota, 
	concat(tahun,'-',kd_bulan,'-0',tgl) as tgl_transaksi, 
	case when simpanan_wajib > 0 then 41 else 0 end as jenis_id, 
	case when simpanan_wajib > 0 then 'D' else '0' end as dk, 
	simpanan_wajib,
	concat(tahun,'-',kd_bulan,'-0',tgl) as tgl_simpanan
FROM `x_pot` 
WHERE simpanan_wajib > 0 and realisasi > 0 and tgl=1 and kd_bulan='02' and tahun = 2017

SELECT case when simpanan_sukarela > 0 then '' else '' end as id_in, 
	id_anggota, concat(tahun,'-',kd_bulan,'-0',tgl) as tgl_transaksi, 
	case when simpanan_sukarela > 0 then 32 else 0 end as jenis_id,
	case when simpanan_sukarela > 0 then 'D' else '0' end as dk,
	simpanan_sukarela, 
	concat(tahun,'-',kd_bulan,'-0',tgl) as tgl_simpanan 
FROM `x_pot` WHERE simpanan_sukarela > 0 and realisasi > 0 and tgl=1 and kd_bulan='02' and tahun = 2017
*/
?>