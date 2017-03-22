<?
if ($_POST) 
{
	include('../../koneksi/conn.php');

	$id_anggota = $_POST['id_anggota'];
	$tgl = $_POST['tgl'];
    $sisa_pinjaman = $_POST['sisa_pinjaman']; 
    $jml_pinjaman = $_POST['jml_pinjaman']; 
    $akumulasi_pinjaman = $_POST['akumulasi_pinjaman']; 
    $lama_cicilan = $_POST['lama_cicilan']; 
    $cicilan_perbulan = $_POST['cicilan_perbulan'];
    $jasa = $_POST['jasa'];
    $alasan = $_POST['alasan'];

	$id_anggota = stripslashes($id_anggota);
	$tgl = stripslashes($tgl);
    $sisa_pinjaman = stripslashes($sisa_pinjaman); 
    $jml_pinjaman = stripslashes($jml_pinjaman); 
    $akumulasi_pinjaman = stripslashes($akumulasi_pinjaman); 
    $lama_cicilan = stripslashes($lama_cicilan); 
    $cicilan_perbulan = stripslashes($cicilan_perbulan);
    $jasa = stripslashes($jasa);
    $alasan = stripslashes($alasan);

	echo $id_anggota = mysql_real_escape_string($id_anggota);
	echo $tgl = mysql_real_escape_string($tgl);
    echo $sisa_pinjaman =mysql_real_escape_string($sisa_pinjaman); 
    echo $jml_pinjaman =mysql_real_escape_string($jml_pinjaman); 
    echo $akumulasi_pinjaman =mysql_real_escape_string($akumulasi_pinjaman); 
    echo $lama_cicilan =mysql_real_escape_string($lama_cicilan); 
    echo $cicilan_perbulan =mysql_real_escape_string($cicilan_perbulan);
    echo $jasa =mysql_real_escape_string($jasa);
    echo $alasan =mysql_real_escape_string($alasan);

	$sql = "INSERT INTO x_pengajuan_pinjaman (id_anggota, tgl_pinjaman, sisa_pinjaman, jml_pinjaman, akumulasi_pinjaman, lama_pinjaman, cicilan_perbulan, jasa, alasan)
			VALUES 
				('$id_anggota', '$tgl', '$tsisa_pinjaman',  '$jml_pinjaman', '$akumulasi_pinjaman', '$lama_cicilan', '$cicilan_perbulan', '$jasa', '$alasan')";
	mysql_query($sql) or die(mysql_error());

} else {
	echo 'something error..';
}

?>