<?
if ($_POST) 
{
	include('../koneksi/conn.php');

	$id = $_POST['id'];

	$id = stripslashes($id);
	$id = mysql_real_escape_string($id);

	$sql = "DELETE FROM x_pinjaman_koperasi WHERE id = $id";
	//mysql_query($sql) or die(mysql_error());

	include('data_pinjaman_03.php');
	//echo $sql;
} else {
	echo 'something error..';
}

?>