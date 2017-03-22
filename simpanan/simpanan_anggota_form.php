<?
include('../koneksi/conn.php');

//data anggota
$sql = "SELECT DISTINCT a.id_anggota, nama
		FROM x_simpanan a, x_norek b
		WHERE a.id_anggota = b.id_anggota
		ORDER BY nama";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}
?>

<!--
<div class="row">
	<div class="col-md-12">
		<h3>Simpanan Anggota</h3>
	</div>
</div>
-->

<div class="row">
	<div class="col-md-12">
		<table width="100%" class="table" border="0">
			<thead class="x">
				<tr>
					<td>Nama Anggota</td>
					<!--<td>&nbsp;</td>-->
					<td class="update_simpanan">Tanggal</td>
					<td class="update_simpanan">wajib</td>
					<td class="update_simpanan">sukarela</td>
					<td class="update_simpanan">Kelola Simpanan</td>
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
					<td class="update_simpanan">
						<input type="text" class="form-control" size="10" id="tgl" onfocus="testing()" placeholder="Tgl Setoran..." />
						<input type="hidden" id="id_wajib" size="5" class="form-control" value="0" placeholder="ID" />
						<input type="hidden" id="id_sukarela" size="5" class="form-control" value="0" placeholder="ID" />
					</td>
					<td class="update_simpanan">
						<input type="text" id="wajib" size="10" class="form-control" value="0" placeholder="Simpanan Wajib..." />
					</td>
					<td class="update_simpanan">
						<input type="text" id="sukarela" size="10" class="form-control" value="0" placeholder="Simpanan Sukarela..." />
					</td>
					<td>
						<div class="btn-group">
							<button id="tambah_simpanan" class="btn btn-primary btn-sm">Setor</button>
							<button id="ambil_simpanan" class="btn btn-warning btn-sm">Ambil</button>
							<button id="edit_simpanan" class="btn btn-success btn-sm">&nbsp;Edit&nbsp;</button>
							<button id="hapus_simpanan" class="btn btn-danger btn-sm">Hapus</button>
						</div>
					</td>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="col-md-offset-1 col-md-10 col-md-offset-1">
			<div id="view_simpanan"><img id="spinner" src="../../remun/images/spinner.gif" style="display:none"/></div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" media="all" href="../../lib/jsdatepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../../lib/jsdatepick/jsDatePick.min.1.3.js"></script>


<script>
function test(){
	$('#wajib').val(0);
	$('#sukarela').val(0);
	$('#view_simpanan').html('<img id="spinner" src="../../remun/images/spinner.gif"/>');
	$('#update_simpanan').show();
	var id_anggota = $('#data_anggota').val();
	$.ajax({
		type: "POST",
		url: "simpanan/data_simpanan.php",
		data: {id_anggota:id_anggota},
		success: function(data){
			$('#view_simpanan').html(data);
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

	$('#wajib, #sukarela').focus(function(){
		$(this).select();
	});

	$(document).on('click', '#update_simpanan', function(){
		$('.update_simpanan').toggle();	
	});

</script>

<style>
.list {
	/*font-family:consolas; */
	font-size:10pt; 
	height:450px;
}

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