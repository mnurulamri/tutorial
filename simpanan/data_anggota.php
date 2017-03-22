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

<div class="row">
	<div class="col-md-12">
		<h3>Simpanan Anggota</h3>
	</div>
</div>

<div class="row">
	<!--<form class="form-horizontal" role="form">
		<div class="form-group">-->
		<label for="inputData" class="col-sm-2 control-label">Data Simpanan</label>
			<div class="col-md-2">
				<select name="data_anggota" id="data_anggota" class="form-control" onchange="test()">
					<option>Nama Anggota</option>
					<?
					foreach ($data as $k => $v) {
						echo '<option value='.$v['id_anggota'].'>'.$v['nama'].'</option>';
					}
					?>	
				</select>
			</div>
			<div class="col-md-1">
				<button class="btn btn-success btn-sm bayar-cicilan" type="button">
					Setor Simpanan
				</button>
			</div>		
		<!--</div>-->
		<div class="col-md-6">
			<form name="form-bayar-cicilan" class="form-inline bayar" role="form" style="display:none">
				<input type="text" class="form-control" size="12" id="tgl" onclick="testing()" placeholder="Tgl Setoran..." />
				<input type="text" id="wajib" size="12" class="form-control" placeholder="Simpanan Wajib..." />
				<input type="text" id="sukarela" size="12" class="form-control" placeholder="Simpanan Sukarela..." />
				<button class="btn btn-primary btn-sm simpan_setoran" type="button">
					Simpan</span>
				</button>
			</form>
		</div>
		<!--<div class="col-md-1">
				<button class="btn btn-success btn-sm bayar-cicilan" type="button">
					Ambil Simpanan
				</button>
			</div>	
		<div class="col-md-6">
			<form name="form-ambil-simpanan" class="form-inline bayar" role="form" style="display:none">
				<input type="text" class="form-control" size="12" id="tgl" onclick="testing()" placeholder="Tgl Setoran..." />
				<input type="text" id="ambil_wajib" size="12" class="form-control" placeholder="Ambil Simpanan Wajib..." />
				<input type="text" id="ambil_sukarela" size="12" class="form-control" placeholder="Ambil Simpanan Sukarela..." />
				<button class="btn btn-primary btn-sm simpan_setoran" type="button">
					Simpan</span>
				</button>
			</form>
		</div>
	</form>-->
</div>

<div class="row">
	<div class="col-md-offset-1 col-md-10 col-md-offset-1">
		<div id="result"></div>
	</div>
</div>

<link rel="stylesheet" type="text/css" media="all" href="../../lib/jsdatepick/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../../lib/jsdatepick/jsDatePick.min.1.3.js"></script>


<script>
function test(){
	var id_anggota = $('#data_anggota').val();
	$.ajax({
		type: "POST",
		url: "simpanan/data_simpanan.php",
		data: {id_anggota:id_anggota},
		success: function(data){
			$('#result').html(data);
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

$(document).on('click', '.simpan_setoran', function(){
    var id_anggota = $('#data_anggota').val();
    var tgl = $('#tgl').val();
    var ambil_wajib = $('#ambil_wajib').val();
    var ambil_sukarela = $('#ambil_sukarela').val();

    $.ajax({
        type: "POST",
        url: "simpanan/ambil_simpanan.php",
        data: {id_anggota:id_anggota, tgl:tgl, ambil_wajib:ambil_wajib, ambil_sukarela:ambil_sukarela},
        success: function(data){
            $('#result').html(data);
        }
    }); 
    //alert(id_anggota+' '+ pokok +' '+jasa);
});

</script>