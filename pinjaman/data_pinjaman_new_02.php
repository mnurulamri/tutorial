<?
include('../koneksi/conn.php');

//$id_anggota = 10901136;
if (isset($_POST['id_anggota'])) {
	$id_anggota = $_POST['id_anggota'];
}

//ambil data tgl transaksi
$sql = "SELECT DISTINCT tgl_transaksi
		FROM x_pinjaman_koperasi
		WHERE id_anggota = $id_anggota
		ORDER BY tgl_transaksi ASC";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$tgl_transaksi[] = $row;
}


//ambil data peminjaman
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah, a.id as id, uraian
		FROM x_pinjaman_koperasi a
		LEFT JOIN x_jns_pinjam b ON a.kd_pinjam = b.id
		WHERE kd_pinjam = 1 AND id_anggota = $id_anggota
		ORDER BY tgl_transaksi, a.kd_pinjam";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$jumlah_pinjaman[$row['tgl_transaksi']] = $row;
}


//ambil data pembayaran cicilan
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah, a.id as id, uraian
		FROM x_pinjaman_koperasi a
		LEFT JOIN x_jns_pinjam b ON a.kd_pinjam = b.id
		WHERE kd_pinjam = 2 AND id_anggota = $id_anggota
		ORDER BY tgl_transaksi, a.kd_pinjam";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$pokok_pinjaman[$row['tgl_transaksi']] = $row;
}


//ambil data pembayaran jasa
$sql = "SELECT id_anggota, tgl_transaksi, dk, a.jumlah as jumlah, a.id as id
		FROM x_pinjaman_koperasi a
		LEFT JOIN x_jns_pinjam b ON a.kd_pinjam = b.id
		WHERE kd_pinjam = 3 AND id_anggota = $id_anggota
		ORDER BY tgl_transaksi, a.kd_pinjam";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$jasa_pinjaman[$row['tgl_transaksi']] = $row;
}


$saldo = $pokok_pinjaman;  // => simpanan pokok
$saldo_pokok = 0;
$saldo_jasa = 0;
$no = 1;

$html= '
<div class="panel panel-default" style="width:950px">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
	</div>
	<div class="panel-body">
		<div style="margin-left:-15px">
			<table border="0" style="margin:auto; font-family:consolas; font-size:10pt; background:#5499C7">
				<thead>
					<tr>
						<td class="no" style="width:30px !important">No</td>
						<td class="tgl" style="width:150px !important">Tanggal</td>
						<td class="uraian" style="width:400px !important">Uraian</td>
						<td class="debet" style="width:100px !important">Debet</td>
						<td class="kredit" style="width:100px !important">Kredit</td>
						<td class="kredit" style="width:100px !important">Saldo</td>
						<td class="kredit" style="width:100px !important;">Jasa</td>
						<td>&nbsp;</td>
					</tr>
				</thead>
			</table>
		</div>
		<div style="overflow-y: scroll; height: 450px;">
			<table style="font-family:consolas; font-size:10pt"> <!--"  class="table table-bordered" -->
