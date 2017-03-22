<?
include('../koneksi/conn.php');

//data anggota
/*$sql = "SELECT DISTINCT a.id_anggota, nama
		FROM x_pinjaman_koperasi a, x_norek b
		WHERE a.id_anggota = b.id_anggota
		ORDER BY nama";*/

$sql = "SELECT DISTINCT id_anggota, nama
		FROM x_norek
		ORDER BY nama";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}
?>

<!--
<div class="row">
	<div class="col-md-12">
		<h3>Pinjaman Anggota</h3>
	</div>
</div>
-->

<div class="row">
	<div class="col-md-12">
		<table width="100%" border="0" style="border:1px solid #ddd">
			<thead style="color#444" class="x">
				<tr>
					<td>Nama Anggota</td>
					<!--<td>&nbsp;</td>-->
					<td class="update_pinjaman">Tanggal</td>
					<td class="update_pinjaman">Besar Pinjaman</td>
					<td class="update_pinjaman">Angsuran</td>
					<td class="update_pinjaman">Jasa</td>
					<td class="update_pinjaman">Kelola Pinjaman</td>
				</tr>
				<tr>
					<td>
						<select name="data_anggota" id="data_anggota" class="form-control" onchange="test()">
							<option>Nama Anggota</option>
							<?
							foreach ($data as $k => $v) {
								echo '<option value='.$v['id_anggota'].'>'.$v['nama'].'</option>';
							}
							?>	
						</select>
					</td>
					<td class="update_pinjaman">
						<input type="text" class="form-control" size="10" id="tgl" onfocus="testing()" placeholder="Tgl Transaksi" />
						<input type="hidden" id="id_pinjam" size="5" class="form-control" value="0" placeholder="ID" />
						<input type="hidden" id="id_pokok_cicilan" size="5" class="form-control" value="0" placeholder="ID" />
						<input type="hidden" id="id_jasa" size="5" class="form-control" value="0" placeholder="ID" />
					</td>
					<td class="update_pinjaman">
						<input type="text" id="pinjam" size="10" class="form-control" value="0"/>
					</td>
					<td class="update_pinjaman">
						<input type="text" id="pokok_cicilan" size="10" class="form-control" value="0"/>
					</td>
					<td class="update_pinjaman">
						<input type="text" id="jasa" size="10" class="form-control" value="0"/>
					</td>
					<td>
						<div class="btn-group">
							<!--
							<button id="tambah_pinjaman" class="btn btn-primary btn-sm">Setor</button>
							<button id="ambil_pinjaman" class="btn btn-warning btn-sm">Ambil</button>
							<button id="edit_pinjaman" class="btn btn-success btn-sm">&nbsp;Edit&nbsp;</button>
							<button id="hapus_pinjaman" class="btn btn-danger btn-sm">Hapus</button>
							-->
							<button id="tambah_pinjaman" class="btn btn-primary btn-sm">Tambah Pinjaman</button>
							<button id="bayar_cicilan" class="btn btn-warning btn-sm">Bayar Cicilan</button>
							<button id="hapus_data" class="btn btn-danger btn-sm">Hapus</button>
						</div>
					</td>
				</tr>
			</thead>
		</table>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-offset-1 col-md-10 col-md-offset-1">
			<div id="view_pinjaman"><img id="spinner" src="../../remun/images/spinner.gif" style="display:none"/></div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" media="all" href="../../lib/jsdatepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../../lib/jsdatepick/jsDatePick.min.1.3.js"></script>


<script>
function test(){
	$('#pokok_cicilan').val(0);
	$('#jasa').val(0);
	$('#view_pinjaman').html('<img id="spinner" src="../../remun/images/spinner.gif"/>');
	$('#update_pinjaman').show();
	var id_anggota = $('#data_anggota').val();
	$.ajax({
		type: "POST",
		url: "pinjaman/data_pinjaman_03.php",
		data: {id_anggota:id_anggota},
		success: function(data){
			$('#view_pinjaman').html(data);
		}
	});
}

function testing()
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

	$('#pinjam, #pokok_cicilan, #jasa').focus(function(){
		$(this).select();
	});

	$(document).on('click', '#update_pinjaman', function(){
		$('.update_pinjaman').toggle();	
	});

</script>

<style>
.list {
	/*font-family:consolas; */
	font-size:10pt; 
	height:450px;
}

table thead.x {color:#444;}

table.list tr td {
	border:1px solid #eed;
}

table.head thead tr td {
	text-align: right;
	padding: 3px; 
	font-weight: bold; 
	color: #fff;
	/*font-family:consolas; */
	background:#5499C7;
}

table.data thead tr td {
	text-align: right;
	padding: 3px; 
	font-weight: bold; 
	color: #444;
	/*font-family:consolas;*/ 
}
	
table tbody tr td {
	text-align: right;
	padding: 3px;
	line-height: 20px;
}
	
/*table tbody.isi{
  overflow-y: scroll;
  height: 1500px;
  width: 100%;
  display: -moz-groupbox;
	-ms-overflow-style: none;
	position: absolute;
}

	table.data { display: -moz-groupbox;}*/

tbody{
  overflow-y: scroll;
	overflow-x: hidden;
  height: 450px;
  width: 150%;
  position: absolute;
	-ms-overflow-style: none;	
}
	
	.no {
		width:10px;
	}
	.tgl {
		width:130px;
	}
	.jml {
		width:100px;
	}
	.center{text-align:center}
</style>