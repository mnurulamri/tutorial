<?
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include('../koneksi/conn.php');

$id_anggota = $_POST['id_anggota'];
//$id_anggota = 10901136;

//data pinjaman dan pengembalian
$sql = "SELECT DISTINCT a.*, nama, c.keterangan
		FROM x_pinjaman_koperasi a, x_norek b, x_kd_pinjam c
		WHERE a.id_anggota = b.id_anggota AND a.kd_pinjam = c.kd_pinjam AND a.id_anggota = $id_anggota
		ORDER BY tgl_transaksi, kd_pinjam";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data[] = $row;
}

//data jasa
$sql = "SELECT tgl_transaksi, kredit
		FROM x_pinjaman_koperasi a, x_norek b
		WHERE a.id_anggota = b.id_anggota AND kd_pinjam=3 AND a.id_anggota = $id_anggota
		ORDER BY tgl_transaksi, kd_pinjam";

$result = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) {
	$data_jasa[$row['tgl_transaksi']] = $row['kredit'];
}

//fungsi tanggal
function DateToIndo($value) { // fungsi atau method untuk mengubah tanggal ke format indonesia
   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $BulanIndo = array("Januari", "Februari", "Maret",
                           "April", "Mei", "Juni",
                           "Juli", "Agustus", "September",
                           "Oktober", "November", "Desember");
    	$array = explode("-", $value);
        $tahun = $array[0]; 
        $bulan = $array[1]; 
        $tgl   = $array[2]; 
        
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
        return($result);
}

?>

<div class="panel panel-default" style="width:950px">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$data[0]['nama']?></h3>
	</div>
	<div class="panel-body">
		<div style="margin-left:-15px">
			<table border="0" style="margin:auto; font-family:consolas; font-size:10pt; background:#5499C7">
				<thead>
					<tr>
						<td class="no" style="width:30px !important">No</td>
						<td class="tgl" style="width:150px !important">Tanggal</td>
						<td class="uraian" style="width:400px !important">Uraian</td>
						<td class="debet" style="width:100px !important">Debet</td>
						<td class="kredit" style="width:100px !important">Kredit</td>
						<td class="kredit" style="width:100px !important">Saldo</td>
						<td class="kredit" style="width:100px !important;">Jasa</td>
						<td>&nbsp;</td>
					</tr>
				</thead>
			</table>
		</div>
		<div style="overflow-y: scroll; height: 450px;">
			<table border="0" cellspacing="0" cellpadding="2" style="font-family:consolas; font-size:10pt"> <!--"  class="table table-bordered" -->
				<!--<thead>
					<tr>
						<td class="no">No</td>
						<td class="tgl">Tanggal</td>
						<td class="uraian">Uraian</td>
						<td class="debet">Debet</td>
						<td class="kredit">Kredit</td>
						<td class="kredit">Saldo</td>
						<td class="kredit">Jasa</td>
					</tr>
				</thead>-->

				<?
				echo '<tbody>';
				$saldo = 0;
				$temp = 0;
				$i = 1;

				foreach ($data as $k => $v) 
				{
					if ($v['kd_pinjam']==1 || $v['kd_pinjam']==2) {
						$saldo += $v['debet'] - $v['kredit'];
					}

					if ($i % 2 == 0) { 
						$style = 'style="background:#F2F3F4"';
					} else {
						$style = 'style="background:#fff"';
					}
					

					echo '
					<tr '.$style.'>';
					if ($v['kd_pinjam']==1 || $v['kd_pinjam']==2) {
						echo '

						<td class="no" style="width:50px !important">'.$i.'</td>
						<td class="tgl" style="width:135px !important; text-align:right">'.DateToIndo($v['tgl_transaksi']).'</td>
						<td class="uraian" style="width:400px !important">'.($v['keterangan']).'</td>
						<td class="debet" style="width:100px !important">'.number_format($v['debet']).'</td>
						<td class="kredit" style="width:100px !important">'.number_format($v['kredit']).'</td>
						<td class="kredit" style="width:100px !important">'.number_format($saldo).'</td>';

						if(isset($data_jasa[$v['tgl_transaksi']])){
							$jasa = $data_jasa[$v['tgl_transaksi']];
						} else {
							$jasa = 0;
						}

						echo '
						<td class="kredit" style="width:100px !important">'.number_format($jasa).'</td>
						<td class="del" id="'.$v['id'].'" style="color:red; cursor:pointer;">
						<button class="btn btn-default btn-default-xs" data-record-id="'.$v['id'].'" data-record-title="Something cool" data-toggle="modal" data-target="#confirm-delete">del</button></td>';
						$i++;
						/*if($v['kd_pinjam'] == 2){
							echo '<td class="kredit">'.$jasa.'</td>';
						} else {
							echo '<td class="kredit"0></td>';
						}*/							
					}
					
				}
				echo '</tbody>';
				?>
			</table>
		</div>

	</div>
</div>

<!-- Delete Modal content-->

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <a href="#" data-record-id="23" data-record-title="The first one" data-toggle="modal" data-target="#confirm-delete">
        Delete "The first one", #23
    </a>
    <br />

    <script>
        $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
            // $.post('/api/record/' + id).then()
  
		    $.ajax({
		        type: "POST",
		        url: "pinjaman/del_cicilan.php",
		        data: {id:id},
		        success: function(data){
					$modalDiv.addClass('loading');
					setTimeout(function() {
					    $modalDiv.modal('hide').removeClass('loading');
					}, 1000);
		            $('#view_pinjaman').html(data);
		        }
		    }); 

        });

        $('#confirm-delete').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
        });
    </script>

<style>
.modal.loading .modal-content:before {
  content: 'Loading...';
  text-align: center;
  line-height: 155px;
  font-size: 20px;
  background: rgba(0, 0, 0, .8);
  position: absolute;
  top: 55px;
  bottom: 0;
  left: 0;
  right: 0;
  color: #EEE;
  z-index: 1000;
}

table thead tr td {
	text-align:center;
	padding:2px;
	font-weight: bold;
	color: #fff;
}

table thead tr td.no {
	width:50px;
	padding:2px;
}

table thead tr td.debet {
	text-align: right;
}

table thead tr td.kredit {
	text-align: right;
}

table tbody tr td.no {
	width:50px;
	text-align:center;
}

.tgl {
	width:70px;
}

table thead tr td.tgl {
	width:50px;
}

table tbody tr td.tgl {
	width:50px;
	padding:2px;
}

.uraian {
	width:80px;
	padding:2px;
	text-align:left;
	padding-left: 15px;
	
}

table thead tr td.uraian {
	width: 70px;
	padding-left: 15px;
	padding-right: 2px;
	padding-top: 2px;
	padding-bottom: 2px
}

table tbody tr td.uraian {
	width: 70px;
	padding-left: 15px;
	padding-right: 2px;
	padding-top: 2px;
	padding-bottom: 2px
}

.debet {
	width:50px;
}

table thead tr td.debet {
	width:50px;
	padding:2px;
}

table tbody tr td.debet {
	text-align: right;
	width:50px;
	padding:2px;
}

.kredit {
	width:50px;
}

table thead tr td.kredit {
	width:50px;
	padding:2px;
}

table tbody tr td.kredit {
	text-align:right;
	width:50px;\
	padding:2px;
}

.saldo {
	width:50px;	
}
</style>
