<?
include('../../koneksi/conn.php');

$query = "SELECT a.*, b.*
			FROM x_pengajuan_pinjaman a, x_norek b
			WHERE a.id_anggota = b.id_anggota
			ORDER BY tgl_pinjaman DESC";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)){
	$bulan = substr($row['tgl_pinjaman'], 5,2).'<br>';
	$tahun = substr($row['tgl_pinjaman'], 0,4);
	$data[$tahun][$bulan][] = $row;
}

//echo '<h3>DATA PENGAJUAN PINJAMAN KOPERASI</h3>';

$bulan_arr = array('01'=>'Januari', '02'=>'Februari', '03'=>'Maret',
                   '04'=>'April', '05'=>'Mei', '06'=>'Juni',
                   '07'=>'Juli', '08'=>'Agustus', '09'=>'September',
                   '10'=>'Oktober', '11'=>'November', '12'=>'Desember');


$i = 1;
foreach ($data as $keys => $values) {
	echo '<span class="label label-success">'.$keys.'</span>';
	foreach ($values as $key => $value) {
		$j=1;
		$kd_bulan = substr($key, 0, 2);
		echo'
		<div class="panel panel-primary">
		<!-- Default panel contents -->
			<div class="panel-heading" style="text-align:center; color:#ff; font-size:16px">-&nbsp;Data Pinjaman Bulan '.$bulan_arr[$kd_bulan].' '.$keys.'&nbsp;-</div>

			<!-- Table -->
			<table class="table table-bordered">
				<thead>
					<tr>
						<td class="center">NO</td>
						<td class="center">NO</td>
						<td class="center">NO REK</td>
						<td class="center">NAMA</td>
						<td class="center">TANGGAL</td>
						<td class="center">SISA<br>PINJAMAN</td>
						<td class="center">JUMLAH<br>PINJAMAN</td>
						<td class="center">AKUMULASI<br>PINJAMAN</td>
						<td class="center">LAMA<br>PINJAMAN</td>
						<td class="center">CICILAN<br>PERBULAN</td>
						<td class="center">JASA</td>
						<td class="center">KEPERLUAN</td>
						<td class="center">STATUS</td>
					</tr>
				</thead>
				<tbody>';

			foreach ($value as $k => $v) {
				if ($v['status'] == 1) {
					$status = 'Disetujui';
				} else {
					$status = 'Menunggu Konfirmasi';
				}
				
				echo '
				<tr>
					<td class="center">'.$i.'</td>
					<td class="center">'.$j.'</td>
					<td class="center">'.$v['norek'].'</td>
					<td>'.$v['nama'].'</td>
					<td class="center">'.$v['tgl_pinjaman'].'</td>
					<td class="right">'.number_format($v['sisa_pinjaman']).'</td>
					<td class="right">'.number_format($v['jml_pinjaman']).'</td>
					<td class="right">'.number_format($v['akumulasi_pinjaman']).'</td>
					<td class="center">'.number_format($v['lama_pinjaman']).'</td>
					<td class="right">'.number_format($v['cicilan_perbulan']).'</td>
					<td class="right">'.number_format($v['jasa']).'</td>
					<td>'.$v['alasan'].'</td>
					<td class="center">'.$status.'</td>
				</tr>';
				$i++;
				$j++;
			}
			echo '
			</tbody>
				</table>
					</div>';
		echo '
		</div>'; //end of panel
	}
	
}


?>
<!--<pre><?print_r($bulan_arr)?></pre>-->
<style>
.center {
	text-align: center;
}
.right {
	text-align: right;
}
</style>