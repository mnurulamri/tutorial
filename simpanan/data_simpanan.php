<?
include('../koneksi/conn.php');

//$id_anggota = 10901136;
if (isset($_POST['id_anggota'])) {
	$id_anggota = $_POST['id_anggota'];
}



$sql = "SELECT id_anggota, tgl_transaksi, jenis_id, dk, sum(if(jenis_id=41, a.jumlah, 0)) as wajib, sum(if(jenis_id=32, a.jumlah, 0)) as sukarela, a.jumlah as jumlah
		FROM x_simpanan a
		LEFT JOIN x_jns_simpan b ON a.jenis_id = b.id
		WHERE id_anggota = $id_anggota
		GROUP BY tgl_transaksi
		ORDER BY tgl_transaksi, a.jenis_id";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	//$data[] = $row;
	$simp_wajib[$row['tgl_transaksi']] = $row['wajib'];
	$simp_sukarela[$row['tgl_transaksi']] = $row['sukarela'];
}

//ambil data tgl transaksi
$sql = "SELECT DISTINCT tgl_transaksi
		FROM x_simpanan
		WHERE id_anggota = $id_anggota
		ORDER BY tgl_transaksi ASC";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$tgl_transaksi[] = $row;
}

//ambil data simpanan pokok
$sql = "SELECT jumlah
		FROM x_simpanan
		WHERE jenis_id = 40 AND id_anggota = $id_anggota";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$simp_pokok = $row['jumlah'];
}

//ambil data simpanan wajib
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah, a.id as id
		FROM x_simpanan a
		LEFT JOIN x_jns_simpan b ON a.jenis_id = b.id
		WHERE jenis_id = 41 AND id_anggota = $id_anggota
		ORDER BY tgl_transaksi, a.jenis_id";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$simp_wajib[$row['tgl_transaksi']] = $row;
}

//ambil data simpanan sukarela
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah, a.id as id
		FROM x_simpanan a
		LEFT JOIN x_jns_simpan b ON a.jenis_id = b.id
		WHERE jenis_id = 32 AND id_anggota = $id_anggota
		ORDER BY tgl_transaksi, a.jenis_id";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$simp_sukarela[$row['tgl_transaksi']] = $row;
}

$saldo = $simp_pokok;  // => simpanan pokok
$saldo_wajib = 0;
$saldo_sukarela = 0;
$no = 1;

echo '
<p style="background: #fff;padding:5px; text-align:left">Simpanan Pokok: '.number_format($saldo).'</p>
<table class="head">
	<thead>
		<tr>
			<td rowspan="2" class="center no">No</td>
			<td rowspan="2" class="center tgl">Tanggal</td>
			<td colspan="2" class="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Setoran Simpanan</td>
			<td colspan="2" class="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saldo Simpanan</td>
			<td class="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td class="jml">Wajib</td>
			<td class="jml">Sukarela</td>
			<td class="jml">Wajib</td>
			<td class="jml">Sukarela</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saldo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</thead>
</table>
';

$html= '
<table class="data">
	<tbody class="isi">
';
$jumlah = 0;

