<?
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include('../koneksi/conn.php');

$id_anggota = $_POST['id_anggota'];
//$id_anggota = 10901136;

//data pinjaman dan pengembalian
$sql = "SELECT DISTINCT a.*, nama, c.keterangan, a.id as id
		FROM x_pinjaman_koperasi a, x_norek b, x_kd_pinjam c
		WHERE a.id_anggota = b.id_anggota AND a.kd_pinjam = c.kd_pinjam AND a.id_anggota = $id_anggota
		ORDER BY tgl_transaksi, kd_pinjam";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}

//data jasa
$sql = "SELECT tgl_transaksi, kredit, a.id as id
		FROM x_pinjaman_koperasi a, x_norek b
		WHERE a.id_anggota = b.id_anggota AND kd_pinjam=3 AND a.id_anggota = $id_anggota
		ORDER BY tgl_transaksi, kd_pinjam";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data_jasa[$row['tgl_transaksi']] = $row['kredit'];
	$data_jasa_id[$row['tgl_transaksi']] = $row['id'];
}

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

<div class="panel panel-default" style="width:950px">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$data[0]['nama']?></h3>
	</div>
	<div class="panel-body">
		<div style="margin-left:1px">
			<table border="0" style="margin:auto; font-family:consolas; font-size:10pt; background:#5499C7">
				<thead>
					<tr>
						<td class="no" style="width:20px !important">No</td>
						<td class="tgl" style="width:125px !important">Tanggal</td>
						<td class="uraian" style="width:380px !important">&nbsp;Uraian</td>
						<td class="debet" style="width:100px !important">Debet</td>
						<td class="kredit" style="width:100px !important">Kredit</td>
						<td class="kredit" style="width:100px !important">Sisa</td>
						<td class="kredit" style="width:80px !important;">Jasa</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
				</thead>
			</table>
		</div>
		<div style="overflow-y: scroll; height: 450px;">
			<table border="0" cellspacing="0" cellpadding="2" style="font-family:consolas; font-size:10pt"> <!--"  class="table table-bordered" -->
				<!--<thead>
					<tr>
						<td class="no">No</td>
						<td class="tgl">Tanggal</td>
						<td class="uraian">Uraian</td>
						<td class="debet">Debet</td>
						<td class="kredit">Kredit</td>
						<td class="kredit">Saldo</td>
						<td class="kredit">Jasa</td>
					</tr>
				</thead>-->

				<?
				echo '<tbody>';
				$saldo = 0;
				$temp = 0;
				$i = 1;

				foreach ($data as $k => $v) 
				{
					if ($v['kd_pinjam']==1 || $v['kd_pinjam']==2) {
						$saldo += $v['debet'] - $v['kredit'];
					}

					if ($i % 2 == 0) { 
						$style = 'style="background:#F2F3F4"';
					} else {
						$style = 'style="background:#fff"';
					}
					
					if (isset($v['id'])) {
						$id_pinjam = $v['id'];
					} else {
						$id_pinjam = 0;
					}

					if (isset($v['id'])) {
						$id_pokok_cicilan = $v['id'];
					} else {
						$id_pokok_cicilan = 0;
					}

					if (isset($data_jasa_id[$v['tgl_transaksi']])) {
						$id_jasa = $data_jasa_id[$v['tgl_transaksi']];
					} else {
						$id_jasa = 0;
					}
					

					echo '
					<tr '.$style.'  id="'.$id_pokok_cicilan.'|'.$id_jasa.'">';
					if ($v['kd_pinjam']==1 || $v['kd_pinjam']==2) {
						echo '

						<td class="no" style="width:20px !important">'.$i.'</td>
						<td class="tgl" style="width:125px !important; text-align:right" id="r_tgl">'.DateToIndo($v['tgl_transaksi']).'</td>
						<td class="uraian" style="width:357px !important">'.($v['keterangan']).'</td>
						<td class="debet" style="width:100px !important" id="r_pinjam">'.number_format($v['debet']).'</td>
						<td class="kredit" style="width:100px !important" id="r_pokok_cicilan">'.number_format($v['kredit']).'</td>
						<td class="kredit" style="width:100px !important">'.number_format($saldo).'</td>';

						if(isset($data_jasa[$v['tgl_transaksi']])){
							$jasa = $data_jasa[$v['tgl_transaksi']];
						} else {
							$jasa = 0;
						}

						echo '
						<td class="kredit" style="width:80px !important" id="r_jasa">'.number_format($jasa).'</td>
						<td class="del" id="'.$id_pinjam.'|'.$id_pokok_cicilan.'|'.$id_jasa.'|'.DateToIndo($v['tgl_transaksi']).'|'.$v['kredit'].'|'.$jasa.'" style="color:red; cursor:pointer;"><i class="glyphicon glyphicon-trash"></i></td>';
						$i++;
						/*if($v['kd_pinjam'] == 2){
							echo '<td class="kredit">'.$jasa.'</td>';
						} else {
							echo '<td class="kredit"0></td>';
						}*/							
					}
					
				}
				echo '</tbody>';
				?>
			</table>
		</div>

	</div>
</div>
<!--<pre><?print_r($data_jasa_id)?></pre>-->
<script>
$('.del').click(function(){
	
	var tanggal = $(this).closest('tr').find('#r_tgl').text();
	var pinjam = $(this).closest('tr').find('#r_pinjam').text().replace(/,/g, '').replace('-', '');
	var pokok_cicilan = $(this).closest('tr').find('#r_pokok_cicilan').text().replace(/,/g, '').replace('-', '');
	var jasa = $(this).closest('tr').find('#r_jasa').text().replace(/,/g, '').replace('-', '');
	
	//alert(tanggal + ' ' + pinjam +' ' + pokok_cicilan +' ' + jasa);
	
	//set array bulan
	var array = {'Januari':'01', 'Februari':'02', 'Maret':'03', 'April':'04', 'Mei':'05', 'Juni':'06', 
				'Juli':'07', 'Agustus':'08', 'September':'09', 'Oktober':'10', 'November':'11', 'Desember':'12'};

	var id = $(this).attr('id');
	var array_id = id.split('|');
	id_pinjam = array_id[0];
	id_pokok_cicilan = array_id[1];
	id_jasa = array_id[2];

	var array_tanggal = tanggal.split(' ');
	var tgl = array_tanggal[2] + '-' + array[array_tanggal[1]] + '-' + array_tanggal[0];
	
	//set input box	
	$('#id_pokok_cicilan').val(id_pokok_cicilan);
	$('#id_jasa').val(id_jasa);
	$('#tgl').val(tgl);
	/*
	$('#pinjam').val(pinjam);
	$('#pokok_cicilan').val(pokok_cicilan);
	$('#jasa').val(jasa);
	
	document.getElementById('pinjam').value = format(pinjam);
	document.getElementById('pokok_cicilan').value = format(pokok_cicilan);
	document.getElementById('jasa').value = format(jasa);*/
	$('#pinjam').val(format(pinjam));
	$('#pokok_cicilan').val(format(pokok_cicilan));
	$('#jasa').val(format(jasa));

});

</script>

<style>

table thead tr td {
	text-align:center;
	padding:2px;
	font-weight: bold;
	color: #fff;
}

table thead.x tr td{
	color:#444;
	font-weight: normal;
	text-align: left;
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
	text-align:left;
	padding-left: 5px;
	
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
