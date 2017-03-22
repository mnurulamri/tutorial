<script>
 $(".filterable tr:has(td)").each(function(){
   var t = $(this).text().toLowerCase(); //all row text
   $("<td class='indexColumn'></td>")
	.hide().text(t).appendTo(this);
 });//each tr

$("#FilterTextBox").keypress(function(e) {
    if(e.which == 13) {
		var s = $(this).val().toLowerCase().split(" ");
		//show all rows.
		$(".filterable tr:hidden").show();
		$.each(s, function(){
		   $(".filterable tr:visible .indexColumn:not(:contains('"
			  + this + "'))").parent().hide();
		});//each
    }
});

 /* kalo keyup
 $("#FilterTextBox").keyup(function(){
   var s = $(this).val().toLowerCase().split(" ");
   //show all rows.
   $(".filterable tr:hidden").show();
   $.each(s, function(){
	   $(".filterable tr:visible .indexColumn:not(:contains('"
		  + this + "'))").parent().hide();
   });//each
 });//key up.
*/
</script>

<?
include('../koneksi/conn.php');

$sql = "SELECT b.bulan, c.nama, c.gender, a.*
		FROM x_pot a
		INNER JOIN x_bulan b ON a.kd_bulan = b.kd_bulan
		LEFT JOIN x_norek c ON a.id_anggota = c.id_anggota
		ORDER BY a.kd_bulan, a.tgl, c.nama";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
	$data[] = $row;
}
?>

<!--<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="row" style="background-color: #fff; margin-left:1px;">
	<div class="col-md-offset-2 col-md-1" style="color:#fa0">
		<h4>search:</h4> 
	</div>
	<div  class="col-md-2">
		<input type="text" id="FilterTextBox" name="FilterTextBox" class="form-control"/>
	</div>	
</div>-->

<div style="text-align:right; padding-right:15px">search: <input type="text" id="FilterTextBox" name="FilterTextBox" /></div>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">

		<!--<table class="table table-striped">
			<tr style="background:#ddd">
				<td>Tgl</td>
				<td>Bulan</td>
				<td>Tahun</td>
				<td>Nama</td>
				<td>DPLK</td>
				<td>Simp<br>Wajib</td>
				<td>Simp<br>Sukarela</td>
				<td>Cicilan<br>Koperasi</td>
				<td>Jasa</td>
				<td>BKC</td>
				<td>BSM</td>
				<td>BKE</td>
				<td>Danamon</td>
				<td>BRI</td>
				<td>Bukopin</td>
				<td>Amal</td>
				<td>Total</td>
				<td>Realisasi</td>
				<td></td>
			</tr>
		</table>-->

		<!--<div id="gridbox" style="overflow:scroll; height:95%">-->
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
						<th class="item-pdf"><span class="cetak fa fa-file-pdf-o"></span></th>
					</tr>
				</thead>
				<tbody>
					<?
					foreach ($data as $k => $v) {
						if ($v['realisasi']==0) {
							$style = 'style=color:#DC381F';
							$pdf = '';
						} else {
							$style = '';
							$pdf = '<span id="'.$v['id'].'" type="button" class="cetak fa fa-file-pdf-o fa-align-center fa-lg faa-vertical" style="color:red; cursor:pointer"></span>';
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
							<td class="item">'.$v['cicilan_kop_jml'].'</td>							
							<td class="item-pdf">
								'.$pdf.'
							</td>

						</tr>
						'; 
					}
					?>
				</tbody>
			</table>		
		<!--</div>-->
	</div>
</div>

<script>
$(document).ready(function(){
 //add index column with all content.
	 $(".filterable tr:has(td)").each(function(){
	   var t = $(this).text().toLowerCase(); //all row text
	   $("<td class='indexColumn'></td>")
		.hide().text(t).appendTo(this);
	 });//each tr
 
	 $("#FilterTextBox").keyup(function(){
	   var s = $(this).val().toLowerCase().split(" ");
	   //show all rows.
	   $(".filterable tr:hidden").show();
	   $.each(s, function(){
		   $(".filterable tr:visible .indexColumn:not(:contains('"
			  + this + "'))").parent().hide();
	   });//each
	 });//key up.
	 
	//------------------------- filter cloumn -------------------------
    //<![CDATA[
      $(document).ready(function() {
        $('.filter').multifilter()
      })
    //]]>
	
	$('.cetak').click(function(){
		var id = $(this).attr('id');
		var parameter = 'id=' + id;
		window.location.assign("nota_debet.php?" + parameter);
	});
	
});//document.ready
</script>


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
 height:600px; 
 margin: auto;
 display: -moz-groupbox;
}
tbody{
  overflow-y: scroll;
  height: 600px;
  width: 100%;
  position: absolute;
	-ms-overflow-style: none;
	/**/
}

	
	tbody::-webkit-scrollbar {
		display:none;
	}
	
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
