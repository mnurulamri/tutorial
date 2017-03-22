<?
include('../koneksi/conn.php');
?>

<script>
$('#nama').focus();
$('#nama').keypress(function(e){
	if(e.keyCode == 13){
		var nama = $('#nama').val();
		
	    $.ajax({
	        type: "POST",
	        url: "potongan/potongan_bni_data.php",
	        data: {nama:nama},
	        success: function(data){
	            //$('#data').html(data);
	            $('#potongan_bni_result').html(data);
	            $('#nama').focus();
	        }
	    }); 
	}
});

$('#bulan_pot, #tahun_pot').change(function(){
	var bulan_pot = $('#bulan_pot').val();
	var tahun_pot = $('#tahun_pot').val();
	
    $.ajax({
        type: "POST",
        url: "potongan/potongan_bni_data.php",
        data: {bulan_pot:bulan_pot, tahun_pot:tahun_pot},
        success: function(data){
            //$('#data').html(data);
	        $('#potongan_bni_result').html(data);
            $('#nama').focus();
        }
    }); /**/
});
</script>
<script src="potongan/autocomplete.js" type="text/javascript"></script>
	<div class="row">
		<div class="col-md-12">
			<div style="text-align:right; padding-right:15px">
				Filter: 
				<input type="text" id="nama" name="nama" onkeyup="lihat(this.value)" placeholder="Nama Anggota"/>
				Filter: 	
				<select id="bulan_pot" name="bulan_pot">
					<option>Bulan</option>
					<?					
					$sql = "SELECT DISTINCT b.bulan as bulan, a.kd_bulan as kd_bulan
								FROM x_pot a
								INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
								LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
								ORDER BY tahun DESC, b.kd_bulan";
					
					$result = mysql_query($sql);
					
					while ($row = mysql_fetch_assoc($result)) {
						//$opt[] = $row;
						echo '<option value="'.$row['kd_bulan'].'">'.$row['bulan'].'</option>';
					}
					?>
				</select>
				
				Filter: 
				<select  id="tahun_pot" name="tahun_pot">
					<option>Tahun</option>
					<?
					$result = mysql_query("SELECT DISTINCT tahun FROM x_pot ORDER BY tahun DESC");
					while ($row = mysql_fetch_assoc($result)) {
						echo '<option value="'.$row['tahun'].'">'.$row['tahun'].'</option>';
					}
					?>
					<option value="<?=date('Y')-1?>"><?=date('Y')-1?></option>
				</select>
			</div>	
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12" id="potongan_bni_result"></div>
	</div>

<style>

html {
	overflow: -moz-scrollbars-none;
}
	
tbody tr:nth-child(odd) {
   background-color: #F2F3F4;
}

tr {
/*width: 100%;
display: inline-table;*/
height:20px;
/*table-layout: fixed;  */
}

table{

 height:500px; 
 margin: auto;
 display: -moz-groupbox;
}

tbody{
  overflow-y: scroll;
  height: 500px;
 
  position: absolute;
	-ms-overflow-style: none;
	
}

	
	tbody::-webkit-scrollbar {
		display:none;
	}
/**/	
#tblToGrid {
	font-family: tahoma;
	font-size: 12px;
}

.tgl {
	width:27px !important;
	text-align:center;
}

.bulan {
	width:80px !important;
	text-align:center;
}

.tahun {
	width:45px !important;
	text-align:center;
}

.nama {
	width:180px !important;
}

.item {
	width:65px !important;
	text-align:right;
}

.item-pdf {
	width:30px !important;
	text-align:center;
}

.cetak{
	color: #428bca;
	cursor: pointer;
}
.cetak:hover{
	color: #f0ad4e;
}
</style>