foreach ($tgl_transaksi as $k => $v) 
{	
	if ($simp_wajib[$v['tgl_transaksi']]['dk'] == 'D') {
		$wajib = $simp_wajib[$v['tgl_transaksi']]['jumlah'];
	} else {
		$wajib = 0 - $simp_wajib[$v['tgl_transaksi']]['jumlah'];
	}
	
	if ($simp_wajib[$v['tgl_transaksi']]['dk'] == 'D') {
		$sukarela = $simp_sukarela[$v['tgl_transaksi']]['jumlah'];
		$color_sukarela = '#444';
	} 

	if($simp_sukarela[$v['tgl_transaksi']]['dk'] == 'K'){
		$sukarela = 0 - $simp_sukarela[$v['tgl_transaksi']]['jumlah'];	
		$color_sukarela = 'red';
	} else {
		$color_sukarela = '#444';
	}

	$saldo += $wajib + $sukarela;
	$saldo_wajib += $wajib;
	$saldo_sukarela += $sukarela;

	if ($no % 2 == 0) { 
		$style = 'style="background:#F2F3F4"';
	} else {
		$style = 'style="background:#fff"';
	}

	//set id simpanan wajib dan sukarela untuk keperluan update data
	$id_wajib = $simp_wajib[$v['tgl_transaksi']]['id'];
	$id_sukarela = $simp_sukarela[$v['tgl_transaksi']]['id'];
	
	$html.= '
	<tr '.$style.' id="'.$id_wajib.'-'.$id_sukarela.'" class="record_simpanan">
		<td class="no">'.$no.'</td>
		<td class="tgl" id="r_tgl">'.DateToIndo($v['tgl_transaksi']).'</td>
		<td class="jml" id="r_wajib">'.number_format($wajib).'</td>
		<td class="jml" style="color:'.$color_sukarela.'" id="r_sukarela">'.number_format($sukarela).'</td>
		<td class="jml">'.number_format($saldo_wajib).'</td>
		<td class="jml">'.number_format($saldo_sukarela).'</td>
		<td class="jml">'.number_format($saldo).'</td>
	</tr>';
	$no ++;
}
$html.= '
	</tbody>
</table>
';

//fungsi tanggal
function DateToIndo($value) { // fungsi atau method untuk mengubah tanggal ke format indonesia
   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
    	$array = explode("-", $value);
        $tahun = $array[0]; 
        $bulan = $array[1]; 
        $tgl   = $array[2]; 
        
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
}
?>

<!-- cetak table data simpanan -->
<div class="list" width="400">
	<?=$html?>
</div>

<script>
$('tr.record_simpanan').dblclick(function(){
	//set array bulan
	var array = {'Januari':'01', 'Februari':'02', 'Maret':'03', 'April':'04', 'Mei':'05', 'Juni':'06', 
				'Juli':'07', 'Agustus':'08', 'September':'09', 'Oktober':'10', 'November':'11', 'Desember':'12'};

	//set id simpanan wajib dan id simpanan sukarela
	var id = $(this).attr('id');
	var array_id = id.split('-');
	id_wajib = array_id[0];
	id_sukarela = array_id[1];

	//set tanggal
	var tanggal = $(this).find('#r_tgl').text();	
	var array_tanggal = tanggal.split(' ');
	var tgl = array_tanggal[2] + '-' + array[array_tanggal[1]] + '-' + array_tanggal[0];
	
	//set input box
	$('#id_wajib').val(id_wajib);
	$('#id_sukarela').val(id_sukarela);
	$('#tgl').val(tgl);
	$('#wajib').val($(this).find('#r_wajib').text().replace(',', '').replace('-', ''));
	$('#sukarela').val($(this).find('#r_sukarela').text().replace(/,/g, '').replace('-', ''));
});
</script>

<style>
.list {
	font-family:consolas; /**/
	font-size:10pt; 
	height:450px;
}

table.list tr td {
	border:1px solid #eed;
}

table.head thead tr td {
	text-align: right;
	padding: 3px; 
	font-weight: bold; 
	color: #fff;
	/*font-family:consolas; */
	background:#5499C7;
}

table.data thead tr td {
	text-align: right;
	padding: 3px; 
	font-weight: bold; 
	color: #444;
	/*font-family:consolas;*/ 
}
	
table tbody tr td {
	text-align: right;
	padding: 3px;
	line-height: 20px;
}
	
/*table tbody.isi{
  overflow-y: scroll;
  height: 1500px;
  width: 100%;
  display: -moz-groupbox;
	-ms-overflow-style: none;
	position: absolute;
}

	table.data { display: -moz-groupbox;}*/

tbody{
  overflow-y: scroll;
	overflow-x: hidden;
  height: 450px;
  width: 150%;
  position: absolute;
	-ms-overflow-style: none;	
}
	
	.no {
		width:10px;
	}
	.tgl {
		width:130px;
	}
	.jml {
		width:100px;
	}
	.center{text-align:center}
</style>