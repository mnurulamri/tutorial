
<?
include('../koneksi/conn.php');
include('../sanitasi.php');

/*
if ($_POST) {
	if($_POST['q']) $text = $_POST['q'];
	if($_POST['bulan']) $bulan = $_POST['bulan'];
	if($_POST['tahun']) $tahun = $_POST['tahun'];
}

echo $_POST['nama'].' '.$_POST['bulan'].' '.$_POST['tahun'];
*/

echo '<hr>';
if(isset($_POST['deskripsi'])){
	$text = $_POST['deskripsi'];
	$sql = "SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, substr(post_date,4,2) as bulan, concat('20',substr(post_date,7,2)) as tahun 
						 FROM x_histori_bni
						 WHERE (description like '%$text%' OR norek like '%$text%' OR nama like '%$text%')
						 ORDER BY substr(post_date,7,2) DESC, substr(post_date,4,2) DESC, post_date DESC
						 LIMIT 200";	

} else if(isset($_POST['nama'])){
	$text = $_POST['nama'];
	$sql = "SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, substr(post_date,4,2) as bulan, concat('20',substr(post_date,7,2)) as tahun 
						 FROM x_histori_bni
						 WHERE nama like '%$text%'
						 ORDER BY substr(post_date,7,2) DESC, substr(post_date,4,2) DESC, post_date DESC
						 LIMIT 200";	

} else if(isset($_POST['bulan']) OR isset($_POST['tahun'])){
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	$vtahun = '20'.$_POST['tahun'];
	
	$sql = "SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, substr(post_date,4,2) as bulan, concat('20',substr(post_date,7,2)) as tahun 
						 FROM x_histori_bni
						 WHERE substr(post_date,4,2) like '%$bulan%' AND (substr(post_date,7,2) like '%$tahun%' OR substr(post_date,7,4) like '%$vtahun%')
						 ORDER BY substr(post_date,7,2) DESC, substr(post_date,4,2) DESC, post_date DESC";
/*
} else if( (isset($_POST['nama']) OR isset($_POST['deskripsi'])) AND ($_POST['dk'])=='dk' ){
	$text = $_POST['deskripsi'];
	$sql = "SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, bulan, tahun 
						 FROM x_histori_bni
						 WHERE description like '%$text%'
						 ORDER BY tahun DESC, bulan DESC, post_date DESC
						 LIMIT 200";	 
*/
} else {
	$sql = "SELECT substr(post_date,7,2) as post_date_year FROM x_histori_bni ORDER BY substr(post_date,7,2) DESC limit 1";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		$post_date_year = $row['post_date_year'];
	}

	$sql = "SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, substr(post_date,4,2) as bulan, concat('20',substr(post_date,7,2)) as tahun 
						 FROM x_histori_bni
						 WHERE substr(post_date,7,2) = '$post_date_year'
						 ORDER BY substr(post_date,7,2) DESC, substr(post_date,4,2) DESC, post_date DESC
						 LIMIT 20";	
}

$result = mysql_query($sql) or die(mysql_error());

	echo '
	<div style="text-align:center">
		<table>
			<thead>
				<tr>';
					for($i = 0; $i < mysql_num_fields($result); $i++){
						$col = mysql_field_name($result, $i);
						echo '<th class="'.$col.'">'.str_replace('_', ' ', strtoupper($col)).'</th>';
					}
	echo '
				</tr>
			</thead>
			<tbody>';
	
				while($rows = mysql_fetch_array($result)){
	echo '
				<tr>';
					for($i = 0; $i < mysql_num_fields($result); $i++){			
						$col = mysql_field_name($result, $i);

						if($i == 6 || $i==7){
							echo '<td class="'.$col.'">'.number_format($rows[$col]).'</td>';
						} else {
							echo '<td class="'.$col.'">'.$rows[$col].'</td>';
						}
									
					}
	echo '
				</tr>';
				}
	echo '
			</tbody>
		</table>
	</div>
	';

?>

<style>
tbody tr:nth-child(odd) {border-bottom:1px solid #d9dadb; border-top:1px solid #d9dadb; background-color: #F2F3F4;}

tr {
/*width: 100%;
display: inline-table;*/
height:20px;
/*table-layout: fixed;  */
}

table { height:500px; margin: 0 auto; display: -moz-groupbox; font-family:courier; font-size:12px;}
table thead tr th {color:#fff; background:rgb(49,132,155);}
table tbody{  overflow-y: scroll;  height: 500px; position: absolute;-ms-overflow-style: none;}	
table tbody::-webkit-scrollbar {display:none;}
.id {width:30px}
.post_date{width:125px; text-align:right;}
.value_date{width:125px; text-align:right;}
.branch{width:60px; text-align:center;}
.journal_no{width:80px; text-align:center;}
.description{width:360px; text-align:left;}
.debit{width:70px; text-align:right;}
.credit{width:70px; text-align:right;}
.norek{width:80px; text-align:right;}
.nama{width:140px; padding-left:10px; text-align:left;}
.bulan{width:30px; text-align:center;}
.tahun{width:40px; text-align:center;}
</style>