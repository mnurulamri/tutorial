<?
include('../koneksi/conn.php');
//include('../notadebet/ref.php');

$sql = "SELECT DISTINCT a.id_anggota, nama
		FROM x_pinjaman_koperasi a, x_norek b
		WHERE a.id_anggota = b.id_anggota
		ORDER BY nama";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}
?>

<div class="row">
	<div class="col-md-12">
		<h3>Buku Pinjaman Koperasi</h3>
	</div>
</div>

<div class="row">
	<!--<form class="form-horizontal" role="form">
		<div class="form-group">
		<label for="inputData" class="col-sm-2 control-label"></label>-->
			<div class="col-md-2">
				Data Peminjam
				<select name="data_peminjam" id="data_peminjam" class="form-control" onchange="test()">
					<option>Nama Anggota</option>
					<?
					foreach ($data as $k => $v) {
						echo '<option value='.$v['id_anggota'].'>'.$v['nama'].'</option>';
					}
					?>	
				</select>
			</div>
			<!--<div class="col-md-1">
				&nbsp;
				<button class="btn btn-success btn-sm bayar-cicilan" type="button">
					Bayar Cicilan
				</button>
			</div>		
		</div>-->
		
			<form name="form-bayar-cicilan" class="form-inline bayar" role="form" style="">
				<div class="col-md-2">Tgl Bayar<input type="text" class="form-control" size="12" id="tgl" onclick="tanggalan()" placeholder="..." /></div>
				<div class="col-md-1">Pokok Cicilan<input type="text" id="pokok" size="12" class="form-control" value="0" placeholder="..." /></div>
				<div class="col-md-1">Jasa Koperasi<input type="text" id="jasa" size="12" class="form-control" value="0" placeholder="..." /></div>
				<div class="col-md-1">
					&nbsp;
					<button class="btn btn-primary btn-sm simpan" type="button">
						Simpan</span>
					</button>
				</div>
				
				

			</form>
		</div>
	<!--</form>-->
</div>
<div><hr></div>
<div class="row">
	<div class="col-md-offset-1 col-md-10 col-md-offset-1">
		<div id="result"></div>
	</div>
</div>

<link rel="stylesheet" type="text/css" media="all" href="../../lib/jsdatepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../../lib/jsdatepick/jsDatePick.min.1.3.js"></script>

<script>
function test(){
	var id_anggota = $('#data_peminjam').val();
	$.ajax({
		type: "POST",
		url: "pinjaman/data_pinjaman.php",
		data: {id_anggota:id_anggota},
		success: function(data){
			$('#result').html(data);
		}
	});		
}

function tanggalan()
{
	new JsDatePick({
		useMode:2,
		target:"tgl",
		dateFormat:"%Y-%m-%d"
		/*selectedDate:{				This is an example of what the full configuration offers.
			day:5,						For full documentation about these settings please see the full version of the code.
			month:9,
			year:2006
		},
		yearsRange:[1978,2020],
		limitToToday:false,
		cellColorScheme:"beige",
		dateFormat:"%m-%d-%Y",
		imgPath:"img/",
		weekStartDay:1*/
	});
}

</script>

<!--
<style>
tr {
width: 100%;
display: inline-table;
/*height:60px;*/
table-layout: fixed;
  
}

table{
 height:100%; 
 display: -moz-groupbox;
}
tbody{
  overflow-y: scroll;
  height: 400px;
  width: 100%;
  position: absolute;
}
</style>
-->