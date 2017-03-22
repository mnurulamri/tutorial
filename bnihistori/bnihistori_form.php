<?
include('../koneksi/conn.php');
?>

<script>
$( document ).ready(function() {
	$.post('bnihistori/fetch_data.php', function(data){$('#bnihistori_result').html(data);} );
});

/*
$('#nama').click(function(){
	$('#nama').focus();
});

$('#deskripsi').click(function(){
	$('#deskripsi').focus();
});
*/

$('#deskripsi').keyup(function(e){	
		var deskripsi = $('#deskripsi').val();
		
	    $.ajax({
	        type: "POST",
	        url: "bnihistori/fetch_data.php",
	        data: {deskripsi:deskripsi},
	        success: function(data){
	            //$('#data').html(data);
	            $('#bnihistori_result').html(data);
	            $('#deskripsi').focus();
	        }
	    }); 	
});

$('#nama').keyup(function(e){	
		var nama = $('#nama').val();
		
	    $.ajax({
	        type: "POST",
	        url: "bnihistori/fetch_data.php",
	        data: {nama:nama},
	        success: function(data){
	            //$('#data').html(data);
	            $('#bnihistori_result').html(data);
	            $('#nama').focus();
	        }
	    }); 	
});

$('#bulan_bnihistori, #tahun_bnihistori').change(function(){
	var bulan_bnihistori = $('#bulan_bnihistori').val();
	var tahun_bnihistori = $('#tahun_bnihistori').val();
	
    $.ajax({
        type: "POST",
        url: "bnihistori/fetch_data.php",
        data: {bulan:bulan_bnihistori, tahun:tahun_bnihistori},
        success: function(data){
            //$('#data').html(data);
	        $('#bnihistori_result').hide().html(data).fadeIn('slow');
            $('#nama').focus();
        }
    }); /**/
});

$('#dk').change(function(){	

	if($('#nama').val() != '' || $('#deskripsi').val() != ''){
		//set input
		var nama = $('#nama').val();
		var deskripsi = $('#deskripsi').val();
		var bulan_bnihistori = $('#bulan_bnihistori').val();
		var tahun_bnihistori = $('#tahun_bnihistori').val();
		var dk = $('#dk').val();

	    $.ajax({
	        type: "POST",
	        url: "bnihistori/fetch_data.php",
	        data: {nama:nama, deskripsi:deskripsi, bulan:bulan_bnihistori, tahun:tahun_bnihistori, dk:dk},
	        success: function(data){
	            //$('#data').html(data);
	            $('#bnihistori_result').html(data);
	            $('#deskripsi').focus();
	        }
	    }); 	
	}
});
</script>
<!--<script src="autocomplete.js" type="text/javascript"></script>-->
	<div class="row">
		<div class="col-md-12">
			<div style="text-align:right; padding-right:15px">
				Nama/Norek Anggota: 
				<input type="text" id="deskripsi" name="deskripsi" placeholder="cari.."/>

				<!--
				Nama: 
				<input type="text" id="nama" name="nama" placeholder="filter nama Anggota"/>				 
				-->

				Bulan: 	
				<select id="bulan_bnihistori" name="bulan_bnihistori">
					<option>Bulan</option>
					<?
					$bulan_arr = array('01'=>'Januari', '02'=>'Februari', '03'=>'Maret',
					                   '04'=>'April', '05'=>'Mei', '06'=>'Juni',
					                   '07'=>'Juli', '08'=>'Agustus', '09'=>'September',
					                   '10'=>'Oktober', '11'=>'November', '12'=>'Desember');

					$sql = "SELECT DISTINCT substr(post_date,4,2) as bulan
								FROM x_histori_bni
								ORDER BY substr(post_date,4,2) ASC";
					
					$result = mysql_query($sql);
					
					while ($row = mysql_fetch_assoc($result)) {
						//$opt[] = $row;
						echo '<option value="'.$row['bulan'].'">'.$bulan_arr[$row['bulan']].'</option>';
					}
					?>
				</select>
				
				Tahun: 
				<select  id="tahun_bnihistori" name="tahun_bnihistori">
					<option>Tahun</option>
					<?
					$result = mysql_query("SELECT DISTINCT substr(post_date,7,2) as tahun
								FROM x_histori_bni
								ORDER BY substr(post_date,7,2) ASC");
					while ($row = mysql_fetch_assoc($result)) {
						echo '<option value="'.$row['tahun'].'">20'.$row['tahun'].'</option>';
					}
					?>
					<option value="<?=date('Y')-1?>"><?=date('Y')-1?></option>
				</select>
				<!--
				Filter:
				<select id="dk" name="dk">
					<option value="dk">Debet/Kredit</option>
					<option value="d">Debet</option>
					<option value="k">Kredit</option>
				</select>
				-->
			</div>	
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12" id="bnihistori_result"></div>
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
</style>