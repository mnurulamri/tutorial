<?
include('../koneksi/conn.php');

if ($_POST) {
	$bulan = sanitasi($_POST['bulan']);
	$tahun = sanitasi($_POST['tahun']);
}

//ambil data anggota
$sql = "SELECT DISTINCT a.id_anggota as id_anggota, tgl_transaksi, nama
		FROM x_simpanan a
		LEFT JOIN x_norek b ON a.id_anggota = b.id_anggota
		WHERE month(tgl_transaksi) = $bulan AND YEAR(tgl_transaksi)=$tahun
		ORDER BY tgl_transaksi, nama";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	//$data_anggota[$row['tgl_transaksi']][$row['id_anggota']] = $row['id_anggota'];
	$data_anggota[$row['tgl_transaksi']][$row['id_anggota']] = array('wajib'=>0, 'sukarela'=>0);
}

$sql = "SELECT a.id_anggota, tgl_transaksi, nama, jenis_id, dk, jumlah
		FROM x_simpanan a
		LEFT JOIN x_norek b ON a.id_anggota = b.id_anggota
		WHERE month(tgl_transaksi) = $bulan AND YEAR(tgl_transaksi)=$tahun
		ORDER BY tgl_transaksi, nama";

$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$nama_anggota[$row['id_anggota']] = $row['nama'].'<br>';
	//pisahkan data simpanan wajib dan sukarela
	if ($row['jenis_id'] == 41) {
		$data_simp_wajib[$row['tgl_transaksi']][$row['id_anggota']] = array('dk'=>$row['dk'], 'jumlah'=>$row['jumlah']);
	} else if ($row['jenis_id'] == 32){
		$data_simp_sukarela[$row['tgl_transaksi']][$row['id_anggota']] = array('dk'=>$row['dk'], 'jumlah'=>$row['jumlah']);
	}	
}

function sanitasi($string){
	$string = stripslashes($string);
	$string = mysql_real_escape_string($string);
	return $string;
}

/*
//ambil data simpanan wajib
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah, tgl_simpanan, year(tgl_transaksi) as tahun
		FROM x_simpanan a
		LEFT JOIN x_jns_simpan b ON a.jenis_id = b.id
		WHERE jenis_id = 41 AND month(tgl_transaksi) = '08' AND YEAR(tgl_transaksi)='2016'
		ORDER BY tgl_transaksi, a.jenis_id";

$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$data_simp_wajib[$row['tgl_transaksi']][$row['id_anggota']] = array('dk'=>$row['dk'], 'jumlah'=>$row['jumlah']);
}

//ambil data simpanan sukarela
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah
		FROM x_simpanan a
		LEFT JOIN x_jns_simpan b ON a.jenis_id = b.id
		WHERE jenis_id = 32 AND month(tgl_transaksi) = '08' AND YEAR(tgl_transaksi)='2016'
		ORDER BY tgl_transaksi, a.jenis_id";

$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$data_simp_sukarela[$row['tgl_transaksi']][$row['id_anggota']] = array('dk'=>$row['dk'], 'jumlah'=>$row['jumlah']);
}
*/

echo '
<table>
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>ID Anggota</th>
			<th>Nama Anggota</th>
			<th>Simpanan Wajib</th>
			<th>Simpanan Sukarela</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>';
	foreach ($data_anggota as $key => $value) {
		
		foreach ($value as $k => $v) {
			//$key = tgl transaksi, $k = id anggota
			// lakukan jika ada id anggota pada simpanan wajib, jika id anggota tidak terset maka set simpanan wajib menjadi kosong
			if (isset($k) AND isset($data_simp_wajib[$key][$k])) {
				//jika dk = kredit maka set jumlah menjadi minus
				if ($data_simp_wajib[$key][$k]['dk'] == 'K') { //$key = tgl transaksi $k = id anggota
					$jml_simp_wajib = 0 - $data_simp_wajib[$key][$k]['jumlah'];
				} else if ($data_simp_wajib[$key][$k]['dk'] == 'D') {
					$jml_simp_wajib = $data_simp_wajib[$key][$k]['jumlah'];
				}
			} else {
				$jml_simp_wajib = 0;
			}

			// lakukan jika ada id anggota pada simpanan sukarela, jika id anggota tidak terset maka set simpanan sukarela menjadi kosong
			if (isset($k) AND isset($data_simp_sukarela[$key][$k])) {  //$data_simp_sukarela[$key][$k]['dk']
				//jika dk = kredit maka set jumlah menjadi minus
				if ($data_simp_sukarela[$key][$k]['dk'] == 'K') {  //$key = tgl transaksi $k = id anggota
					$jml_simp_sukarela = 0 - $data_simp_sukarela[$key][$k]['jumlah'];
				} else if ($data_simp_sukarela[$key][$k]['dk'] == 'D') {
					$jml_simp_sukarela = $data_simp_sukarela[$key][$k]['jumlah'];
				} 
			} else {
				$jml_simp_sukarela = 0;
			}
		

			echo '
			<tr>
				<td>
					'.$key.'
				</td>
				<td>
					'.$k.'
				</td>
				<td>
					'.$nama_anggota[$k].'
				</td>
				<td>
					'.number_format($jml_simp_wajib).'
				</td>
				<td>
					'.number_format($jml_simp_sukarela).'
				</td>
			</tr>';
		}
	}
echo '
	</tbody>
</table>';
?>

<style>
tbody tr:nth-child(odd) {
   background-color: #eed;
}

tr {
/*width: 100%;
display: inline-table;*/
height:20px;
/*table-layout: fixed;  */
}

table{
 height:100%; 
 margin: auto;
 display: -moz-groupbox;
}

tbody{
  overflow-y: scroll;
  height: 500px;
  width: 110%;
  position: absolute;
	-ms-overflow-style: none;
}	

tbody::-webkit-scrollbar {
	display:none;
}
</style>