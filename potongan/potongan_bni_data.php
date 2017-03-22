<?php 

include('../koneksi/conn.php');

if(!empty($_POST)){

	if(isset($_POST['nama'])){
		$nama = $_POST['nama'];
		$sql = "SELECT b.bulan, c.nama, c.gender, a.*
				FROM x_pot a
				INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
				LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
				WHERE nama LIKE '%$nama%'
				ORDER BY a.kd_bulan, a.tgl, c.nama"; 
	} else {
		$nama = '';
	}

	if(isset($_POST['bulan_pot'])){
		$bulan_pot = $_POST['bulan_pot'];
		$tahun_pot = $_POST['tahun_pot'];
		$sql = "SELECT b.bulan, c.nama, c.gender, a.*
				FROM x_pot a
				INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
				LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
				WHERE a.kd_bulan = '$bulan_pot' AND tahun = '$tahun_pot'
				ORDER BY a.kd_bulan, a.tgl, c.nama"; 
	} 

	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	//$where = '';
	/* untuk pagination
	$num_rec_per_page=10;
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
	$sql = "SELECT b.bulan, c.nama, c.gender, a.*
			FROM x_pot a
			INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
			LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
			ORDER BY a.kd_bulan, a.tgl, c.nama"; 
	$result = $mysqli->query($sql); //run the query
	$total_records = $result->num_rows;  //count number of records
	$total_pages = ceil($total_records / $num_rec_per_page); 
	*/
} else {

	//$_bulan = date('m');
	//$_tahun = date('Y');
	
	$sql = "SELECT MAX(tahun) as tahun FROM x_pot"; 
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc()) {
		$_tahun = $row['tahun'];
	}

	$sql = "SELECT MAX(kd_bulan) as bulan FROM x_pot"; 
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc()) {
		$_bulan = $row['bulan'];
	}

	$sql = "SELECT b.bulan, c.nama, c.gender, a.*
			FROM x_pot a
			INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
			LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
			WHERE a.kd_bulan = '$_bulan' AND tahun = '$_tahun'
			ORDER BY a.kd_bulan, a.tgl, c.nama"; 

	$result = $mysqli->query($sql);

	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}	

	/* alternatif untuk pagination
	$num_rec_per_page=17;

	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

	$start_from = ($page-1) * $num_rec_per_page; 

	$sql = "SELECT b.bulan, c.nama, c.gender, a.*
			FROM x_pot a
			INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
			LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
			
			ORDER BY a.kd_bulan, a.tgl, c.nama
			LIMIT $start_from, $num_rec_per_page"; 

	$result = $mysqli->query($sql);

	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}

	$sql = "SELECT b.bulan, c.nama, c.gender, a.*
			FROM x_pot a
			INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
			LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
			ORDER BY a.kd_bulan, a.tgl, c.nama"; 

	$result = $mysqli->query($sql); //run the query
	$total_records = $result->num_rows;  //count number of records
	$total_pages = ceil($total_records / $num_rec_per_page); 
	*/
}
//isi($data);
// isi($data, $total_records, $total_pages);

//function isi($data, $total_records, $total_pages){
//function isi($data){
?>

				<table id="tblToGrid" class="filterable" border="0">
					<thead style="background:#5499C7; color:#fff">
						<tr>
							<th class="tgl">Tgl</th>
							<th class="bulan">Bulan</th>
							<th class="tahun">Tahun</th>
							<th class="nama">Nama</th>
							<th class="item">DPLK</th>
							<th class="item">Simp<br>Wajib</th>
							<th class="item">Simp<br>Sukarela</th>
							<th class="item">Cicilan<br>Koperasi</th>
							<th class="item">Jasa</th>
							<th class="item">BKC</th>
							<th class="item">BSM</th>
							<th class="item">BKE</th>
							<th class="item">Danamon</th>
							<th class="item">BRI</th>
							<th class="item">Bukopin</th>
							<th class="item">Amal</th>
							<th class="item">Total</th>
							<th class="item">Realisasi</th>
							<th class="item">Cicilan Ke</th>
							<th class="item">Juml Cicilan</th>
							<th class="item">Nota Debet</th>
						</tr>
					</thead>
					<tbody>	<?
						foreach ($data as $k => $v) {
							if ($v['realisasi']==0) {
								$style = 'style=color:#DC381F';
								$pdf = '';
							} else {
								$style = '';
								$pdf = '<span id="'.$v['id'].'" type="button" class="cetak glyphicon glyphicon-print"></span>';
							}
							
							echo'
							<tr '.$style.'>
								<td class="tgl" class="tgl">'.$v['tgl'].'</td>
								<td class="bulan" class="bulan">'.$v['bulan'].'</td>
								<td class="tahun">'.$v['tahun'].'</td>
								<td class="nama">'.$v['nama'].'</td>
								<td class="item">'.number_format($v['dplk']).'</td>
								<td class="item">'.number_format($v['simpanan_wajib']).'</td>
								<td class="item">'.number_format($v['simpanan_sukarela']).'</td>
								<td class="item">'.number_format($v['cicilan_koperasi']).'</td>
								<td class="item">'.number_format($v['jasa']).'</td>
								<td class="item">'.number_format($v['bkc']).'</td>
								<td class="item">'.number_format($v['bsm']).'</td>
								<td class="item">'.number_format($v['bke']).'</td>
								<td class="item">'.number_format($v['danamon']).'</td>
								<td class="item">'.number_format($v['bri']).'</td>
								<td class="item">'.number_format($v['bukopin']).'</td>
								<td class="item">'.number_format($v['amal']).'</td>
								<td class="item">'.number_format($v['total']).'</td>
								<td class="item">'.number_format($v['realisasi']).'</td>
								<td class="item">'.$v['cicilan_kop_ke'].'</td>
								<td class="item" onclick="test(this)">'.$v['cicilan_kop_jml'].'|'.$v['id'].'</td>							
								<td class="item-pdf">
									'.$pdf.'
								</td>

							</tr>
							'; 
						}
	echo '
					</tbody>
				</table>';

	/* untuk pagination 
	echo '
	<div>
		<select>
			<option></option>
		</select>
	</div>
	<!---->
	<div class="btn-group btn-group-xs" role="group" aria-label="..." style="text-align:5px">
	';
	
	echo "<a href='potongan/potongan_bni.php?page=1'  class='pagination btn btn-warning btn-warning-sm'>".'|<'."</a> "; // Goto 1st page  	

	for ($i=1; $i<=$total_pages; $i++) { 
		
		echo '<a rel="potongan/potongan_bni.php?page='.$i.'" class="pagination btn btn-primary btn-primary-sm">'.$i.'</a>';
		
	};
	
	echo "<a href='potongan/potongan_bni.php?page=".$total_pages."' class='pagination btn btn-warning btn-warning-sm'>".'>|'."</a> "; // Goto last page	

	echo '	
	</div>
	<!---->
	';*/
//}
?>
<script>
function test(n){
	alert('ok');
}
</script>

