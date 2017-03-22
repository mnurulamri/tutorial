<?
include('../koneksi/conn.php');

$sql = "SELECT DISTINCT tgl, a.kd_bulan, bulan, tahun
		FROM x_pot a
		LEFT JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
		ORDER BY tahun DESC, kd_bulan DESC, tgl DESC";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}
?>


<div class="row">

	<div class="col-md-3">

	</div>	
	<div class="col-md-1">		
			
	</div>
</div>

<form action="potongan/temp_realisasi.php" method="POST" target="_blank">
	<select name="tgl_pot" id="tgl_pot" class="form-control">
		<option>Tanggal</option>
		<?
		foreach ($data as $k => $v) {
			$tanggal = $v['tgl'].'-'.$v['kd_bulan'].'-'.$v['tahun'];
			$opt_tanggal = $v['tgl'].' '.$v['bulan'].' '.$v['tahun'];
			echo '<option value='.$tanggal.'>'.$opt_tanggal.'</option>';
		}
		?>	
	</select>
	<input type="submit" id="btn-form-submit"/>
</form>
<script>
    $('#btn-submit').click( function(){ 
    	$('#btn-form-submit').click(); 
    } );
</script>