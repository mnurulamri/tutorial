<?
include('../sanitasi.php');
//echo $tgl_posting = sanitasi($_POST['tgl_posting']);

if(isset($_POST['submit'])){	//to run PHP script on submit
	
	include('../koneksi/conn.php');
	echo $tgl_posting = sanitasi($_POST['tgl_posting']);
	/*
	$sql = "SELECT a.id, post_date, value_date, branch, journal_no, description, debit, credit, b.norek, a.nama, bulan, tahun, id_anggota
						 FROM x_histori_bni a
						 LEFT JOIN x_norek b ON a.norek = b.norek
						 WHERE post_date like '$tgl_posting%' AND credit > 0
						 ORDER BY nama";
	*/

	$sql = "SELECT a.id, post_date, value_date, branch, journal_no, description, debit, credit, b.norek, a.nama, bulan, tahun, id_anggota
						 FROM x_histori_bni a, x_norek b
						 WHERE a.norek = b.norek AND post_date like '%$tgl_posting%' AND credit > 0 AND b.norek not in ('', '0') 
						 ORDER BY nama";

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
		<form action="input_from_trans_bni_proses.php" method="post">
		<table class="dhtmlxGrid" gridHeight="auto" name="grid2" imgpath="../../dhtmlx/dhtmlxGrid/codebase/imgs/" style="width:100%" lightnavigation="true">
			<thead>
				<tr>
					<td><input type="checkbox" onClick="toggle(this)" /> Toggle All</td>
					<td>id anggota</td>
					<td>norek</td>
					<td>nama</td>			
					<td>post_date</td>
					<td>branch</td>
					<td>journal_no</td>
					<td>description</td>
					<td>debit</td>
					<td>credit</td>
				</tr>
			</thead>
			<tbody>';
		foreach ($data as $k => $v) {
			echo '
				<tr id="row_'.$k.'">
					<td type="ro"><input type="checkbox" id="'.$k.'" name="check_list[]" value="'.$v->norek.';'.$v->post_date.';'.$v->branch.';'.$v->journal_no.';'.$v->credit.';'.$v->description.';'.$v->id_anggota.'"></td>
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
		<input type="submit" name="submit" value="Submit"/>
		</form>
		';
	} else {
		echo 'something error';
	}

}
?>

<script language="JavaScript">
function toggle(source) {
	checkboxes = document.getElementsByName('check_list[]');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}
</script>

<link rel="stylesheet" type="text/css" href="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="../../dhtmlx/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_skyblue.css">
<script src="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
<script src="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
<script src="../../dhtmlx/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
<script  src="../../dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_start.js"></script>
<script>
dhtmlx.skin = "dhx_skyblue";
</script>