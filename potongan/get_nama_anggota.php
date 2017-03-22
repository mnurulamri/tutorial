<?php
include('../koneksi/conn.php');
$kata = $_POST['q'];
/*if(!session_id()) session_start();
$username = $_SESSION["username"];
$kd_organisasi = $_SESSION["kodeorganisasi"];



if ($username == "admin" or $username == "remunerasifisipui"){
	$query = mysql_query("SELECT distinct nama_pengajar, nip FROM pengajar WHERE tahun = 2013 and nama_pengajar like '%$kata%' limit 15");
} else {
	$query = mysql_query("SELECT distinct namapengajar, nip FROM kalban WHERE tahun = 2013 and namapengajar like '%$kata%' and $kd_organisasi limit 15");
}
*/

$sql = "SELECT b.bulan, c.nama, c.gender, a.*
				FROM x_pot a
				INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
				LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
				WHERE nama like '%$kata%'
				ORDER BY tahun DESC, b.kd_bulan DESC, tgl DESC";
$result = mysql_query($sql);

while($row = mysql_fetch_assoc($result)){
	$data[] = $row;
}



//echo "<div class='suggestionsBox'><div class='suggestionList'>";
//echo '<div class="list-group">';
//while($k = mysql_fetch_array($query)){
	//echo '<li onClick="isi(\''.$k[0].'\'); isiNip(\''.$k[1].'\');" style="cursor:pointer">'.$k[0].'</li>';
	//echo '<li onClick="isi(\''.$k[0].'\'); " style="cursor:pointer">'.$k[0].'</li>';
	//echo '<a href="#" class="list-group-item">'.$k[0].'</a>';
//}
//echo '</div>';
//echo "</div></div>"
?>

<style>
div#potongan_bni_result>table#tblToGrid>tbody>tr>td, div#potongan_bni_result>div>div>div.item {
	width:80px !important;
	border: 1px solid #c1c2c3;
	padding: 3px;
}
div#potongan_bni_result>table#tblToGrid>tbody>tr>th {
	width:65px !important;
	border: 1px solid #c1c2c3;
	padding: 3px;
	font-size: 11px;
	text-align: center;
}
div#potongan_bni_result>table#tblToGrid>tbody>tr>td>span.cicilan_kop_ke, div#potongan_bni_result>table#tblToGrid>tbody>tr>td>span.cicilan_kop_jml {
    -moz-appearance: textfield;
    -webkit-appearance: textfield;
    background-color: white;
    background-color: -moz-field;
    border: 1px solid darkgray;
    box-shadow: 1px 1px 1px 0 lightgray inset;  
    font: -moz-field;
    font: -webkit-small-control;
    margin-top: 5px;
    padding: 2px 3px;
    width: 398px; 
}
</style>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12" id="potongan_bni_result">
			<!--
			<div style="display:table">
				<div style="display:table-row; background:#ddd">
					<div class="item" style="display:table-cell">Tgl</div>
					<div class="item" style="display:table-cell">Bulan</div>
					<div class="item" style="display:table-cell">Tahun</div>
					<div class="item" style="display:table-cell">Nama</div>
					<div class="item" style="display:table-cell">DPLK</div>
					<div class="item" style="display:table-cell">Simp<br>Wajib</div>
					<div class="item" style="display:table-cell">Simp<br>Sukarela</div>
					<div class="item" style="display:table-cell">Cicilan<br>Koperasi</div>
					<div class="item" style="display:table-cell">Jasa</div>
					<div class="item" style="display:table-cell">BKC</div>
					<div class="item" style="display:table-cell">BSM</div>
					<div class="item" style="display:table-cell">BKE</div>
					<div class="item" style="display:table-cell">Danamon</div>
					<div class="item" style="display:table-cell">BRI</div>
					<div class="item" style="display:table-cell">Bukopin</div>
					<div class="item" style="display:table-cell">Amal</div>
					<div class="item" style="display:table-cell">Total</div>
					<div class="item" style="display:table-cell">Realisasi</div>
					<div class="item" style="display:table-cell"></div>
				</div>
			</div>
			-->

			<!--<div id="gridbox" style="overflow:scroll; height:95%">-->
				<table id="tblToGrid" class="filterable" border="0">
					<!--
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
							<th class="item-pdf"><span class="cetak fa fa-file-pdf-o"></span></th>
						</tr>
					</thead>
					-->
					<tbody>
						<tr style="background:#5499C7; color:#fff">
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
							<th class="item-pdf"><span class="cetak fa fa-file-pdf-o"></span></th>
						</tr>
						<?
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

								<td class="item" style="text-align:center;">
									<span id="cicilan_kop_ke|'.$v['id'].'" class="cicilan_kop_ke" contenteditable="true">'.$v['cicilan_kop_ke'].'</span>
									<div class="action_cicilan_kop_ke'.$v['id'].'_'.$k.'" style="display:none" >
										<button class="simpan_cicilan_kop_ke btn btn-primary btn-xs"><i class="glyphicon glyphicon-ok"></i></button>
										<button class="batal_cicilan_kop_ke btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
										<i class="wait_cicilan_kop_ke_'.$v['id'].'" style="display:none">processing...</i>  
									</div>
								</td>

								<td class="item" style="text-align:center;">
									<span id="cicilan_kop_jml|'.$v['id'].'" class="cicilan_kop_jml" contenteditable="true">'.$v['cicilan_kop_jml'].'</span>
									<div class="action_cicilan_kop_jml'.$v['id'].'_'.$k.'" style="display:none" >
										<button class="simpan_cicilan_kop_jml btn btn-primary btn-xs"><i class="glyphicon glyphicon-ok"></i></button>
										<button class="batal_cicilan_kop_jml btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
										<i class="wait_cicilan_kop_jml_'.$v['id'].'" style="display:none">processing...</i>  
									</div>
								</td>
						
								<td class="item-pdf">
									'.$pdf.'
								</td>

							</tr>
							'; 
						}
	echo '
					</tbody>
				</table>		
			<!--</div>-->
		</div>
	</div>	';
?>

<script>
$('.cicilan_kop_ke, .cicilan_kop_jml').focus(function(){
	$(this).select();
});
</script>