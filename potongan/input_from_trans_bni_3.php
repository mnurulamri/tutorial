<?
include('../sanitasi.php');
//echo $tgl_posting = sanitasi($_POST['tgl_posting']);

	include('../koneksi/conn.php');
	$kata = $_POST['q'];
	//$kata = 'nuurul';
	/*
	$sql = "SELECT a.id, post_date, value_date, branch, journal_no, description, debit, credit, b.norek, a.nama, bulan, tahun, id_anggota
						 FROM x_histori_bni a
						 LEFT JOIN x_norek b ON a.norek = b.norek
						 WHERE post_date like '$tgl_posting%' AND credit > 0
						 ORDER BY nama";
	*/

	$sql = "SELECT a.id, post_date, value_date, branch, journal_no, description, debit, credit, b.norek, a.nama, bulan, tahun, id_anggota
						 FROM x_histori_bni a, x_norek b
						 WHERE a.norek = b.norek AND (a.nama like '%$kata%' OR b.norek like '%$kata%' OR description like '%$kata%') AND credit > 0 AND b.norek not in ('', '0') 
						 ORDER BY a.id DESC
						 LIMIT 5";

	/*$result = $mysqli->query($sql)  or die($mysqli->error) ;
	$data = array();
	while ($row = $result->fetch_object()) {
		$data[] = $row;
	}*/
	$result = mysql_query($sql);
	while ($row = mysql_fetch_object($result)) {
		$data[] = $row;
	}

	//jika recordnya ada
	if($data){
		echo '
		<form action="input_from_trans_bni_proses.php" method="post"><table><tr><td><input type="submit" name="submit" value="Submit"/></td></tr></table>
			<table class="demo-table" >
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>id anggota</th>
						<th>norek</th>
						<th>nama</th>			
						<th>post_date</th>
						<th>branch</th>
						<th>journal_no</th>
						<th>description</th>
						<th>debit</th>
						<th>credit</th>
					</tr>
				</thead>
				<tbody>';
			foreach ($data as $k => $v) {
				echo '
					<tr id="row_'.$k.'">
						<td type="ro"><input type="radio" id="'.$k.'" name="check_radio[]" value="'.$v->norek.';'.$v->post_date.';'.$v->branch.';'.$v->journal_no.';'.$v->credit.';'.$v->description.';'.$v->id_anggota.'"></td>
						<td type="ro">'.$v->id_anggota.'</td>
						<td type="ro">'.$v->norek.'</td>
						<td type="ro">'.$v->nama.'</td>			
						<td type="ro">'.$v->post_date.'</td>
						<td type="ro">'.$v->branch.'</td>
						<td type="ro">'.$v->journal_no.'</td>
						<td type="ro">'.$v->description.'</td>
						<td type="ro">'.$v->debit.'</td>
						<td type="ro" style="text-align:right">'.number_format($v->credit).'</td>
					</tr>';
			}
			echo '
				</tbody>
			</table>
		</form>
		<br>';
	} else {
		echo 'something error';
	}
?>

<style>
<?=file_get_contents('../lib/css/demo_table.css');?>
</style>

<script language="JavaScript">
function toggle(source) {
	checkboxes = document.getElementsByName('check_list[]');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}
</script>

<script>
dhtmlx.skin = "dhx_skyblue";
</script>