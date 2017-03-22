<?
/*
if(!session_id()) session_start();
$thsmt = $_SESSION['thsmt'];
$jenis_ujian = $_SESSION['jenis_ujian'];
*/

require_once("../../dhtmlx/dhtmlxConnector/codebase/grid_connector.php");

//include('conn.php');
$conn = mysql_connect("localhost","remunerasi","remun!@#");
$db = mysql_select_db("remunerasi");

$grid = new GridConnector($conn,"MySQL");

/*$grid -> render_sql("SELECT id_ujian, hari,jam,mata_kuliah,ruang,ruang2,mhs,pengajar,kelas,minggu 
					 FROM ujian_draft 
					 WHERE thsmt = '$thsmt' AND jenis_ujian = '$jenis_ujian' AND (kd_fak = '09' or kd_fak = '18' or kd_fak = '')
					 ORDER BY flaghari asc, jam asc",
					"id_ujian",
					"id_ujian,hari,jam,mata_kuliah,ruang,ruang2,mhs,pengajar,kelas,minggu");

$grid -> render_sql("SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, bulan, tahun 
					 FROM x_histori_bni
					 WHERE tahun = 16 OR tahun=
					 ORDER BY tahun desc, bulan desc, post_date desc",
					"id",
					"id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, bulan, tahun");	*/	

$grid -> render_sql("SELECT id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, bulan, tahun 
					 FROM x_histori_bni
					 WHERE substr(post_date,7,2)='16' OR substr(post_date,7,2)='17' OR
					 		substr(post_date,7,4)='2016' OR substr(post_date,7,4)='2017'
					 ORDER BY tahun desc, bulan desc, post_date desc",
					"id",
					"id, post_date, value_date, branch, journal_no, description, debit, credit, norek, nama, bulan, tahun");

?>