';

				$saldo = 0;

				foreach ($tgl_transaksi as $k => $v) 
				{	
					if ($jumlah_pinjaman[$v['tgl_transaksi']]['dk'] == 'D') {
						$jml_pinjaman = $jumlah_pinjaman[$v['tgl_transaksi']]['jumlah'];
					} else {
						$jml_pinjaman = 0;
					}

					if ($pokok_pinjaman[$v['tgl_transaksi']]['dk'] == 'K') {
						$pokok = $pokok_pinjaman[$v['tgl_transaksi']]['jumlah'];
					} else {
						$pokok = 0;
					}

					if ($jasa_pinjaman[$v['tgl_transaksi']]['dk'] == 'K') {
						$jasa = $jasa_pinjaman[$v['tgl_transaksi']]['jumlah'];
						$color_jasa = '#444';
					} else {
						$jasa = 0;
					}

					$saldo += $jml_pinjaman - $pokok;
					//$saldo_pokok += $pokok;
					//$saldo_jasa += $jasa;

					if ($no % 2 == 0) { 
						$style = 'style="background:#F2F3F4"';
					} else {
						$style = 'style="background:#fff"';
					}

					//set id simpanan pokok dan jasa untuk keperluan update data
					$id_pokok = $pokok_pinjaman[$v['tgl_transaksi']]['id'];
					$id_jasa = $jasa_pinjaman[$v['tgl_transaksi']]['id'];

					$html.= '
					<tr '.$style.' id="'.$id_pokok.'-'.$id_jasa.'" class="record_simpanan">
						<td class="no" style="width:30px !important">'.$no.'</td>
						<td class="tgl" id="r_tgl" style="width:135px !important; text-align:right">'.DateToIndo($v['tgl_transaksi']).'</td>
						<td class="uraian" style="width:350px !important">'.$pokok_pinjaman[$v['tgl_transaksi']]['uraian'].'</td>
						<td class="jml" id="r_jml_pinjaman" style="width:100px !important">'.number_format($jml_pinjaman).'</td>
						<td class="jml" id="r_pokok" style="width:100px !important">'.number_format($pokok).'</td>
						<td class="jml" style="width:100px !important">'.number_format($saldo).'</td>
						<td class="jml" style="width:100px !important" id="r_jasa">'.number_format($jasa).'</td>						
					</tr>';

					$no++;
				}

$html.= '
				</tbody>
			</table>
		</div>

</div>
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

<!--<div>
	<?print_r($tgl_transaksi)?>
</div>
<pre><?print_r($jasa_pinjaman)?></pre>
 cetak table data simpanan -->
<div class="list" width="20">
	<?=$html?>
</div>

<script>
$('tr.record_simpanan').dblclick(function(){
	//set array bulan
	var array = {'Januari':'01', 'Februari':'02', 'Maret':'03', 'April':'04', 'Mei':'05', 'Juni':'06', 
				'Juli':'07', 'Agustus':'08', 'September':'09', 'Oktober':'10', 'November':'11', 'Desember':'12'};

	//set id simpanan pokok dan id simpanan jasa
	var id = $(this).attr('id');
	var array_id = id.split('-');
	id_pokok = array_id[0];
	id_jasa = array_id[1];

	//set tanggal
	var tanggal = $(this).find('#r_tgl').text();	
	var array_tanggal = tanggal.split(' ');
	var tgl = array_tanggal[2] + '-' + array[array_tanggal[1]] + '-' + array_tanggal[0];
	
	//set input box
	$('#id_pokok').val(id_pokok);
	$('#id_jasa').val(id_jasa);
	$('#tgl').val(tgl);
	$('#pokok').val($(this).find('#r_pokok').text().replace(',', '').replace('-', ''));
	$('#jasa').val($(this).find('#r_jasa').text().replace(/,/g, '').replace('-', ''));
});
</script>

<style>

	table thead tr td {
		text-align:center;
		padding:2px;
		font-weight: bold;
		color: #fff;
	}

	table thead tr td.no {
		width:50px;
		padding:2px;
	}

	table thead tr td.debet {
		text-align: right;
	}

	table thead tr td.kredit {
		text-align: right;
	}

	table tbody tr td.no {
		width:50px;
		text-align:center;
	}
	
	.tgl {
		width:70px;
	}

	table thead tr td.tgl {
		width:50px;
	}

	table tbody tr td.tgl {
		width:50px;
		padding:2px;
	}
	
	.uraian {
		width:80px;
		padding:2px;
	}

	table thead tr td.uraian {
		width: 70px;
		padding-left: 15px;
		padding-right: 2px;
		padding-top: 2px;
		padding-bottom: 2px
	}

	table tbody tr td.uraian {
		width: 70px;
		padding-left: 15px;
		padding-right: 2px;
		padding-top: 2px;
		padding-bottom: 2px
	}

	.debet {
		width:50px;
	}

	table thead tr td.debet {
		width:50px;
		padding:2px;
	}

	table tbody tr td.debet {
		text-align: right;
		width:50px;
		padding:2px;
	}

	.kredit {
		width:50px;
	}

	table thead tr td.kredit {
		width:50px;
		padding:2px;
	}

	table tbody tr td.kredit {
		text-align:right;
		width:50px;\
		padding:2px;
	}

	.saldo {
		width:50px;	
	}


</style>

